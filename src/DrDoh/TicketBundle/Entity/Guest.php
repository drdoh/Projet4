<?php

namespace DrDoh\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guest
 *
 * @ORM\Table(name="guest")
 * @ORM\Entity(repositoryClass="DrDoh\TicketBundle\Repository\GuestRepository")
 */
class Guest
{   
/***************************** ATTRIBUTE *************************/
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date")
     */
    private $birthDate;

    /**
     * @var int
     *
     * @ORM\OneToOne(targetEntity="DrDoh\TicketBundle\Entity\Ticket", cascade={"persist"})
     */
    private $ticketId;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="DrDoh\TicketBundle\Entity\Discount", cascade={"persist"})
     */
    private $discountType;



/***************************** CONSTRUCTOR *************************/
        
    public function __construct(){

        

    }

/***************************** GETTER & SETTER *************************/

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Guest
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
     *
     * @return Guest
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
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return Guest
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set ticketId
     *
     * @param integer $ticketId
     *
     * @return Guest
     */
    public function setTicketId($ticketId)
    {
        $this->ticketId = $ticketId;

        return $this;
    }

    /**
     * Get ticketId
     *
     * @return int
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     * Set discountType
     *
     * @param string $discountType
     *
     * @return Guest
     */
    public function setDiscountType($discountType)
    {
        $this->discountType = $discountType;

        return $this;
    }

    /**
     * Get discountType
     *
     * @return string
     */
    public function getDiscountType()
    {
        return $this->discountType;
    }

/***************************** ADD & REMOVE *************************/

    /**
     * Add discountType.
     *
     * @param \DrDroh\TicketBundle\Entity\Discount $discountType
     *
     * @return Guest
     */
    public function addDiscountType(\DrDroh\TicketBundle\Entity\Discount $discountType)
    {
        $this->discountType[] = $discountType;

        return $this;
    }

    /**
     * Remove discountType.
     *
     * @param \DrDroh\TicketBundle\Entity\Discount $discountType
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDiscountType(\DrDroh\TicketBundle\Entity\Discount $discountType)
    {
        return $this->discountType->removeElement($discountType);
    }
}
