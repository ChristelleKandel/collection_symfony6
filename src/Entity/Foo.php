<?php

namespace App\Entity;

use Assert\Cascade;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FooRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FooRepository::class)]
#[Assert\Cascade]
class Foo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @ORM\OneToMany(targetEntity=Bar::class, mappedBy="foo", orphanRemoval=true, cascade={"persist"})
     */
    // #[ORM\OneToMany(mappedBy: 'foo', targetEntity: Bar::class)]
    private Collection $bars;

    /**
     * @ORM\OneToMany(targetEntity=Baz::class, mappedBy="foo", orphanRemoval=true, cascade={"persist"})
     */
    // #[ORM\OneToMany(mappedBy: 'foo', targetEntity: Baz::class)]
    private Collection $bazs;

    /**
     * @ORM\OneToMany(targetEntity=Buz::class, mappedBy="foo", orphanRemoval=true, cascade={"persist"})
     */
    // #[ORM\OneToMany(mappedBy: 'foo', targetEntity: Buz::class)]
    private Collection $buzes;

    public function __construct()
    {
        $this->bars = new ArrayCollection();
        $this->bazs = new ArrayCollection();
        $this->buzes = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Bar>
     */
    public function getBars(): Collection
    {
        return $this->bars;
    }

    public function addBar(Bar $bar): static
    {
        if (!$this->bars->contains($bar)) {
            $this->bars->add($bar);
            $bar->setFoo($this);
        }

        return $this;
    }

    public function removeBar(Bar $bar): static
    {
        if ($this->bars->removeElement($bar)) {
            // set the owning side to null (unless already changed)
            if ($bar->getFoo() === $this) {
                $bar->setFoo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Baz>
     */
    public function getBazs(): Collection
    {
        return $this->bazs;
    }

    public function addBaz(Baz $baz): static
    {
        if (!$this->bazs->contains($baz)) {
            $this->bazs->add($baz);
            $baz->setFoo($this);
        }

        return $this;
    }

    public function removeBaz(Baz $baz): static
    {
        if ($this->bazs->removeElement($baz)) {
            // set the owning side to null (unless already changed)
            if ($baz->getFoo() === $this) {
                $baz->setFoo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Buz>
     */
    public function getBuzes(): Collection
    {
        return $this->buzes;
    }

    public function addBuz(Buz $buz): static
    {
        if (!$this->buzes->contains($buz)) {
            $this->buzes->add($buz);
            $buz->setFoo($this);
        }

        return $this;
    }

    public function removeBuz(Buz $buz): static
    {
        if ($this->buzes->removeElement($buz)) {
            // set the owning side to null (unless already changed)
            if ($buz->getFoo() === $this) {
                $buz->setFoo(null);
            }
        }

        return $this;
    }
}
