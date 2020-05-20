<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=CommentMarket::class, mappedBy="user", orphanRemoval=true)
     */
    private $commentMarkets;

    public function __construct()
    {
        $this->commentMarkets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|CommentMarket[]
     */
    public function getCommentMarkets(): Collection
    {
        return $this->commentMarkets;
    }

    public function addCommentMarket(CommentMarket $commentMarket): self
    {
        if (!$this->commentMarkets->contains($commentMarket)) {
            $this->commentMarkets[] = $commentMarket;
            $commentMarket->setUser($this);
        }

        return $this;
    }

    public function removeCommentMarket(CommentMarket $commentMarket): self
    {
        if ($this->commentMarkets->contains($commentMarket)) {
            $this->commentMarkets->removeElement($commentMarket);
            // set the owning side to null (unless already changed)
            if ($commentMarket->getUser() === $this) {
                $commentMarket->setUser(null);
            }
        }

        return $this;
    }
}
