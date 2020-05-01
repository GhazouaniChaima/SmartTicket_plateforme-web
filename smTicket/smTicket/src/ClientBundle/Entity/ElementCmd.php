<?php

namespace ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElementCmd
 *
 * @ORM\Table(name="element_cmd")
 * @ORM\Entity(repositoryClass="ClientBundle\Repository\ElementCmdRepository")
 */
class ElementCmd
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
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;


    /**
     * @ORM\ManyToOne(targetEntity="ClientBundle\Entity\Commande",
    inversedBy="elementCmd")
     */
    private $commande;


    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Classebillet",
    inversedBy="elementCmd")
     */
    private $Classebillet;

    /**
     * @ORM\OneToMany(targetEntity="ClientBundle\Entity\Ticket",
    cascade={"persist", "remove"}, mappedBy="elementcmd")
     */
    private $ticket;

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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return ElementCmd
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set commande
     *
     * @param \ClientBundle\Entity\Commande $commande
     *
     * @return ElementCmd
     */
    public function setCommande(\ClientBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \ClientBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * @return mixed
     */
    public function getClassebillet()
    {
        return $this->Classebillet;
    }

    /**
     * @param mixed $Classebillet
     */
    public function setClassebillet($Classebillet)
    {
        $this->Classebillet = $Classebillet;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ticket = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ticket
     *
     * @param \ClientBundle\Entity\Ticket $ticket
     *
     * @return ElementCmd
     */
    public function addTicket(\ClientBundle\Entity\Ticket $ticket)
    {
        $this->ticket[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \ClientBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\ClientBundle\Entity\Ticket $ticket)
    {
        $this->ticket->removeElement($ticket);
    }

    /**
     * Get ticket
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
