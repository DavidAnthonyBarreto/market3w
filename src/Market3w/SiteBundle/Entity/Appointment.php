<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appointment
 *
 * @ORM\Table(name="appointment")
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\AppointmentRepository")
 */
class Appointment
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
     * @var string
     *
     * @ORM\Column(name="subject", type="text")
     */
    private $subject;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\AppointmentType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     **/
    protected $type;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\User")
     * @ORM\JoinColumn(name="web_marketeur_id", referencedColumnName="id", nullable=false)
     **/
    protected $webMarketeur;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\User")
     * @ORM\JoinColumn(name="prospect_id", referencedColumnName="id", nullable=false)
     **/
    protected $prospect;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=true)
     **/
    protected $address;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\Date", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="date_id", referencedColumnName="id", nullable=false)
     **/
    protected $date;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\Hour", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="hour_id", referencedColumnName="id", nullable=false)
     **/
    protected $hour;
    
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
     * Set subject
     *
     * @param string $subject
     * @return Appointment
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set type
     *
     * @param \Market3w\SiteBundle\Entity\AppointmentType $type
     * @return Appointment
     */
    public function setType(\Market3w\SiteBundle\Entity\AppointmentType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Market3w\SiteBundle\Entity\AppointmentType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set webMarketeur
     *
     * @param \Market3w\SiteBundle\Entity\User $webMarketeur
     * @return Appointment
     */
    public function setWebMarketeur(\Market3w\SiteBundle\Entity\User $webMarketeur = null)
    {
        $this->webMarketeur = $webMarketeur;

        return $this;
    }

    /**
     * Get webMarketeur
     *
     * @return \Market3w\SiteBundle\Entity\User 
     */
    public function getWebMarketeur()
    {
        return $this->webMarketeur;
    }

    /**
     * Set prospect
     *
     * @param \Market3w\SiteBundle\Entity\User $prospect
     * @return Appointment
     */
    public function setProspect(\Market3w\SiteBundle\Entity\User $prospect = null)
    {
        $this->prospect = $prospect;

        return $this;
    }

    /**
     * Get prospect
     *
     * @return \Market3w\SiteBundle\Entity\User 
     */
    public function getProspect()
    {
        return $this->prospect;
    }

    /**
     * Set address
     *
     * @param \Market3w\SiteBundle\Entity\Address $address
     * @return Appointment
     */
    public function setAddress(\Market3w\SiteBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \Market3w\SiteBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set date
     *
     * @param \Market3w\SiteBundle\Entity\Date $date
     * @return Appointment
     */
    public function setDate(\Market3w\SiteBundle\Entity\Date $date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \Market3w\SiteBundle\Entity\Date 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set hour
     *
     * @param \Market3w\SiteBundle\Entity\Hour $hour
     * @return Appointment
     */
    public function setHour(\Market3w\SiteBundle\Entity\Hour $hour = null)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return \Market3w\SiteBundle\Entity\Hour 
     */
    public function getHour()
    {
        return $this->hour;
    }

    
}
