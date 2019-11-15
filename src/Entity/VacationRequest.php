<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VacationRequest
 *
 * @ORM\Table(name="vacation_request")
 * @ORM\Entity(repositoryClass="App\Repository\VacationRequestRepository")
 */
class VacationRequest
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
     * @ORM\Column(name="user_comment", type="text", nullable=true)
     */
    private $userComment;

    /**
     * @var string
     *
     * @ORM\Column(name="manager_comment", type="text", nullable=true)
     */
    private $managerComment;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="vacationRequests")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @var VacationType
     *
     * @ORM\ManyToOne(targetEntity="VacationType")
     * @ORM\JoinColumn(name="vacation_type_id", referencedColumnName="id", nullable=false)
     */
    private $vacationType;

    /**
     * @var RequestStatus
     *
     * @ORM\ManyToOne(targetEntity="RequestStatus")
     * @ORM\JoinColumn(name="request_status_id", referencedColumnName="id", nullable=false)
     */
    private $requestStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_at", type="datetime")
     */
    private $startAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_at", type="datetime")
     */
    private $endAt;

    /**
     * @var string
     *
     * @ORM\Column(name="start_timecode", type="string", columnDefinition="enum('matin', 'soir')")
     */
    private $startTimeCode;

    /**
     * @var string
     *
     * @ORM\Column(name="end_timecode", type="string", columnDefinition="enum('matin', 'soir')")
     */
    private $endTimeCode;

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

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getVacationType(): ?VacationType
    {
        return $this->vacationType;
    }

    public function setVacationType(?VacationType $vacationType): self
    {
        $this->vacationType = $vacationType;

        return $this;
    }

    public function getUserComment(): ?string
    {
        return $this->userComment;
    }

    public function setUserComment(?string $userComment): self
    {
        $this->userComment = $userComment;

        return $this;
    }

    public function getManagerComment(): ?string
    {
        return $this->managerComment;
    }

    public function setManagerComment(?string $managerComment): self
    {
        $this->managerComment = $managerComment;

        return $this;
    }

    public function getRequestStatus(): ?RequestStatus
    {
        return $this->requestStatus;
    }

    public function setRequestStatus(?RequestStatus $requestStatus): self
    {
        $this->requestStatus = $requestStatus;

        return $this;
    }

    public function getStartTimeCode(): ?string
    {
        return $this->startTimeCode;
    }

    public function setStartTimeCode(string $startTimeCode): self
    {
        $this->startTimeCode = $startTimeCode;

        return $this;
    }

    public function getEndTimeCode(): ?string
    {
        return $this->endTimeCode;
    }

    public function setEndTimeCode(string $endTimeCode): self
    {
        $this->endTimeCode = $endTimeCode;

        return $this;
    }
}
