<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BillLine
 *
 * @ORM\Table(name="bill_line")
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\BillLineRepository")
 */
class BillLine
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
     * @ORM\Column(name="nb_hours", type="integer")
     */
    private $nbHours;

    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\Service")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id", nullable=false)
     */
    private $service;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\Bill", inversedBy="lines")
     * @ORM\JoinColumn(name="bill_id", referencedColumnName="id", nullable=false)
     */
    private $bill;

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
     * Set nbHours
     *
     * @param integer $nbHours
     * @return BillLine
     */
    public function setNbHours($nbHours)
    {
        $this->nbHours = $nbHours;

        return $this;
    }

    /**
     * Get nbHours
     *
     * @return integer 
     */
    public function getNbHours()
    {
        return $this->nbHours;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return BillLine
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return string 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return BillLine
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set bill
     *
     * @param \Market3w\SiteBundle\Entity\Bill $bill
     * @return BillLine
     */
    public function setBill(\Market3w\SiteBundle\Entity\Bill $bill)
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
}
