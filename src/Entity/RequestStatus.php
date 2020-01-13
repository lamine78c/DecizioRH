<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RequestStatus
 *
 * @ORM\Table(name="request_status")
 * @ORM\Entity(repositoryClass="App\Repository\RequestStatusRepository")
 */

class RequestStatus
{

    const STATUS_IN_PROGRESS = 'En cours';
    const STATUS_VALID = 'Validée';
    const STATUS_REJECT = 'Rejetée';
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
