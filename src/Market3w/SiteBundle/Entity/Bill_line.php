<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bill_line
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\Bill_lineRepository")
 */
class Bill_line
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
     * @var float
     *
     * @ORM\Column(name="nb_hours", type="float")
     */
    private $nbHours;

    /**
     * @var string
     *
     * @ORM\Column(name="service", type="string", length=255)
     */
    private $service;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


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
     * @return Bill_line
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
     * Set nbHours
     *
     * @param float $nbHours
     * @return Bill_line
     */
    public function setNbHours($nbHours)
    {
        $this->nbHours = $nbHours;

        return $this;
    }

    /**
     * Get nbHours
     *
     * @return float 
     */
    public function getNbHours()
    {
        return $this->nbHours;
    }

    /**
     * Set service
     *
     * @param string $service
     * @return Bill_line
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
     * @return Bill_line
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
}
