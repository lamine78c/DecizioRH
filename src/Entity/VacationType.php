<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VacationType
 *
 * @ORM\Table(name="vacation_type")
 * @ORM\Entity(repositoryClass="App\Repository\VacationTypeRepository")
 */
class VacationType
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
     * @ORM\Column(name="name", type="string", length=46)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="shortcut", type="string", length=8, nullable=true)
     */
    private $shortcut;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="basic_value", type="integer", nullable= true)
     */
    private $basicValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_allowed", type="integer", nullable= true)
     */
    private $maxAllowed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", options={"default":"1"})
     */
    private $enabled = 1;

        /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
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

    public function getShortcut(): ?string
    {
        return $this->shortcut;
    }

    public function setShortcut(?string $shortcut): self
    {
        $this->shortcut = $shortcut;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBasicValue(): ?int
    {
        return $this->basicValue;
    }

    public function setBasicValue(int $basicValue): self
    {
        $this->basicValue = $basicValue;

        return $this;
    }

    public function getMaxAllowed(): ?int
    {
        return $this->maxAllowed;
    }

    public function setMaxAllowed(int $maxAllowed): self
    {
        $this->maxAllowed = $maxAllowed;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
