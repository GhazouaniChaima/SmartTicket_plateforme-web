<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentaireRepository")
 */
class Commentaire
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
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer", nullable=true)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreationCommentaire", type="datetime" , nullable=true)
     */
    private $dateCreationCommentaire;


    /**
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Evenement",
    inversedBy="commentaire")
     */
    private $evenement;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",
    inversedBy="commentaires")
     */
    private $usercoment;

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
     * Set content
     *
     * @param string $content
     *
     * @return Commentaire
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateCreationCommentaire
     *
     * @param \DateTime $dateCreationCommentaire
     *
     * @return Commentaire
     */
    public function setDateCreationCommentaire($dateCreationCommentaire)
    {
        $this->dateCreationCommentaire = $dateCreationCommentaire;

        return $this;
    }

    /**
     * Get dateCreationCommentaire
     *
     * @return \DateTime
     */
    public function getDateCreationCommentaire()
    {
        return $this->dateCreationCommentaire;
    }

    /**
     * Set evenement
     *
     * @param \AdminBundle\Entity\Evenement $evenement
     *
     * @return Commentaire
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
     * Set usercoment
     *
     * @param \UserBundle\Entity\User $usercoment
     *
     * @return Commentaire
     */
    public function setUsercoment(\UserBundle\Entity\User $usercoment = null)
    {
        $this->usercoment = $usercoment;

        return $this;
    }

    /**
     * Get usercoment
     *
     * @return \UserBundle\Entity\User
     */
    public function getUsercoment()
    {
        return $this->usercoment;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return Commentaire
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }
}
