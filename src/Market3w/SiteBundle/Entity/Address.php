<?php

namespace Market3w\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="firstLine", type="string", length=255, nullable=false)
     */
    private $firstLine;

    /**
     * @var string
     *
     * @ORM\Column(name="secondLine", type="string", length=255, nullable=true)
     */
    private $secondLine;

    /**
     * @var string
     *
     * @ORM\Column(name="thirdLine", type="string", length=255, nullable=true)
     */
    private $thirdLine;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=10, nullable=false)
     */
    private $zipcode;
    
    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=false)
     */
    protected $country;

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
     * Set firstLine
     *
     * @param string $firstLine
     * @return Address
     */
    public function setFirstLine($firstLine)
    {
        $this->firstLine = $firstLine;

        return $this;
    }

    /**
     * Get firstLine
     *
     * @return string 
     */
    public function getFirstLine()
    {
        return $this->firstLine;
    }

    /**
     * Set secondLine
     *
     * @param string $secondLine
     * @return Address
     */
    public function setSecondLine($secondLine)
    {
        $this->secondLine = $secondLine;

        return $this;
    }

    /**
     * Get secondLine
     *
     * @return string 
     */
    public function getSecondLine()
    {
        return $this->secondLine;
    }

    /**
     * Set thirdLine
     *
     * @param string $thirdLine
     * @return Address
     */
    public function setThirdLine($thirdLine)
    {
        $this->thirdLine = $thirdLine;

        return $this;
    }

    /**
     * Get thirdLine
     *
     * @return string 
     */
    public function getThirdLine()
    {
        return $this->thirdLine;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Address
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }
}
