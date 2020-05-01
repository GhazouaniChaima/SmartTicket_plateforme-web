<?php

namespace AdminBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Commentaire;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\EvenementRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Evenement
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
     * @ORM\Column(name="titreEvenement", type="string", length=255)
     */
    private $titreEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuEvenement", type="string", length=255)
     */
    private $lieuEvenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="vues", type="integer", nullable=true)
     */
    private $vues;




    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateDebutEvenement", type="date")
     */
    private $dateDebutEvenement;

    /**
     * @var \Date
     *
     * @ORM\Column(name="dateFinEvenement", type="date")
     */
    private $dateFinEvenement;

    /**
     * @var \Time
     *
     * @ORM\Column(name="heureDebutEvenement", type="time")
     */
    private $heureDebutEvenement;

    /**
     * @var \Time
     *
     * @ORM\Column(name="heureFinEvenement", type="time")
     */
    private $heureFinEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEvenement", type="string", length=99999999, nullable=true)
     */
    private $descriptionEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;


    /**
     * @var float
     *
     * @ORM\Column(name="noteGlobale", type="float", nullable=true)
     */
    private $noteGlobale;

    /**
     * @var string
     *
     * @ORM\Column(name="dateCreationEvenement", type="datetime")
     */
    private $dateCreationEvenement;



    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",
    inversedBy="Evenements")
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categorie",
    inversedBy="Eveenements")
     */
    private $categorie;


    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\Classebillet",cascade={"persist", "remove"}, mappedBy="evenement")
     */
    private $Classebillets;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commentaire", mappedBy="evenement", cascade={"remove"})
     */
    private $commentaire;

    private $minPrice = null;

    /**
     * @Assert\File(maxSize="600000000000000")
     */
    private $file;

    private $temp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path="profile.png";

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move($this->getUploadRootDir(), $this->path);
        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            if(file_exists($this->getUploadRootDir().'/'.$this->temp)) {
                unlink($this->getUploadRootDir() . '/' . $this->temp);
                // clear the temp image path
                $this->temp = null;
            }
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }


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
     * Set titreEvenement
     *
     * @param string $titreEvenement
     * @return Evenement
     */
    public function setTitreEvenement($titreEvenement)
    {
        $this->titreEvenement = $titreEvenement;

        return $this;
    }

    /**
     * Get titreEvenement
     *
     * @return string
     */
    public function getTitreEvenement()
    {
        return $this->titreEvenement;
    }





    /**
     * Set lieuEvenement
     *
     * @param string $lieuEvenement
     * @return Evenement
     */
    public function setLieuEvenement($lieuEvenement)
    {
        $this->lieuEvenement = $lieuEvenement;

        return $this;
    }

    /**
     * Get lieuEvenement
     *
     * @return string
     */
    public function getLieuEvenement()
    {
        return $this->lieuEvenement;
    }

    /**
     * Set dateDebutEvenement
     *
     * @param \DateTime $dateDebutEvenement
     * @return Evenement
     */
    public function setDateDebutEvenement($dateDebutEvenement)
    {
        $this->dateDebutEvenement = $dateDebutEvenement;

        return $this;
    }

    /**
     * Get dateDebutEvenement
     *
     * @return \DateTime
     */
    public function getDateDebutEvenement()
    {
        return $this->dateDebutEvenement;
    }

    /**
     * Set dateFinEvenement
     *
     * @param \DateTime $dateFinEvenement
     * @return Evenement
     */
    public function setDateFinEvenement($dateFinEvenement)
    {
        $this->dateFinEvenement = $dateFinEvenement;

        return $this;
    }

    /**
     * Get dateFinEvenement
     *
     * @return \DateTime
     */
    public function getDateFinEvenement()
    {
        return $this->dateFinEvenement;
    }

    /**
     * Set heureDebutEvenement
     *
     * @param \DateTime $heureDebutEvenement
     * @return Evenement
     */
    public function setHeureDebutEvenement($heureDebutEvenement)
    {
        $this->heureDebutEvenement = $heureDebutEvenement;

        return $this;
    }

    /**
     * Get heureDebutEvenement
     *
     * @return \DateTime
     */
    public function getHeureDebutEvenement()
    {
        return $this->heureDebutEvenement;
    }

    /**
     * Set heureFinEvenement
     *
     * @param \DateTime $heureFinEvenement
     * @return Evenement
     */
    public function setHeureFinEvenement($heureFinEvenement)
    {
        $this->heureFinEvenement = $heureFinEvenement;

        return $this;
    }

    /**
     * Get heureFinEvenement
     *
     * @return \DateTime
     */
    public function getHeureFinEvenement()
    {
        return $this->heureFinEvenement;
    }

    /**
     * Set descriptionEvenement
     *
     * @param string $descriptionEvenement
     * @return Evenement
     */
    public function setDescriptionEvenement($descriptionEvenement)
    {
        $this->descriptionEvenement = $descriptionEvenement;

        return $this;
    }

    /**
     * Get descriptionEvenement
     *
     * @return string
     */
    public function getDescriptionEvenement()
    {
        return $this->descriptionEvenement;
    }

    /**
     * Set dateCreationEvenement
     *
     * @param \DateTime $dateCreationEvenement
     * @return Evenement
     */
    public function setDateCreationEvenement($dateCreationEvenement)
    {
        $this->dateCreationEvenement = $dateCreationEvenement;

        return $this;
    }

    /**
     * Get dateCreationEvenement
     *
     * @return \DateTime
     */
    public function getDateCreationEvenement()
    {
        return $this->dateCreationEvenement;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return Evenement
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     * @return Evenement
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Classebillets = new ArrayCollection();
    }








    /**
     * Set vues
     *
     * @param integer $vues
     *
     * @return Evenement
     */
    public function setVues($vues)
    {
        $this->vues = $vues;

        return $this;
    }

    /**
     * Get vues
     *
     * @return integer
     */
    public function getVues()
    {
        return $this->vues;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Evenement
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Evenement
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
     * Add classebillet
     *
     * @param \AdminBundle\Entity\Classebillet $classebillet
     *
     * @return Evenement
     */
    public function addClassebillet(Classebillet $classebillet)
    {
        $classebillet->setEvenement($this);

        $this->Classebillets->add($classebillet);
    }

    /**
     * Remove classebillet
     *
     * @param \AdminBundle\Entity\Classebillet $classebillet
     */
    public function removeClassebillet(\AdminBundle\Entity\Classebillet $classebillet)
    {
        $this->Classebillets->removeElement($classebillet);
    }

    /**
     * Get classebillets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClassebillets()
    {
        return $this->Classebillets;
    }

    /**
     * Add commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     *
     * @return Evenement
     */
    public function addCommentaire(\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire->removeElement($commentaire);
    }

    /**
     * Get commentaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }


    /**
     * Set noteGlobale
     *
     * @param float $noteGlobale
     *
     * @return Evenement
     */
    public function setNoteGlobale($noteGlobale)
    {
        $this->noteGlobale = $noteGlobale;

        return $this;
    }

    /**
     * Get noteGlobale
     *
     * @return float
     */
    public function getNoteGlobale()
    {
        $noteGlobale=0;
        $total = 0;
        foreach ($this->commentaire as $commentaire)
        {
            if(!is_null($commentaire->getNote())){
                $noteGlobale += $commentaire->getNote();
                $total++;
            }
        }
        return $total ? $noteGlobale/$total: 0 ;
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return mixed
     */
    public function getMinPrice()
    {

        foreach ($this->getClassebillets() as $classe){
           if(($classe->getTarif() < $this->minPrice) || is_null($this->minPrice)){
               $this->minPrice = $classe->getTarif();
           }
        }
        return $this->minPrice;
    }


}
