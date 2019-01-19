<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionsRepository")
 */
class Regions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $region_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    public function __construct()
    {

        $this->region_id = new ArrayCollection();
    }
    public function __toString()
    {
        if(is_null($this->region_id)) {
            return 'NULL';
        }
        return (string) $this->getRegionId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegionId(): ?int
    {
        return $this->region_id;
    }

    public function setRegionId(int $region_id): self
    {
        $this->region_id = $region_id;

        return $this;
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
