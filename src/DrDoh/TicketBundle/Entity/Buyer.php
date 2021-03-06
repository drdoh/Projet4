<?php

namespace DrDoh\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Buyer
 *
 * @ORM\Table(name="buyer")
 * @ORM\Entity(repositoryClass="DrDoh\TicketBundle\Repository\BuyerRepository")
 */
class Buyer
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
     * @var int
     *
     * @ORM\Column(name="orderId", type="string",length=255, unique=true)
     */
    private $orderId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="orderDate", type="datetime")
     */
    private $orderDate;

    /**
     * @var int
     *
     * @ORM\Column(name="amountPaid", type="integer")
     */
    private $amountPaid;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * 
     * @ORM\OneToMany(targetEntity="DrDoh\TicketBundle\Entity\Ticket", mappedBy="buyer",cascade={"persist"})
     * 
     * @Assert\Valid()
     */
    private $ticket;

/***************************** CONSTRUCTOR *************************/
      
public function __construct(){
    $uniqueId =  sha1(uniqid('',true));
    $this->orderId = $uniqueId;
    $this->orderDate = new \Datetime();    
}

/***************************** GETTER & SETTER *************************/
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set orderId.
     *
     * @param int $orderId
     *
     * @return Buyer
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId.
     *
     * @return int
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set orderDate.
     *
     * @param \DateTime $orderDate
     *
     * @return Buyer
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get orderDate.
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set amountPaid.
     *
     * @param int $amountPaid
     *
     * @return Buyer
     */
    public function setAmountPaid($amountPaid)
    {
        $this->amountPaid = $amountPaid;

        return $this;
    }

    /**
     * Get amountPaid.
     *
     * @return int
     */
    public function getAmountPaid()
    {
        return $this->amountPaid;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Buyer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Add billet.
     *
     * @param \Louvre\TicketingBundle\Entity\Ticket $billet
     *
     * @return Buyer
     */
    public function addTicket(\DrDoh\TicketBundle\Entity\Ticket $ticket)
    {
        $this->ticket[] = $ticket;
        $ticket->setBuyer($this);
        return $this;
    }

    /**
     * Remove billet.
     *
     * @param \Louvre\TicketingBundle\Entity\Ticket $billet
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTicket(\DrDoh\TicketBundle\Entity\Ticket $ticket)
    {
        return $this->ticket->removeElement($ticket);
    }

    /**
     * Get billet.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
