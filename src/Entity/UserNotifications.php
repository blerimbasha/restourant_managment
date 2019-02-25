<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserNotificationsRepository")
 */
class UserNotifications
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $applyDate;

    /**
     * @var \App\Entity\Restaurant
     * @ORM\ManyToOne(targetEntity="App\Entity\Restaurant", inversedBy="restaurantId")
     * @ORM\JoinColumn(name="restaurantId", referencedColumnName="id")
     */
    private $restaurantId;

    /**
     * @ORM\Column(type="date")
     */
    private $createDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    public function __construct()
    {
        return $this->createDate = new \DateTime();
        return $this->status = 0;
        return $this->applyDate = new \DateTime();
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

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getApplyDate()
    {
        return $this->applyDate;
    }

    public function setApplyDate(\DateTimeInterface $applyDate)
    {
        $this->applyDate = $applyDate;

        return $this;
    }

    public function getRestaurantId()
    {
        return $this->restaurantId;
    }

    public function setRestaurantId($restaurantId)
    {
        $this->restaurantId = $restaurantId;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTimeInterface $createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }
}
