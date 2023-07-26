<?php

namespace App\Entity;

use App\Repository\BuzRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuzRepository::class)]
class Buz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @ORM\ManyToOne(targetEntity=Foo::class, inversedBy="buzes")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE" ,cascade={"persist"})
     */
    // #[ORM\ManyToOne(inversedBy: 'buzes')]
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
