<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SeoStatistics
 *
 * @ORM\Table(name="seo_statistics")
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\SeoStatisticsRepository")
 */
class SeoStatistics
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
     * @ORM\Column(name="uniqueVisitors", type="integer")
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
     * @ORM\Column(name="topViewed", type="string", length=255)
     */
    private $topViewed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;


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
     * Set uniqueVisitors
     *
     * @param integer $uniqueVisitors
     * @return SeoStatistics
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
     * @return SeoStatistics
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
     * @return SeoStatistics
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
     * @return SeoStatistics
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return SeoStatistics
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
     * @return SeoStatistics
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

}
