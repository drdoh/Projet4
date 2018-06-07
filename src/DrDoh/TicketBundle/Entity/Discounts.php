<?php

namespace DrDoh\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discounts
 *
 * @ORM\Table(name="discounts")
 * @ORM\Entity(repositoryClass="DrDoh\TicketBundle\Repository\DiscountsRepository")
 */
class Discounts
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
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;


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
     * Set type.
     *
     * @param string|null $type
     *
     * @return Discounts
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }
}
