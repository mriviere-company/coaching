<?php

namespace App\Entity;

use App\Repository\TrackRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrackRepository::class)]
class Track
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 30)]
    private string $page;

    #[ORM\Column(length: 40)]
    private string $ip;

    #[ORM\Column(length: 40)]
    private string $browser;

    #[ORM\Column(length: 20)]
    private string $computer;

    #[ORM\Column(length: 50)]
    private string $previousPage;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeImmutable $saveAt;

    public function __construct()
    {
        $this->saveAt = new DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPage(): string
    {
        return $this->page;
    }

    public function setPage(string $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getBrowser(): string
    {
        return $this->browser;
    }

    public function setBrowser(string $browser): self
    {
        $this->browser = $browser;

        return $this;
    }

    public function getComputer(): string
    {
        return $this->computer;
    }

    public function setComputer(string $computer): self
    {
        $this->computer = $computer;

        return $this;
    }

    public function getPreviousPage(): string
    {
        return $this->previousPage;
    }

    public function setPreviousPage(string $previousPage): self
    {
        $this->previousPage = $previousPage;

        return $this;
    }

    public function getSaveAt(): DateTimeImmutable
    {
        return $this->saveAt;
    }

    public function setSaveAt(DateTimeImmutable $saveAt): self
    {
        $this->saveAt = $saveAt;

        return $this;
    }
}
