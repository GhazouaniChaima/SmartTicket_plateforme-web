<?php

namespace ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="ClientBundle\Repository\TicketRepository")
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
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateGeneration", type="datetime")
     */
    private $dateGeneration;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;


    /**
     * @ORM\ManyToOne(targetEntity="ClientBundle\Entity\ElementCmd",
    inversedBy="ticket")
     */
    private $elementcmd;

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
     * Set reference
     *
     * @param string $reference
     *
     * @return Ticket
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set dateGeneration
     *
     * @param \DateTime $dateGeneration
     *
     * @return Ticket
     */
    public function setDateGeneration($dateGeneration)
    {
        $this->dateGeneration = $dateGeneration;

        return $this;
    }

    /**
     * Get dateGeneration
     *
     * @return \DateTime
     */
    public function getDateGeneration()
    {
        return $this->dateGeneration;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Ticket
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set elementcmd
     *
     * @param \ClientBundle\Entity\ElementCmd $elementcmd
     *
     * @return Ticket
     */
    public function setElementcmd(\ClientBundle\Entity\ElementCmd $elementcmd = null)
    {
        $this->elementcmd = $elementcmd;

        return $this;
    }

    /**
     * Get elementcmd
     *
     * @return \ClientBundle\Entity\ElementCmd
     */
    public function getElementcmd()
    {
        return $this->elementcmd;
    }
}
