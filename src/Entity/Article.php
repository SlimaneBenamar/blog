<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modification;

    /**
     * @ORM\ManyToMany(targetEntity=Categories::class, inversedBy="articles")
     */
    private $id_categories;

    /**
     * @ORM\ManyToMany(targetEntity=MotCle::class, inversedBy="articles")
     */
    private $id_motcle;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="article", orphanRemoval=true)
     */
    private $id_commentaire;

    public function __construct()
    {
        $this->id_categories = new ArrayCollection();
        $this->id_motcle = new ArrayCollection();
        $this->id_commentaire = new ArrayCollection();
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

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }
    public function __toString()
    {
        return $this->titre;
    }
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('titre', new Assert\Length([
            'min' => 3,
            'max' => 50,
            'minMessage' => 'Your first name must be at least {{ limit }} characters long',
            'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters',
            'allowEmptyString' => false,
        ]));
    }

    /**
     * @return Collection|Categories[]
     */
    public function getIdCategories(): Collection
    {
        return $this->id_categories;
    }

    public function addIdCategory(Categories $idCategory): self
    {
        if (!$this->id_categories->contains($idCategory)) {
            $this->id_categories[] = $idCategory;
        }

        return $this;
    }

    public function removeIdCategory(Categories $idCategory): self
    {
        $this->id_categories->removeElement($idCategory);

        return $this;
    }

    /**
     * @return Collection|MotCle[]
     */
    public function getIdMotcle(): Collection
    {
        return $this->id_motcle;
    }

    public function addIdMotcle(MotCle $idMotcle): self
    {
        if (!$this->id_motcle->contains($idMotcle)) {
            $this->id_motcle[] = $idMotcle;
        }

        return $this;
    }

    public function removeIdMotcle(MotCle $idMotcle): self
    {
        $this->id_motcle->removeElement($idMotcle);

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getIdCommentaire(): Collection
    {
        return $this->id_commentaire;
    }

    public function addIdCommentaire(Commentaire $idCommentaire): self
    {
        if (!$this->id_commentaire->contains($idCommentaire)) {
            $this->id_commentaire[] = $idCommentaire;
            $idCommentaire->setArticle($this);
        }

        return $this;
    }

    public function removeIdCommentaire(Commentaire $idCommentaire): self
    {
        if ($this->id_commentaire->removeElement($idCommentaire)) {
            // set the owning side to null (unless already changed)
            if ($idCommentaire->getArticle() === $this) {
                $idCommentaire->setArticle(null);
            }
        }

        return $this;
    }
}
