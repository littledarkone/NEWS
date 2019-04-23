<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdmVisitsRepository")
 */
class AdmVisits
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
    private $AccountNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BirthDateTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UnitNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Sex;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProviderId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccountNumber(): ?string
    {
        return $this->AccountNumber;
    }

    public function setAccountNumber(string $AccountNumber): self
    {
        $this->AccountNumber = $AccountNumber;

        return $this;
    }

    public function getBirthDateTime(): ?string
    {
        return $this->BirthDateTime;
    }

    public function setBirthDateTime(string $BirthDateTime): self
    {
        $this->BirthDateTime = $BirthDateTime;

        return $this;
    }

    public function getUnitNumber(): ?string
    {
        return $this->UnitNumber;
    }

    public function setUnitNumber(string $UnitNumber): self
    {
        $this->UnitNumber = $UnitNumber;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->Sex;
    }

    public function setSex(string $Sex): self
    {
        $this->Sex = $Sex;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getProviderId(): ?int
    {
        return $this->ProviderId;
    }

    public function setProviderId(int $ProviderId): self
    {
        $this->ProviderId = $ProviderId;

        return $this;
    }
}
