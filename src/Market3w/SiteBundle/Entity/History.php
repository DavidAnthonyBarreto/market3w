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
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     **/
    protected $userId;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\SeoStatistics")
     * @ORM\JoinColumn(name="seo_id", referencedColumnName="id", nullable=false)
     **/
    protected $seoId;
    
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
     * Set userId
     *
     * @param \Market3w\SiteBundle\Entity\User $userId
     * @return History
     */
    public function setUserId(\Market3w\SiteBundle\Entity\User $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \Market3w\SiteBundle\Entity\User 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set seoId
     *
     * @param \Market3w\SiteBundle\Entity\SeoStatistics $seoId
     * @return History
     */
    public function setSeoId(\Market3w\SiteBundle\Entity\SeoStatistics $seoId)
    {
        $this->seoId = $seoId;

        return $this;
    }

    /**
     * Get seoId
     *
     * @return \Market3w\SiteBundle\Entity\SeoStatistics 
     */
    public function getSeoId()
    {
        return $this->seoId;
    }
}
