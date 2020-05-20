<?php

namespace App\Entity;

use App\Repository\MarketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarketRepository::class)
 */
class Market
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
    private $track;

    /**
     * @ORM\Column(type="integer")
     */
    private $pc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @ORM\Column(type="integer")
     */
    private $time_from;

    /**
     * @ORM\Column(type="integer")
     */
    private $time_to;

    /**
     * @ORM\OneToMany(targetEntity=CommentMarket::class, mappedBy="market", orphanRemoval=true)
     */
    private $commentMarkets;

    /**
     * @ORM\ManyToMany(targetEntity=Day::class, inversedBy="markets")
     */
    private $day;

    /**
     * @ORM\ManyToMany(targetEntity=Stand::class, inversedBy="markets")
     */
    private $stand;

    public function __construct()
    {
        $this->commentMarkets = new ArrayCollection();
        $this->day = new ArrayCollection();
        $this->stand = new ArrayCollection();
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

    public function getTrack(): ?string
    {
        return $this->track;
    }

    public function setTrack(string $track): self
    {
        $this->track = $track;

        return $this;
    }

    public function getPc(): ?int
    {
        return $this->pc;
    }

    public function setPc(int $pc): self
    {
        $this->pc = $pc;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getTimeFrom(): ?int
    {
        return $this->time_from;
    }

    public function setTimeFrom(int $time_from): self
    {
        $this->time_from = $time_from;

        return $this;
    }

    public function getTimeTo(): ?int
    {
        return $this->time_to;
    }

    public function setTimeTo(int $time_to): self
    {
        $this->time_to = $time_to;

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
            $commentMarket->setMarket($this);
        }

        return $this;
    }

    public function removeCommentMarket(CommentMarket $commentMarket): self
    {
        if ($this->commentMarkets->contains($commentMarket)) {
            $this->commentMarkets->removeElement($commentMarket);
            // set the owning side to null (unless already changed)
            if ($commentMarket->getMarket() === $this) {
                $commentMarket->setMarket(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Day[]
     */
    public function getDay(): Collection
    {
        return $this->day;
    }

    public function addDay(Day $day): self
    {
        if (!$this->day->contains($day)) {
            $this->day[] = $day;
        }

        return $this;
    }

    public function removeDay(Day $day): self
    {
        if ($this->day->contains($day)) {
            $this->day->removeElement($day);
        }

        return $this;
    }

    /**
     * @return Collection|Stand[]
     */
    public function getStand(): Collection
    {
        return $this->stand;
    }

    public function addStand(Stand $stand): self
    {
        if (!$this->stand->contains($stand)) {
            $this->stand[] = $stand;
        }

        return $this;
    }

    public function removeStand(Stand $stand): self
    {
        if ($this->stand->contains($stand)) {
            $this->stand->removeElement($stand);
        }

        return $this;
    }
}
