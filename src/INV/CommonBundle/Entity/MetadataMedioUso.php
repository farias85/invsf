<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MetadataMedioUso
 *
 * @ORM\Table(name="metadata_medio_uso")
 * @ORM\Entity
 */
class MetadataMedioUso {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="total_medio_uso", type="integer", nullable=false)
     */
    private $totalMedioUso;

    /**
     * @var float
     *
     * @ORM\Column(name="importe_total_cuc", type="float", precision=9, scale=3, nullable=false)
     */
    private $importeTotalCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importe_total_cup", type="float", precision=9, scale=3, nullable=false)
     */
    private $importeTotalCUP;

    /**
     * @var RevisionMedioUso
     *
     * @ORM\ManyToOne(targetEntity="RevisionMedioUso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="revision_mu", referencedColumnName="id", nullable=false)
     * })
     */
    private $revisionMU;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTotalMedioUso() {
        return $this->totalMedioUso;
    }

    /**
     * @param int $totalMedioUso
     */
    public function setTotalMedioUso($totalMedioUso) {
        $this->totalMedioUso = $totalMedioUso;
    }

    /**
     * @return float
     */
    public function getImporteTotalCUC() {
        return $this->importeTotalCUC;
    }

    /**
     * @param float $importeTotalCUC
     */
    public function setImporteTotalCUC($importeTotalCUC) {
        $this->importeTotalCUC = $importeTotalCUC;
    }

    /**
     * @return float
     */
    public function getImporteTotalCUP() {
        return $this->importeTotalCUP;
    }

    /**
     * @param float $importeTotalCUP
     */
    public function setImporteTotalCUP($importeTotalCUP) {
        $this->importeTotalCUP = $importeTotalCUP;
    }

    /**
     * @return RevisionMedioUso
     */
    public function getRevisionMU() {
        return $this->revisionMU;
    }

    /**
     * @param RevisionMedioUso $revisionMU
     */
    public function setRevisionMU($revisionMU) {
        $this->revisionMU = $revisionMU;
    }
}
