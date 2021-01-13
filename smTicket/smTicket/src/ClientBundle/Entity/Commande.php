<?php

namespace ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="ClientBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * @var bool
     *
     * @ORM\Column(name="payer", type="boolean")
     */
    private $payer;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",
    inversedBy="commande")
      */
    private $usercomd;


    /**
     * @ORM\OneToMany(targetEntity="ClientBundle\Entity\ElementCmd",
    cascade={"persist", "remove"}, mappedBy="commande")
     */
    private $elementCmd;

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
     * @return Commande
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Commande
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
     * Constructor
     */
    public function __construct()
    {
        $this->elementCmd = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set payer
     *
     * @param boolean $payer
     *
     * @return Commande
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * Get payer
     *
     * @return boolean
     */
    public function getPayer()
    {
        return $this->payer;
    }




    /**
     * Add elementCmd
     *
     * @param \ClientBundle\Entity\ElementCmd $elementCmd
     *
     * @return Commande
     */
    public function addElementCmd(\ClientBundle\Entity\ElementCmd $elementCmd)
    {
        $this->elementCmd[] = $elementCmd;

        return $this;
    }

    /**
     * Remove elementCmd
     *
     * @param \ClientBundle\Entity\ElementCmd $elementCmd
     */
    public function removeElementCmd(\ClientBundle\Entity\ElementCmd $elementCmd)
    {
        $this->elementCmd->removeElement($elementCmd);
    }

    /**
     * Get elementCmd
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getElementCmd()
    {
        return $this->elementCmd;
    }

    /**
     * Set usercomd
     *
     * @param \UserBundle\Entity\User $usercomd
     *
     * @return Commande
     */
    public function setUsercomd(\UserBundle\Entity\User $usercomd = null)
    {
        $this->usercomd = $usercomd;

        return $this;
    }

    /**
     * Get usercomd
     *
     * @return \UserBundle\Entity\User
     */
    public function getUsercomd()
    {
        return $this->usercomd;
    }
}