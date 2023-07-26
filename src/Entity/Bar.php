<?php

namespace App\Entity;

use App\Repository\BarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarRepository::class)]
class Bar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @ORM\ManyToOne(targetEntity=Foo::class, inversedBy="bars")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE", cascade={"persist"})
     */
    // #[ORM\ManyToOne(inversedBy: 'bars')]
    private ?Foo $foo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFoo(): ?Foo
    {
        return $this->foo;
    }

    public function setFoo(?Foo $foo): static
    {
        $this->foo = $foo;

        return $this;
    }
}
