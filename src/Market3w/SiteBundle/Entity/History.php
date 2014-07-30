<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\HistoryRepository")
 */
class History
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
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\User", inversedBy="seoStatistics", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     **/
    protected $client;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\SeoStatistics")
     * @ORM\JoinColumn(name="seo_id", referencedColumnName="id", nullable=false)
     **/
    protected $seoStatistic;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

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
     * Set date
     *
     * @param \DateTime $date
     * @return History
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set client
     *
     * @param \Market3w\SiteBundle\Entity\User $client
     * @return History
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
     * Set seoStatistic
     *
     * @param \Market3w\SiteBundle\Entity\SeoStatistics $seoStatistic
     * @return History
     */
    public function setSeoStatistic(\Market3w\SiteBundle\Entity\SeoStatistics $seoStatistic)
    {
        $this->seoStatistic = $seoStatistic;

        return $this;
    }

    /**
     * Get seoStatistic
     *
     * @return \Market3w\SiteBundle\Entity\SeoStatistics 
     */
    public function getSeoStatistic()
    {
        return $this->seoStatistic;
    }
}
