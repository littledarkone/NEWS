<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObservationsRepository")
 */
class Observations
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
    private $BP;

    /**
     * @ORM\Column(type="integer")
     */
    private $Pulse;

    /**
     * @ORM\Column(type="integer")
     */
    private $Respirations;

    /**
     * @ORM\Column(type="integer")
     */
    private $SpO2;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1)
     */
    private $Temperature;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LevelOfConsciousness;

    /**
     * @ORM\Column(type="integer")
     */
    private $patientid;

    /**
     * @ORM\Column(type="integer")
     */
    private $newsScore;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBP(): ?int
    {
        return $this->BP;
    }

    public function setBP(int $BP): self
    {
        $this->BP = $BP;

        return $this;
    }

    public function getPulse(): ?int
    {
        return $this->Pulse;
    }

    public function setPulse(int $Pulse): self
    {
        $this->Pulse = $Pulse;

        return $this;
    }

    public function getRespirations(): ?int
    {
        return $this->Respirations;
    }

    public function setRespirations(int $Respirations): self
    {
        $this->Respirations = $Respirations;

        return $this;
    }

    public function getSpO2(): ?int
    {
        return $this->SpO2;
    }

    public function setSpO2(int $SpO2): self
    {
        $this->SpO2 = $SpO2;

        return $this;
    }

    public function getTemperature()
    {
        return $this->Temperature;
    }

    public function setTemperature($Temperature): self
    {
        $this->Temperature = $Temperature;

        return $this;
    }

    public function getLevelOfConsciousness(): ?string
    {
        return $this->LevelOfConsciousness;
    }

    public function setLevelOfConsciousness(string $LevelOfConsciousness): self
    {
        $this->LevelOfConsciousness = $LevelOfConsciousness;

        return $this;
    }

    public function getPatientid(): ?int
    {
        return $this->patientid;
    }

    public function setPatientid(int $patientid): self
    {
        $this->patientid = $patientid;

        return $this;
    }

    public function getNewsScore(): ?int
    {
        return $this->newsScore;
    }

    public function setNewsScore(int $newsScore): self
    {
        $this->newsScore = $newsScore;

        return $this;
    }
}
