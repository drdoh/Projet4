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
     * @ORM\Column(name="ticket_id", type="integer")
     */
    private $ticketId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reserved_date", type="datetime")
     */
    private $reservedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="booking_date", type="datetime")
     */
    private $bookingDate;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_type", type="string", length=255, nullable=true)
     */
    private $discountType;

    /**
     * @var int
     *
     * @ORM\Column(name="amount_paid", type="integer", nullable=true)
     */
    private $amountPaid;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="main_guest", type="boolean")
     */
    private $main_guest = false;


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
     * Set reservedDate
     *
     * @param \DateTime $reservedDate
     *
     * @return Guest
     */
    public function setReservedDate($reservedDate)
    {
        $this->reservedDate = $reservedDate;

        return $this;
    }

    /**
     * Get reservedDate
     *
     * @return \DateTime
     */
    public function getReservedDate()
    {
        return $this->reservedDate;
    }

    /**
     * Set bookingDate
     *
     * @param \DateTime $bookingDate
     *
     * @return Guest
     */
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    /**
     * Get bookingDate
     *
     * @return \DateTime
     */
    public function getBookingDate()
    {
        return $this->bookingDate;
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

    /**
     * Set amountPaid
     *
     * @param integer $amountPaid
     *
     * @return Guest
     */
    public function setAmountPaid($amountPaid)
    {
        $this->amountPaid = $amountPaid;

        return $this;
    }

    /**
     * Get amountPaid
     *
     * @return int
     */
    public function getAmountPaid()
    {
        return $this->amountPaid;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Guest
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set main_guest
     *
     * @param boolean $main_guest
     *
     * @return Guest
     */
    public function setMainGuest($main_guest)
    {
        $this->main_guest = $main_guest;

        return $this;
    }

    /**
     * Get email
     *
     * @return boolean
     */
    public function getMainGuest()
    {
        return $this->main_guest;
    }
}

