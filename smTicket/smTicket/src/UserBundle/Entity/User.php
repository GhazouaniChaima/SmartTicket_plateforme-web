<?php



namespace UserBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

   

    
    
    public function __construct() {
        parent::__construct();
        // your own logic
    }


    
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="dateCreationCompte", type="datetime", nullable=true)
     */
    private $dateCreationCompte;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="tel", type="integer", nullable=true)
     */
    private $tel;

    /**
     * @Assert\File(maxSize="6000000")
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commentaire", mappedBy="usercoment", cascade={"remove"})
     */
    private $commentaires;


    /**
     * @ORM\OneToMany(targetEntity="ClientBundle\Entity\temoignage", mappedBy="usertemg", cascade={"remove"})
     */
    private $temoignages;


    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\Evenement",cascade={"remove"}, mappedBy="user")
     */
    private $Evenements;


    /**
     * @ORM\OneToMany(targetEntity="AdminBundle\Entity\Evenement",cascade={"remove"}, mappedBy="usercomd")
     */
    private $commande;





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
     * Add Evenements
     *
     * @param \AdminBundle\Entity\Evenement $evenements
     * @return User
     */
    public function addEvenement(\AdminBundle\Entity\Evenement $evenements)
    {
        $this->Evenements[] = $evenements;

        return $this;
    }

    /**
     * Remove Evenements
     *
     * @param \AdminBundle\Entity\Evenement $evenements
     */
    public function removeEvenement(\AdminBundle\Entity\Evenement $evenements)
    {
        $this->Evenements->removeElement($evenements);
    }

    /**
     * Get Evenements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvenements()
    {
        return $this->Evenements;
    }




    /**
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set dateCreationCompte
     *
     * @param \DateTime $dateCreationCompte
     * @return User
     */
    public function setDateCreationCompte($dateCreationCompte)
    {
        $this->dateCreationCompte = $dateCreationCompte;

        return $this;
    }

    /**
     * Get dateCreationCompte
     *
     * @return \DateTime 
     */
    public function getDateCreationCompte()
    {
        return $this->dateCreationCompte;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return integer 
     */
    public function getTel()
    {
        return $this->tel;
    }


        /**
     * Add commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     *
     * @return User
     */
    public function addCommentaire(\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \AppBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Add temoignage
     *
     * @param \ClientBundle\Entity\temoignage $temoignage
     *
     * @return User
     */
    public function addTemoignage(\ClientBundle\Entity\temoignage $temoignage)
    {
        $this->temoignages[] = $temoignage;

        return $this;
    }

    /**
     * Remove temoignage
     *
     * @param \ClientBundle\Entity\temoignage $temoignage
     */
    public function removeTemoignage(\ClientBundle\Entity\temoignage $temoignage)
    {
        $this->temoignages->removeElement($temoignage);
    }

    /**
     * Get temoignages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemoignages()
    {
        return $this->temoignages;
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
     * Add commande
     *
     * @param \AdminBundle\Entity\Evenement $commande
     *
     * @return User
     */
    public function addCommande(\AdminBundle\Entity\Evenement $commande)
    {
        $this->commande[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \AdminBundle\Entity\Evenement $commande
     */
    public function removeCommande(\AdminBundle\Entity\Evenement $commande)
    {
        $this->commande->removeElement($commande);
    }

    /**
     * Get commande
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommande()
    {
        return $this->commande;
    }
}
