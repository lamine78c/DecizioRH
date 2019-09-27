<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * ContractType
 *
 * @ORM\Table(name="contract_type")
 * @ORM\Entity(repositoryClass="App\Repository\ContractTypeRepository")
 */
class ContractType
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=16)
     */
    private $name;

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
}
