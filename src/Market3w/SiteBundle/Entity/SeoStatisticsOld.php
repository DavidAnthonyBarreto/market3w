<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SeoStatistics
 *
 * @ORM\Table(name="seo_statitics")
 */
class SeoStatisticsOld
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
     * @ORM\OneToOne(targetEntity="Market3w\SiteBundle\Entity\User" inversedBy='seoStatistics')
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     */
    private $client;
    
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

}
