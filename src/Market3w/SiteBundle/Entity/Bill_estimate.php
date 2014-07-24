<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bill_estimate
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\Bill_estimateRepository")
 */
class Bill_estimate
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
     * @var integer
     *
     * @ORM\Column(name="bill_id", type="integer")
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\Bill")
     * @ORM\JoinColumn(name="bill_id", referencedColumnName="id", nullable=false)
     */
    private $billId;

    /**
     * @var integer
     *
     * @ORM\Column(name="estimate_id", type="integer")
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\Bill")
     * @ORM\JoinColumn(name="estimate_id", referencedColumnName="id", nullable=false)
     */
    private $estimateId;


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
     * Set billId
     *
     * @param integer $billId
     * @return Bill_estimate
     */
    public function setBillId($billId)
    {
        $this->billId = $billId;

        return $this;
    }

    /**
     * Get billId
     *
     * @return integer 
     */
    public function getBillId()
    {
        return $this->billId;
    }

    /**
     * Set estimateId
     *
     * @param integer $estimateId
     * @return Bill_estimate
     */
    public function setEstimateId($estimateId)
    {
        $this->estimateId = $estimateId;

        return $this;
    }

    /**
     * Get estimateId
     *
     * @return integer 
     */
    public function getEstimateId()
    {
        return $this->estimateId;
    }
}
