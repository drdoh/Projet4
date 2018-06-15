<?php

namespace DrDoh\TicketBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * 
     */
    private $ticket; //Liste d'objet

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="DrDoh\TicketBundle\Entity\Discount", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $discountType; 


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
     * Set ticket.
     *
     * @param \DrDoh\TicketBundle\Entity\Ticket|null $ticket
     *
     * @return Guest
     */
    public function setTicket(\DrDoh\TicketBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket.
     *
     * @return \DrDoh\TicketBundle\Entity\Ticket|null
     */
    public function getTicket()
    {
        return $this->ticket;
    }



    /**
     * Set discountType.
     *
     * @param \DrDoh\TicketBundle\Entity\Discount|null $discountType
     *
     * @return Guest
     */
    public function setDiscountType(\DrDoh\TicketBundle\Entity\Discount $discountType = null)
    {
        $this->discountType = $discountType;

        return $this;
    }

    /**
     * Get discountType.
     *
     * @return \DrDoh\TicketBundle\Entity\Discount|null
     */
    public function getDiscountType()
    {
        return $this->discountType;
    }
}
