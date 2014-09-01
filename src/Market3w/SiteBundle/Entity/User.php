<?php
namespace Market3w\SiteBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Market3w\SiteBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut pas contenir de chiffres"
     * )
     */
    protected $lastName;
    
    /**
     * @var string
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut pas contenir de chiffres"
     * )
     */
    protected $firstName;
    
    /**
     * @var string
     * @ORM\Column(name="phone_number", type="string", length=100, nullable=true)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     message="Le numéro ne doit contenir que des chiffres"
     * )
     * @Assert\Length(
     *      min = "10",
     *      max = "10",
     *      exactMessage = "Le numéro doit avoir exactement {{ limit }} chiffres"
     * )
     */
    protected $phoneNumber;
    
    /**
     * @var string
     * @ORM\Column(name="mobile_phone_number", type="string", length=100, nullable=true)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     message="Le numéro ne doit contenir que des chiffres"
     * )
     * @Assert\Length(
     *      min = "10",
     *      max = "10",
     *      exactMessage = "Le numéro doit avoir exactement {{ limit }} chiffres"
     * )
     */
    protected $mobilePhoneNumber;
    
    /**
     * @ORM\OneToMany(targetEntity="Market3w\SiteBundle\Entity\Appointment", mappedBy="webMarketeur")
     */
    private $appointments;
    
    /**
     * @ORM\OneToMany(targetEntity="Market3w\SiteBundle\Entity\History", mappedBy="client", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="seo_statistics_id", referencedColumnName="id")
     * @ORM\OrderBy({"date" = "ASC"})
     */
    private $seoStatistics;
    
    /**
     * @ORM\OneToMany(targetEntity="Market3w\SiteBundle\Entity\User", mappedBy="webMarketeur", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $clients;
    
    /**
     * @ORM\ManyToOne(targetEntity="Market3w\SiteBundle\Entity\User", inversedBy="clients", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="web_marketeur_id", referencedColumnName="id")
     */
    private $webMarketeur;
    
    /**
     * @ORM\OneToMany(targetEntity="Market3w\SiteBundle\Entity\Bill", mappedBy="client")
     */
    private $bills;
    
    /**
     * @var string
     * @ORM\Column(name="skype_pseudo", type="string", length=255, nullable=true)
     */
    protected $skypePseudo;
    
    /**
    * @ORM\OneToOne(targetEntity="Market3w\SiteBundle\Entity\Company", cascade={"remove", "persist"})
    * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=true)
    */
    private $company;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->addRole("ROLE_PROSPECT");
        
        $this->appointments  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seoStatistics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clients       = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bills         = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set mobilePhoneNumber
     *
     * @param string $mobilePhoneNumber
     * @return User
     */
    public function setMobilePhoneNumber($mobilePhoneNumber)
    {
        $this->mobilePhoneNumber = $mobilePhoneNumber;

        return $this;
    }

    /**
     * Get mobilePhoneNumber
     *
     * @return string 
     */
    public function getMobilePhoneNumber()
    {
        return $this->mobilePhoneNumber;
    }

    /**
     * Set skypePseudo
     *
     * @param string $skypePseudo
     * @return User
     */
    public function setSkypePseudo($skypePseudo)
    {
        $this->skypePseudo = $skypePseudo;

        return $this;
    }

    /**
     * Get skypePseudo
     *
     * @return string 
     */
    public function getSkypePseudo()
    {
        return $this->skypePseudo;
    }

    /**
     * Add appointments
     *
     * @param \Market3w\SiteBundle\Entity\Appointment $appointments
     * @return User
     */
    public function addAppointment(\Market3w\SiteBundle\Entity\Appointment $appointments)
    {
        $this->appointments[] = $appointments;

        return $this;
    }

    /**
     * Remove appointments
     *
     * @param \Market3w\SiteBundle\Entity\Appointment $appointments
     */
    public function removeAppointment(\Market3w\SiteBundle\Entity\Appointment $appointments)
    {
        $this->appointments->removeElement($appointments);
    }

    /**
     * Get appointments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAppointments()
    {
        return $this->appointments;
    }

    /**
     * Add bills
     *
     * @param \Market3w\SiteBundle\Entity\Bill $bills
     * @return User
     */
    public function addBill(\Market3w\SiteBundle\Entity\Bill $bills)
    {
        $this->bills[] = $bills;

        return $this;
    }

    /**
     * Remove bills
     *
     * @param \Market3w\SiteBundle\Entity\Bill $bills
     */
    public function removeBill(\Market3w\SiteBundle\Entity\Bill $bills)
    {
        $this->bills->removeElement($bills);
    }

    /**
     * Get bills
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBills()
    {
        return $this->bills;
    }

    /**
     * Add clients
     *
     * @param \Market3w\SiteBundle\Entity\User $clients
     * @return User
     */
    public function addClient(\Market3w\SiteBundle\Entity\User $clients)
    {
        $this->clients[] = $clients;

        return $this;
    }

    /**
     * Remove clients
     *
     * @param \Market3w\SiteBundle\Entity\User $clients
     */
    public function removeClient(\Market3w\SiteBundle\Entity\User $clients)
    {
        $this->clients->removeElement($clients);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Set webMarketeur
     *
     * @param \Market3w\SiteBundle\Entity\User $webMarketeur
     * @return User
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
     * Add seoStatistics
     *
     * @param \Market3w\SiteBundle\Entity\History $seoStatistics
     * @return User
     */
    public function addSeoStatistic(\Market3w\SiteBundle\Entity\History $seoStatistics)
    {
        $this->seoStatistics[] = $seoStatistics;

        return $this;
    }

    /**
     * Remove seoStatistics
     *
     * @param \Market3w\SiteBundle\Entity\History $seoStatistics
     */
    public function removeSeoStatistic(\Market3w\SiteBundle\Entity\History $seoStatistics)
    {
        $this->seoStatistics->removeElement($seoStatistics);
    }

    /**
     * Get seoStatistics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSeoStatistics()
    {
        return $this->seoStatistics;
    }
   
    /**
     * Set company
     *
     * @param \Market3w\SiteBundle\Entity\Company $company
     * @return User
     */
    public function setCompany(\Market3w\SiteBundle\Entity\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Market3w\SiteBundle\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    /**
     * Get readable roles
     *
     * @return array 
     */
    public function getReadableRoles()
    {
        $roles = $this->getRoles();
        $readableRoles = array();
        
        foreach ($roles as $role){
            $readableRoles[] = ucfirst(strtolower(str_replace('ROLE_', '', $role)));
        }
        
        return $readableRoles;
    }
}
