<?php

namespace DrDoh\TicketBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Guest
 *
 * @ORM\Table(name="guest")
 * @ORM\Entity(repositoryClass="DrDoh\TicketBundle\Repository\GuestRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"guest" = "Guest", "buyer" = "Buyer"})
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
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

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
     * @ORM\Column(name="discount", type="string", length=255))
     */
    private $discount; 

    /**
     * @var string
     *
     * @ORM\Column(name="agreed", type="boolean", length=255))
     */
    private $agreed; 


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
     * Set country.
     *
     * @param string $country
     *
     * @return Guest
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set discount.
     *
     * @param string $discount
     *
     * @return Guest
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount.
     *
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set agreed.
     *
     * @param bool $agreed
     *
     * @return Guest
     */
    public function setAgreed($agreed)
    {
        $this->agreed = $agreed;

        return $this;
    }

    /**
     * Get agreed.
     *
     * @return bool
     */
    public function getAgreed()
    {
        return $this->agreed;
    }
}
