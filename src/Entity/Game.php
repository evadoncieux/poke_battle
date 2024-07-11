<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    /**
     * @var Collection<int, Pokemon>
     */
    #[ORM\ManyToMany(targetEntity: Pokemon::class)]
    private Collection $pokemon;

    #[ORM\Column]
    private ?int $numberOfCards = null;

    #[ORM\Column]
    private ?int $dificulty = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $finishedAt = null;

    #[ORM\Column]
    private ?int $NumberofAttempts = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function __construct()
    {
        $this->pokemon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): static
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getPokemon(): Collection
    {
        return $this->pokemon;
    }

    public function addPokemon(Pokemon $pokemon): static
    {
        if (!$this->pokemon->contains($pokemon)) {
            $this->pokemon->add($pokemon);
        }

        return $this;
    }

    public function removePokemon(Pokemon $pokemon): static
    {
        $this->pokemon->removeElement($pokemon);

        return $this;
    }

    public function getNumberOfCards(): int
    {
        return $this->numberOfCards;
    }

    public function setNumberOfCards(int $numberOfCards): static
    {
        $this->numberOfCards = $numberOfCards;

        return $this;
    }

    public function getDificulty(): ?int
    {
        return $this->dificulty;
    }

    public function setDificulty(int $dificulty): static
    {
        $this->dificulty = $dificulty;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getStartedAt(): ?\DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function setStartedAt(\DateTimeImmutable $startedAt): static
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    public function getFinishedAt(): ?\DateTimeImmutable
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(\DateTimeImmutable $finishedAt): static
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }

    public function getNumberofAttempts(): ?int
    {
        return $this->NumberofAttempts;
    }

    public function setNumberofAttempts(int $NumberofAttempts): static
    {
        $this->NumberofAttempts = $NumberofAttempts;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
