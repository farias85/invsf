<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivoFijo
 *
 * @ORM\Table(name="activo_fijo")
 * @ORM\Entity(repositoryClass="INV\CommonBundle\Repository\ActivoFijoRepository")
 */
class ActivoFijo {
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
     * @ORM\Column(name="rotulo", type="string", length=18, nullable=false)
     */
    private $rotulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_cuc", type="float", precision=9, scale=3, nullable=false)
     */
    private $valorCuc;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_mn", type="float", precision=9, scale=3, nullable=false)
     */
    private $valorMn;

    /**
     * @var float
     *
     * @ORM\Column(name="tasa", type="float", precision=9, scale=3, nullable=false)
     */
    private $tasa;

    /**
     * @var float
     *
     * @ORM\Column(name="dep_acu_cuc", type="float", precision=9, scale=3, nullable=false)
     */
    private $depAcuCuc;

    /**
     * @var float
     *
     * @ORM\Column(name="dep_acu_mn", type="float", precision=9, scale=3, nullable=false)
     */
    private $depAcuMn;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_actual_cuc", type="float", precision=9, scale=3, nullable=false)
     */
    private $valorActualCuc;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_actual_mn", type="float", precision=9, scale=3, nullable=false)
     */
    private $valorActualMn;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_text", type="string", length=100, nullable=false)
     */
    private $responsableText;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_text", type="string", length=100, nullable=false)
     */
    private $estadoText;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_alta", type="date", nullable=false)
     */
    private $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_estado_actual", type="date", nullable=false)
     */
    private $fechaEstadoActual;

    /**
     * @var Estado
     *
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado", referencedColumnName="id", nullable=false)
     * })
     */
    private $estado;

    /**
     * @var Local
     *
     * @ORM\ManyToOne(targetEntity="Local")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="local", referencedColumnName="id", nullable=false)
     * })
     */
    private $local;

    /**
     * @var Responsable
     *
     * @ORM\ManyToOne(targetEntity="Responsable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="responsable", referencedColumnName="id", nullable=false)
     * })
     */
    private $responsable;

    /**
     * @var Revision
     *
     * @ORM\ManyToOne(targetEntity="Revision")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="revision", referencedColumnName="id", nullable=false)
     * })
     */
    private $revision;

    /**
     * @var TipoActivo
     *
     * @ORM\ManyToOne(targetEntity="TipoActivo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_activo", referencedColumnName="id", nullable=false)
     * })
     */
    private $tipoActivo;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set rotulo.
     *
     * @param string $rotulo
     *
     * @return ActivoFijo
     */
    public function setRotulo($rotulo) {
        $this->rotulo = $rotulo;

        return $this;
    }

    /**
     * Get rotulo.
     *
     * @return string
     */
    public function getRotulo() {
        return $this->rotulo;
    }

    /**
     * Set descripcion.
     *
     * @param string $descripcion
     *
     * @return ActivoFijo
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion.
     *
     * @return string
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set valorCuc.
     *
     * @param float $valorCuc
     *
     * @return ActivoFijo
     */
    public function setValorCuc($valorCuc) {
        $this->valorCuc = $valorCuc;

        return $this;
    }

    /**
     * Get valorCuc.
     *
     * @return float
     */
    public function getValorCuc() {
        return $this->valorCuc;
    }

    /**
     * Set valorMn.
     *
     * @param float $valorMn
     *
     * @return ActivoFijo
     */
    public function setValorMn($valorMn) {
        $this->valorMn = $valorMn;

        return $this;
    }

    /**
     * Get valorMn.
     *
     * @return float
     */
    public function getValorMn() {
        return $this->valorMn;
    }

    /**
     * Set tasa.
     *
     * @param float $tasa
     *
     * @return ActivoFijo
     */
    public function setTasa($tasa) {
        $this->tasa = $tasa;

        return $this;
    }

    /**
     * Get tasa.
     *
     * @return float
     */
    public function getTasa() {
        return $this->tasa;
    }

    /**
     * Set depAcuCuc.
     *
     * @param float $depAcuCuc
     *
     * @return ActivoFijo
     */
    public function setDepAcuCuc($depAcuCuc) {
        $this->depAcuCuc = $depAcuCuc;

        return $this;
    }

    /**
     * Get depAcuCuc.
     *
     * @return float
     */
    public function getDepAcuCuc() {
        return $this->depAcuCuc;
    }

    /**
     * Set depAcuMn.
     *
     * @param float $depAcuMn
     *
     * @return ActivoFijo
     */
    public function setDepAcuMn($depAcuMn) {
        $this->depAcuMn = $depAcuMn;

        return $this;
    }

