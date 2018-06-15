<?php

namespace DrDoh\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="DrDoh\TicketBundle\Repository\TicketRepository")
 */
class Ticket
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="ticket_id", type="string", unique=true)
     */
    private $ticketId;

/***************************** CONSTRUCT *************************/
    public function __construct(){
        $uniqueId =  sha1(uniqid('',true));
        $this->ticketId = $uniqueId;
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Ticket
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
     * Set ticketId.
     *
     * @param int $ticketId
     *
     * @return Ticket
     */
    public function setTicketId($ticketId)
    {
        $this->ticketId = $ticketId;

        return $this;
    }

    /**
     * Get ticketId.
     *
     * @return int
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }
}
