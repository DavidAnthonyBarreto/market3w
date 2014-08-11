<?php

namespace Market3w\SiteBundle\Controller\Intranet;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

use Market3w\SiteBundle\Entity\Bill;
use Market3w\SiteBundle\Entity\BillLine;
use Market3w\SiteBundle\Form\Type\Intranet\BillType;

/**
 * Bill controller.
 *
 * @Route("/intranet/client/{idClient}/bill", requirements={"idClient" = "\d+"})
 */
class BillController extends Controller
{
    /**
     * @Route("/listBill", name="bill_list")
     * @Method("GET")
     * @Template()
     */
    public function listBillAction($idClient)
    {
        $em    = $this->getDoctrine()->getManager();
        $bills = $em->getRepository("Market3wSiteBundle:Bill")->findBillForClient($idClient);
        
        return array("bills" => $bills);      
    }
    
    /**
     * @Route("/listEstimate", name="bill_list_estimate")
     * @Method("GET")
     * @Template()
     */
    public function listEstimateAction($idClient)
    {
        $em        = $this->getDoctrine()->getManager();
        $estimates = $em->getRepository("Market3wSiteBundle:Bill")->findEstimatesForClient($idClient);
                
        return array("estimates" => $estimates);      
    }
 
    /**
     * @Route("/{idBill}/show", name="bill_show", requirements={"idBill" = "\d+"})
     * @Template()
     */
    public function showAction($idClient, $idBill)
    {
        $em   = $this->getDoctrine()->getManager();
        $bill = $em->getRepository("Market3wSiteBundle:Bill")->find($idBill);
        
        return array( 'bill' => $bill, 'idClient' => $idClient );    
    }

    /**
     * @Route("/{idBill}/edit", name="bill_edit", requirements={"idBill" = "\d+"})
     * @Template()
     */
    public function editAction(Request $request, $idClient, $idBill)
    {
        $em   = $this->getDoctrine()->getManager();
        $bill = $em->getRepository('Market3wSiteBundle:Bill')->find($idBill);
        
        if (!$bill) {
            throw $this->createNotFoundException('Aucune facture/devis trouvée pour cet id : '.$idBill);
        }
        
        $originalLines = new ArrayCollection();
        foreach ($bill->getLines() as $line) {
            $originalLines->add($line);
        }
        
        $form = $this->createForm(new BillType(), $bill);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            foreach ($originalLines as $line){
                if ($bill->getLines()->contains($line) == false){
                    $em->remove($line);
                }
            }
            
            foreach($bill->getLines() as $line) { 
                $line->setBill($bill);
            }
                        
            $bill->setUpdatedAt(new \DateTime());
               
            $em->persist($bill);
            $em->flush();
            
            return $this->redirect($this->generateUrl('bill_show', array('idClient' => $idClient, 'idBill' => $bill->getid()) ));
        }
        
        return array('form' => $form->createView());     
    }

    /**
     * @Route("/add/{type}", name="intranet_client_bill_add", requirements={"type" = "\w+"} )
     * @Template()
     */
    public function addAction(Request $request, $idClient, $type)
    {
        $em     = $this->getDoctrine()->getManager();
        $client = $em->getRepository('Market3wSiteBundle:User')->find($idClient); 
                
        $bill = new Bill();
        $bill->setClient($client);
        
        if ( $type == "estimate" ) {
            $type   = $em->getRepository('Market3wSiteBundle:BillType')->findByName('Devis')[0];
            $status = $em->getRepository('Market3wSiteBundle:BillStatus')->findByName('En attente de réponse')[0];
        }
        else {
            $type   = $em->getRepository('Market3wSiteBundle:BillType')->findByName('Facture')[0];
            $status = $em->getRepository('Market3wSiteBundle:BillStatus')->findByName('En attente de paiement')[0]; 
        }
        
        $bill->setType($type);
        $bill->setStatus($status);
        
        $line = new BillLine();
        $bill->addLine($line);
        
        $form = $this->createForm(new BillType(), $bill);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            foreach($bill->getLines() as $line) { 
                $line->setBill($bill);
            }
            
            $em = $this->getDoctrine()->getManager();
            
            $bill->setTva($this->container->getParameter('tva'));
            $bill->setDateBilling(new \DateTime());
            $bill->setCreatedAt(new \DateTime());
            $bill->setUpdatedAt(new \DateTime());
               
            $em->persist($bill);
            $em->flush();
            
            return $this->redirect($this->generateUrl('bill_show', array('idClient' => $client->getId(), 'idBill' => $bill->getid()) ));
        }
        
        return array('form' => $form->createView());    
    }
    
    /**
     * @Route("/{idBill}/validate", name="bill_validate_estimate", requirements={"idBill" = "\d+"})
     * @Template()
     */
    public function validateAction($idClient, $idBill)
    {
        
        $em     = $this->getDoctrine()->getManager();
        $client = $em->getRepository('Market3wSiteBundle:User')->find($idClient);
        $bill   = $em->getRepository('Market3wSiteBundle:Bill')->find($idBill);
        
        // estimate is accepted
        $acceptedStatus = $em->getRepository('Market3wSiteBundle:BillStatus')->find(5);
        $bill->setStatus($acceptedStatus);
        $bill->setAccepted(true);
        $em->persist($bill);
        $em->flush();
        
        // the prospect becomes a client
        $fosUserManipulator = $this->container->get('fos_user.util.user_manipulator');
        $fosUserManipulator->removeRole($client->getUsername(), 'ROLE_PROSPECT');
        $fosUserManipulator->addRole($client->getUsername(), 'ROLE_CLIENT');
        
        // affichage d'un message de confirmation
        $this->get('session')->getFlashBag()->add(
            'notice',
            'Le devis est accepté.'
        );
        
        return $this->redirect($this->generateUrl('bill_show', array('idClient' => $client->getId(), 'idBill' => $bill->getid()) ));
    }

      /**
     * @Route("/{idBill}/generate-bill", name="bill_estimate_to_bill", requirements={"idBill" = "\d+"})
     * @Template()
     */
    public function generateBillAction($idClient, $idBill)
    {
        
        $em     = $this->getDoctrine()->getManager();
        $client = $em->getRepository('Market3wSiteBundle:User')->find($idClient);
        $bill   = $em->getRepository('Market3wSiteBundle:Bill')->find($idBill);
        
        // création d'une facture à partir du devis
        // on redirige vers la facture créée
        
        return array();
    }
}
