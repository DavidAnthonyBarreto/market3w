<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bill
 *
 * @ORM\Table(name="bill")
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\BillRepository")
 */
class Bill
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float")
     */
    private $tva;

    /**
     * @var integer
     *
     * @ORM\Column(name="discount", type="integer")
     */
    private $discount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_billing", type="datetime")
     */
    private $dateBilling;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_payment", type="datetime", nullable=true)
     */
    private $datePayment = null;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\BillType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     **/
    protected $type;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\BillStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=false)
     */
    private $status;
    
     /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\User", inversedBy="bills")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     **/
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="Market3w\SiteBundle\Entity\BillLine", mappedBy="bill")
     */
    private $lines;
    
    /**
     * @ORM\OneToMany(targetEntity="Bill", mappedBy="bill")
     **/
    private $estimates;

    /**
     * @ORM\ManyToOne(targetEntity="Bill", inversedBy="estimates")
     * @ORM\JoinColumn(name="bill_id", referencedColumnName="id", nullable=true)
     **/
    private $bill;
    
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lines = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estimates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tva
     *
     * @param float $tva
     * @return Bill
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return float 
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set discount
     *
     * @param integer $discount
     * @return Bill
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return integer 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set dateBilling
     *
     * @param \DateTime $dateBilling
     * @return Bill
     */
    public function setDateBilling($dateBilling)
    {
        $this->dateBilling = $dateBilling;

        return $this;
    }

    /**
     * Get dateBilling
     *
     * @return \DateTime 
     */
    public function getDateBilling()
    {
        return $this->dateBilling;
    }

    /**
     * Set datePayment
     *
     * @param \DateTime $datePayment
     * @return Bill
     */
    public function setDatePayment($datePayment)
    {
        $this->datePayment = $datePayment;

        return $this;
    }

    /**
     * Get datePayment
     *
     * @return \DateTime 
     */
    public function getDatePayment()
    {
        return $this->datePayment;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Bill
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Bill
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set type
     *
     * @param \Market3w\SiteBundle\Entity\BillType $type
     * @return Bill
     */
    public function setType(\Market3w\SiteBundle\Entity\BillType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Market3w\SiteBundle\Entity\BillType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set status
     *
     * @param \Market3w\SiteBundle\Entity\BillStatus $status
     * @return Bill
     */
    public function setStatus(\Market3w\SiteBundle\Entity\BillStatus $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Market3w\SiteBundle\Entity\BillStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set client
     *
     * @param \Market3w\SiteBundle\Entity\User $client
     * @return Bill
     */
    public function setClient(\Market3w\SiteBundle\Entity\User $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Market3w\SiteBundle\Entity\User 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add lines
     *
     * @param \Market3w\SiteBundle\Entity\BillLine $lines
     * @return Bill
     */
    public function addLine(\Market3w\SiteBundle\Entity\BillLine $lines)
    {
        $this->lines[] = $lines;

        return $this;
    }

    /**
     * Remove lines
     *
     * @param \Market3w\SiteBundle\Entity\BillLine $lines
     */
    public function removeLine(\Market3w\SiteBundle\Entity\BillLine $lines)
    {
        $this->lines->removeElement($lines);
    }

    /**
     * Get lines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * Add estimates
     *
     * @param \Market3w\SiteBundle\Entity\Bill $estimates
     * @return Bill
     */
    public function addEstimate(\Market3w\SiteBundle\Entity\Bill $estimates)
    {
        $this->estimates[] = $estimates;

        return $this;
    }

    /**
     * Remove estimates
     *
     * @param \Market3w\SiteBundle\Entity\Bill $estimates
     */
    public function removeEstimate(\Market3w\SiteBundle\Entity\Bill $estimates)
    {
        $this->estimates->removeElement($estimates);
    }

    /**
     * Get estimates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstimates()
    {
        return $this->estimates;
    }

    /**
     * Set bill
     *
     * @param \Market3w\SiteBundle\Entity\Bill $bill
     * @return Bill
     */
    public function setBill(\Market3w\SiteBundle\Entity\Bill $bill = null)
    {
        $this->bill = $bill;

        return $this;
    }

    /**
     * Get bill
     *
     * @return \Market3w\SiteBundle\Entity\Bill 
     */
    public function getBill()
    {
        return $this->bill;
    }
    
    /**
     * Calculate totalHT
     *
     * @return float 
     */
    public function calculateTotalHT()
    {
        $lines = $this->getLines();
        $pricesByService = array();
        
        foreach( $lines as $line ){
            $pricesByService[] = $line->getPrice()*$line->getNbHours();
        }
        
        $totalHT = array_sum($pricesByService);
        
        return $totalHT;
    }
    
    /**
     * Calculate totalTTC
     *
     * @return float
     */
    public function calculateTotalTTC()
    {
        $totalHT = $this->calculateTotalHT();
        
        if( !is_null($this->getDiscount()) ){
            $totalHT = $totalHT - $totalHT*$this->getDiscount()/100;
        }
        
        $totalTTC = $totalHT + $totalHT*$this->getTva()/100;
        
        return $totalTTC;
    }
    
}
