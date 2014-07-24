<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * seo_statistics
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\seo_statisticsRepository")
 */
class seo_statistics
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
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\OneToOne(targetEntity="Market3w\SiteBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $userId;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="unique_visitors", type="integer")
     */
    private $uniqueVisitors;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="string", length=255)
     */
    private $keywords;

    /**
     * @var string
     *
     * @ORM\Column(name="top_viewed", type="string", length=255)
     */
    private $topViewed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;


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
     * Set userId
     *
     * @param integer $userId
     * @return Bill
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
    
    /**
     * Set uniqueVisitors
     *
     * @param integer $uniqueVisitors
     * @return seo_statistics
     */
    public function setUniqueVisitors($uniqueVisitors)
    {
        $this->uniqueVisitors = $uniqueVisitors;

        return $this;
    }

    /**
     * Get uniqueVisitors
     *
     * @return integer 
     */
    public function getUniqueVisitors()
    {
        return $this->uniqueVisitors;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return seo_statistics
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return seo_statistics
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set topViewed
     *
     * @param string $topViewed
     * @return seo_statistics
     */
    public function setTopViewed($topViewed)
    {
        $this->topViewed = $topViewed;

        return $this;
    }

    /**
     * Get topViewed
     *
     * @return string 
     */
    public function getTopViewed()
    {
        return $this->topViewed;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return seo_statistics
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return seo_statistics
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
