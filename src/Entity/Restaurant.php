<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantTypeRepository")
 */
class Restaurant
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $hall_1;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $hall_2;

    /**
     * @ORM\Column(type="boolean", options={"default":0}, nullable=true)
     */
    private $active;

    /**
     * @var  \App\Entity\User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="user_id")
     * ORM\@ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var \App\Entity\Regions
     * @ORM\ManyToOne(targetEntity="App\Entity\Regions", inversedBy="region_id")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comment;

    /**
     * @ORM\Column(type="date")
     */
    private $create_date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $menu;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $cover_path;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image_1;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image_2;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image_3;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $image_4;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $reservation_date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $period;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $reserved;


    public function __construct()
    {
        $this->create_date = new \DateTime();
        $this->region = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
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
     * @return mixed
     */
    public function getHall1()
    {
        return $this->hall_1;
    }

    /**
     * @param mixed $hall_1
     */
    public function setHall1($hall_1): void
    {
        $this->hall_1 = $hall_1;
    }

    /**
     * @return mixed
     */
    public function getHall2()
    {
        return $this->hall_2;
    }

    /**
     * @param mixed $hall_2
     */
    public function setHall2($hall_2): void
    {
        $this->hall_2 = $hall_2;
    }



    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }



    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->create_date;
    }

    public function setCreateDate(\DateTimeInterface $create_date): self
    {
        $this->create_date = $create_date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param mixed $menu
     */
    public function setMenu($menu): void
    {
        $this->menu = $menu;
    }

    /**
     * @return string
     */
    public function getCoverPath()
    {
        return $this->cover_path;
    }

    /**
     * @param string $cover_path
     */
    public function setCoverPath($cover_path)
    {

        if ($cover_path == null) {
            return false;
        } else {
            $this->cover_path = $cover_path;
        }
    }

    /**
     * @return string
     */
    public function getImage1()
    {
        return $this->image_1;
    }

    /**
     * @param string $image_1
     */
    public function setImage1($image_1)
    {
        if ($image_1 == null) {
            return false;
        } else {
            $this->image_1 = $image_1;
        }
    }

    /**
     * @return string
     */
    public function getImage2()
    {
        return $this->image_2;
    }

    /**
     * @param string $image_2
     */
    public function setImage2($image_2)
    {
        if ($image_2 == null) {
            return false;
        } else {
            $this->image_2 = $image_2;
        }
    }

    /**
     * @return string
     */
    public function getImage3()
    {
        return $this->image_3;
    }

    /**
     * @param string $image_3
     */
    public function setImage3($image_3)
    {
        if ($image_3 == null) {
            return false;
        } else {
            $this->image_3 = $image_3;
        }
    }

    /**
     * @return string
     */
    public function getImage4()
    {
        return $this->image_4;
    }

    /**
     * @param string $image_4
     */
    public function setImage4($image_4)
    {
        if ($image_4 == null) {
            return false;
        } else {
            $this->image_4 = $image_4;
        }
    }

    /**
     * @return mixed
     */
    public function getReservationDate()
    {
        return $this->reservation_date;
    }

    /**
     * @param mixed $reservation_date
     */
    public function setReservationDate($reservation_date): void
    {
        $this->reservation_date = $reservation_date;
    }

    public function getPeriod()
    {
        return $this->period;
    }

    public function setPeriod($period)
    {
        $this->period = $period;
    }

    /**
     * @return mixed
     */
    public function getReserved()
    {
        return $this->reserved;
    }

    /**
     * @param mixed $reserved
     */
    public function setReserved($reserved): void
    {
        $this->reserved = $reserved;
    }



    public function __toString()
    {
        return (string) $this->region;
        return (string) $this->cover_path;
        return (string) $this->image_1;
        return (string) $this->image_2;
        return (string) $this->image_3;
        return (string) $this->image_4;
    }
}
