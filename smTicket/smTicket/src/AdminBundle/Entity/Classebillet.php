<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classebillet
 *
 * @ORM\Table(name="classebillet")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\ClassebilletRepository")
 */
class Classebillet
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
     * @var float
     *
     * @ORM\Column(name="tarif", type="float")
     */
    private $tarif;

    /**
     * @var string
     *
     * @ORM\Column(name="classe", type="string", length=255)
     */
    private $classe;

    /**
     * @var integer
     *
     * @ORM\Column(name="qntbillet", type="integer")
     */
    private $qntbillet;

    /**
     * @var integer
     *
     * @ORM\Column(name="qntStock", type="integer", nullable=true)
     */
    private $qntStock;

    /**
     * @ORM\OneToMany(targetEntity="ClientBundle\Entity\ElementCmd",cascade={"persist", "remove"}, mappedBy="Classebillet")
     */
    private $elementCmd;

    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Evenement",
    inversedBy="Classebillets")
     */
    private $evenement;


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
     * Set tarif
     *
     * @param float $tarif
     *
     * @return Classebillet
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return float
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set classe
     *
     * @param string $classe
     *
     * @return Classebillet
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }



    /**
     * Set evenement
     *
     * @param \AdminBundle\Entity\Evenement $evenement
     *
     * @return Classebillet
     */
    public function setEvenement(\AdminBundle\Entity\Evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \AdminBundle\Entity\Evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->elementCmd = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set qntbillet
     *
     * @param integer $qntbillet
     *
     * @return Classebillet
     */
    public function setQntbillet($qntbillet)
    {
        $this->qntbillet = $qntbillet;

        return $this;
    }

    /**
     * Get qntbillet
     *
     * @return integer
     */
    public function getQntbillet()
    {
        return $this->qntbillet;
    }

    /**
     * Set qntStock
     *
     * @param integer $qntStock
     *
     * @return Classebillet
     */
    public function setQntStock($qntStock)
    {
        $this->qntStock = $qntStock;

        return $this;
    }

    /**
     * Get qntStock
     *
     * @return integer
     */
    public function getQntStock()
    {
        return $this->qntStock;
    }

    /**
     * Add elementCmd
     *
     * @param \ClientBundle\Entity\ElementCmd $elementCmd
     *
     * @return Classebillet
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
}
