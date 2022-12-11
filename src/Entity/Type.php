<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
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
     * @ORM\OneToMany(targetEntity=Formation::class, mappedBy="type")
     */
    private $formaton;

    public function __construct()
    {
        $this->formaton = new ArrayCollection();
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

    /**
     * @return Collection<int, Formation>
     */
    public function getFormaton(): Collection
    {
        return $this->formaton;
    }

    public function addFormaton(Formation $formaton): self
    {
        if (!$this->formaton->contains($formaton)) {
            $this->formaton[] = $formaton;
            $formaton->setType($this);
        }

        return $this;
    }

    public function removeFormaton(Formation $formaton): self
    {
        if ($this->formaton->removeElement($formaton)) {
            // set the owning side to null (unless already changed)
            if ($formaton->getType() === $this) {
                $formaton->setType(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
