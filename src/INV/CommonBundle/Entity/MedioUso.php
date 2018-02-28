<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metadata
 *
 * @ORM\Table(name="medio_uso")
 * @ORM\Entity
 */
class MedioUso {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="rotulo", type="string", length=50, nullable=false)
     */
    private $rotulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_text", type="string", length=255, nullable=false)
     */
    private $responsableText;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_nomina", type="string", length=50, nullable=false)
     */
    private $responsableNomina;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad_sub_total_util", type="integer", nullable=false)
     */
    private $cantidadSubtotalUtil;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_cup", type="float", precision=9, scale=3, nullable=false)
     */
    private $precioCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importe_cup", type="float", precision=9, scale=3, nullable=false)
     */
    private $importeCUP;

    /**
     * @var float
     *
     * @ORM\Column(name="importe_cup_subtotal_util", type="float", precision=9, scale=3, nullable=false)
     */
    private $importeCUPSubtotalUtil;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_cuc", type="float", precision=9, scale=3, nullable=false)
     */
    private $precioCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importe_cuc", type="float", precision=9, scale=3, nullable=false)
     */
    private $importeCUC;

    /**
     * @var float
     *
     * @ORM\Column(name="importe_cuc_subtotal_util", type="float", precision=9, scale=3, nullable=false)
     */
    private $importeCUCSubtotalUtil;

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
     * @return string
     */
    public function getRotulo() {
        return $this->rotulo;
    }

    /**
     * @param string $rotulo
     */
    public function setRotulo($rotulo) {
        $this->rotulo = $rotulo;
    }

    /**
     * @return string
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    /**
     * @return string
     */
    public function getResponsableText() {
        return $this->responsableText;
    }

    /**
     * @param string $responsableText
     */
    public function setResponsableText($responsableText) {
        $this->responsableText = $responsableText;
    }

    /**
     * @return string
     */
    public function getResponsableNomina() {
        return $this->responsableNomina;
    }

    /**
     * @param string $responsableNomina
     */
    public function setResponsableNomina($responsableNomina) {
        $this->responsableNomina = $responsableNomina;
    }

    /**
     * @return int
     */
    public function getCantidad() {
        return $this->cantidad;
    }

    /**
     * @param int $cantidad
     */
    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    /**
     * @return int
     */
    public function getCantidadSubtotalUtil() {
        return $this->cantidadSubtotalUtil;
    }

    /**
     * @param int $cantidadSubtotalUtil
     */
    public function setCantidadSubtotalUtil($cantidadSubtotalUtil) {
        $this->cantidadSubtotalUtil = $cantidadSubtotalUtil;
    }

    /**
     * @return float
     */
    public function getPrecioCUP() {
        return $this->precioCUP;
    }

    /**
     * @param float $precioCUP
     */
    public function setPrecioCUP($precioCUP) {
        $this->precioCUP = $precioCUP;
    }

    /**
     * @return float
     */
    public function getImporteCUP() {
        return $this->importeCUP;
    }

    /**
     * @param float $importeCUP
     */
    public function setImporteCUP($importeCUP) {
        $this->importeCUP = $importeCUP;
    }

    /**
     * @return float
     */
    public function getImporteCUPSubtotalUtil() {
        return $this->importeCUPSubtotalUtil;
    }

    /**
     * @param float $importeCUPSubtotalUtil
     */
    public function setImporteCUPSubtotalUtil($importeCUPSubtotalUtil) {
        $this->importeCUPSubtotalUtil = $importeCUPSubtotalUtil;
    }

    /**
     * @return float
     */
    public function getPrecioCUC() {
        return $this->precioCUC;
    }

    /**
     * @param float $precioCUC
     */
    public function setPrecioCUC($precioCUC) {
        $this->precioCUC = $precioCUC;
    }

    /**
     * @return float
     */
    public function getImporteCUC() {
        return $this->importeCUC;
    }

    /**
     * @param float $importeCUC
     */
    public function setImporteCUC($importeCUC) {
        $this->importeCUC = $importeCUC;
    }

    /**
     * @return float
     */
    public function getImporteCUCSubtotalUtil() {
        return $this->importeCUCSubtotalUtil;
    }

    /**
     * @param float $importeCUCSubtotalUtil
     */
    public function setImporteCUCSubtotalUtil($importeCUCSubtotalUtil) {
        $this->importeCUCSubtotalUtil = $importeCUCSubtotalUtil;
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

    function __toString() {
        return $this->getRotulo();
    }
}
