<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Revision
 *
 * @ORM\Table(name="revision")
 * @ORM\Entity
 */
class Revision {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_en_sistema", type="date", nullable=false)
     */
    private $fechaEnSistema;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_excel", type="date", nullable=false)
     */
    private $fechaExcel;

    /**
     * @var string
     *
     * @ORM\Column(name="excel_url", type="string", length=500, nullable=false)
     */
    private $excelUrl;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set activo.
     *
     * @param bool $activo
     *
     * @return Revision
     */
    public function setActivo($activo) {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo.
     *
     * @return bool
     */
    public function getActivo() {
        return $this->activo;
    }

    /**
     * Set fechaEnSistema.
     *
     * @param \DateTime $fechaEnSistema
     *
     * @return Revision
     */
    public function setFechaEnSistema($fechaEnSistema) {
        $this->fechaEnSistema = $fechaEnSistema;

        return $this;
    }

    /**
     * Get fechaEnSistema.
     *
     * @return \DateTime
     */
    public function getFechaEnSistema() {
        return $this->fechaEnSistema;
    }

    /**
     * Set fechaExcel.
     *
     * @param \DateTime $fechaExcel
     *
     * @return Revision
     */
    public function setFechaExcel($fechaExcel) {
        $this->fechaExcel = $fechaExcel;

        return $this;
    }

    /**
     * Get fechaExcel.
     *
     * @return \DateTime
     */
    public function getFechaExcel() {
        return $this->fechaExcel;
    }

    /**
     * Set excelUrl.
     *
     * @param string $excelUrl
     *
     * @return Revision
     */
    public function setExcelUrl($excelUrl) {
        $this->excelUrl = $excelUrl;

        return $this;
    }

    /**
     * Get excelUrl.
     *
     * @return string
     */
    public function getExcelUrl() {
        return $this->excelUrl;
    }
}
