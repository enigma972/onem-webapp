<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OffreRepository")
 */
class Offre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePublication;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateExpiration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enterprise", inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enterprise;

    /**
     * @ORM\Column(type="string")
     */
    private $poste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieuAffectation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $formation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $experience;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="offre", orphanRemoval=true)
     */
    private $comments;



    public function __construct()
    {
        $this->datePublication = new \DateTime();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration(\DateTimeInterface $dateExpiration): self
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    public function getEnterprise(): ?Enterprise
    {
        return $this->enterprise;
    }

    public function setEnterprise(?Enterprise $enterprise): self
    {
        $this->enterprise = $enterprise;

        return $this;
    }

    public function __toString()
    {
        return $this->getTitre();
    }

    public function getSummary()
    {
        return 'Lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem lorem';
        return substr($this->getLibelle(), 1, 100);
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getLieuAffectation(): ?string
    {
        return $this->lieuAffectation;
    }

    public function setLieuAffectation(?string $lieuAffectation): self
    {
        $this->lieuAffectation = $lieuAffectation;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(?string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setOffre($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getOffre() === $this) {
                $comment->setOffre(null);
            }
        }

        return $this;
    }
}
