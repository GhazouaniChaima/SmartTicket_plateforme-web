<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="libelleCategorie", type="string", length=255)
     */
    private $libelleCategorie;


    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\Evenement",cascade={"remove"}, mappedBy="categorie")
     */
    private $Eveenements;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelleCategorie
     *
     * @param string $libelleCategorie
     * @return Categorie
     */
    public function setLibelleCategorie($libelleCategorie)
    {
        $this->libelleCategorie = $libelleCategorie;

        return $this;
    }

    /**
     * Get libelleCategorie
     *
     * @return string 
     */
    public function getLibelleCategorie()
    {
        return $this->libelleCategorie;
    }

   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Eveenements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Eveenements
     *
     * @param \AdminBundle\Entity\Evenement $eveenements
     * @return Categorie
     */
    public function addEveenement(\AdminBundle\Entity\Evenement $eveenements)
    {
        $this->Eveenements[] = $eveenements;

        return $this;
    }

    /**
     * Remove Eveenements
     *
     * @param \AdminBundle\Entity\Evenement $eveenements
     */
    public function removeEveenement(\AdminBundle\Entity\Evenement $eveenements)
    {
        $this->Eveenements->removeElement($eveenements);
    }

    /**
     * Get Eveenements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEveenements()
    {
        return $this->Eveenements;
    }

    public function __toString()
    {
        return $this->getLibelleCategorie();
    }


}

