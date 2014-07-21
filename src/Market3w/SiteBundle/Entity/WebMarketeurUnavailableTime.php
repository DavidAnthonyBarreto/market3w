<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WebMarketeurUnavailableTime
 *
 * @ORM\Table(name="web_marketeur_unavailable_time")
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\WebMarketeurUnavailableTimeRepository")
 */
class WebMarketeurUnavailableTime
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
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\User")
     * @ORM\JoinColumn(name="web_marketeur_id", referencedColumnName="id")
     **/
    protected $webMarketeur;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\Date")
     * @ORM\JoinColumn(name="date_id", referencedColumnName="id", nullable=false)
     **/
    protected $date;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\Hour")
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
     * Set webMarketeur
     *
     * @param \Market3w\SiteBundle\Entity\User $webMarketeur
     * @return WebMarketeurUnavailableTime
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
     * Set date
     *
     * @param \Market3w\SiteBundle\Entity\Date $date
     * @return WebMarketeurUnavailableTime
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
     * @return WebMarketeurUnavailableTime
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
