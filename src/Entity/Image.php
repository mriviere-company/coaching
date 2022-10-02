<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 300)]
    private string $name;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $position;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Page $page;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    /**
     * @return ?Page
     */
    public function getPage(): ?Page
    {
        return $this->page;
    }

    /**
     * @param ?Page $page
     */
    public function setPage(?Page $page): void
    {
        $this->page = $page;
    }
}
