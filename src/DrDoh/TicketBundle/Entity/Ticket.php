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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="qte_max", type="integer")
     */
    private $qteMax;

    /**
     * @var int
     *
     * @ORM\Column(name="qte_sold", type="integer")
     */
    private $qteSold;


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
     * Set qteMax
     *
     * @param integer $qteMax
     *
     * @return Ticket
     */
    public function setQteMax($qteMax)
    {
        $this->qteMax = $qteMax;

        return $this;
    }

    /**
     * Get qteMax
     *
     * @return int
     */
    public function getQteMax()
    {
        return $this->qteMax;
    }

    /**
     * Set qteSold
     *
     * @param integer $qteSold
     *
     * @return Ticket
     */
    public function setQteSold($qteSold)
    {
        $this->qteSold = $qteSold;

        return $this;
    }

    /**
     * Get qteSold
     *
     * @return int
     */
    public function getQteSold()
    {
        return $this->qteSold;
    }
}