    /**
     * Get depAcuMn.
     *
     * @return float
     */
    public function getDepAcuMn() {
        return $this->depAcuMn;
    }

    /**
     * Set valorActualCuc.
     *
     * @param float $valorActualCuc
     *
     * @return ActivoFijo
     */
    public function setValorActualCuc($valorActualCuc) {
        $this->valorActualCuc = $valorActualCuc;

        return $this;
    }

    /**
     * Get valorActualCuc.
     *
     * @return float
     */
    public function getValorActualCuc() {
        return $this->valorActualCuc;
    }

    /**
     * Set valorActualMn.
     *
     * @param float $valorActualMn
     *
     * @return ActivoFijo
     */
    public function setValorActualMn($valorActualMn) {
        $this->valorActualMn = $valorActualMn;

        return $this;
    }

    /**
     * Get valorActualMn.
     *
     * @return float
     */
    public function getValorActualMn() {
        return $this->valorActualMn;
    }

    /**
     * Set responsableText.
     *
     * @param string $responsableText
     *
     * @return ActivoFijo
     */
    public function setResponsableText($responsableText) {
        $this->responsableText = $responsableText;

        return $this;
    }

    /**
     * Get responsableText.
     *
     * @return string
     */
    public function getResponsableText() {
        return $this->responsableText;
    }

    /**
     * Set estadoText.
     *
     * @param string $estadoText
     *
     * @return ActivoFijo
     */
    public function setEstadoText($estadoText) {
        $this->estadoText = $estadoText;

        return $this;
    }

    /**
     * Get estadoText.
     *
     * @return string
     */
    public function getEstadoText() {
        return $this->estadoText;
    }

    /**
     * Set fechaAlta.
     *
     * @param \DateTime $fechaAlta
     *
     * @return ActivoFijo
     */
    public function setFechaAlta($fechaAlta) {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta.
     *
     * @return \DateTime
     */
    public function getFechaAlta() {
        return $this->fechaAlta;
    }

    /**
     * Set fechaEstadoActual.
     *
     * @param \DateTime $fechaEstadoActual
     *
     * @return ActivoFijo
     */
    public function setFechaEstadoActual($fechaEstadoActual) {
        $this->fechaEstadoActual = $fechaEstadoActual;

        return $this;
    }

    /**
     * Get fechaEstadoActual.
     *
     * @return \DateTime
     */
    public function getFechaEstadoActual() {
        return $this->fechaEstadoActual;
    }

    /**
     * Set estado.
     *
     * @param \INV\CommonBundle\Entity\Estado|null $estado
     *
     * @return ActivoFijo
     */
    public function setEstado(\INV\CommonBundle\Entity\Estado $estado = null) {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado.
     *
     * @return \INV\CommonBundle\Entity\Estado|null
     */
    public function getEstado() {
        return $this->estado;
    }

    /**
     * Set local.
     *
     * @param \INV\CommonBundle\Entity\Local|null $local
     *
     * @return ActivoFijo
     */
    public function setLocal(\INV\CommonBundle\Entity\Local $local = null) {
        $this->local = $local;

        return $this;
    }

    /**
     * Get local.
     *
     * @return \INV\CommonBundle\Entity\Local|null
     */
    public function getLocal() {
        return $this->local;
    }

    /**
     * Set responsable.
     *
     * @param \INV\CommonBundle\Entity\Responsable|null $responsable
     *
     * @return ActivoFijo
     */
    public function setResponsable(\INV\CommonBundle\Entity\Responsable $responsable = null) {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable.
     *
     * @return \INV\CommonBundle\Entity\Responsable|null
     */
    public function getResponsable() {
        return $this->responsable;
    }

    /**
     * Set revision.
     *
     * @param \INV\CommonBundle\Entity\Revision|null $revision
     *
     * @return ActivoFijo
     */
    public function setRevision(\INV\CommonBundle\Entity\Revision $revision = null) {
        $this->revision = $revision;

        return $this;
    }

    /**
     * Get revision.
     *
     * @return \INV\CommonBundle\Entity\Revision|null
     */
    public function getRevision() {
        return $this->revision;
    }

    /**
     * Set tipoActivo.
     *
     * @param \INV\CommonBundle\Entity\TipoActivo|null $tipoActivo
     *
     * @return ActivoFijo
     */
    public function setTipoActivo(\INV\CommonBundle\Entity\TipoActivo $tipoActivo = null) {
        $this->tipoActivo = $tipoActivo;

        return $this;
    }

    /**
     * Get tipoActivo.
     *
     * @return \INV\CommonBundle\Entity\TipoActivo|null
     */
    public function getTipoActivo() {
        return $this->tipoActivo;
    }
}
