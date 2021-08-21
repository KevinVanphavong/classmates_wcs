<?php

namespace App\Entity;

use App\Repository\WilderImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WilderImageRepository::class)
 */
class WilderImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Wilder::class, inversedBy="wilderImage", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $wilder;

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

    public function getWilder(): ?Wilder
    {
        return $this->wilder;
    }

    public function setWilder(Wilder $wilder): self
    {
        $this->wilder = $wilder;

        return $this;
    }
}
