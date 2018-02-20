<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metadata
 *
 * @ORM\Table(name="metadata")
 * @ORM\Entity
 */
class Metadata {
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
     * @ORM\Column(name="total_activos", type="integer", nullable=false)
     */
    private $totalActivos;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_total", type="float", precision=9, scale=3, nullable=false)
     */
    private $valorTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_total_mc", type="float", precision=9, scale=3, nullable=false)
     */
    private $valorTotalMc;

    /**
     * @var float
     *
     * @ORM\Column(name="dep_acu_total", type="float", precision=9, scale=3, nullable=false)
     */
    private $depAcuTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="dep_acu_total_mc", type="float", precision=9, scale=3, nullable=false)
     */
    private $depAcuTotalMc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="elaborado", type="string", length=200, nullable=true)
     */
    private $elaborado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="responsable", type="string", length=200, nullable=true)
     */
    private $responsable;

    /**
     * @var string|null
     *
     * @ORM\Column(name="revisado", type="string", length=200, nullable=true)
     */
    private $revisado;

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
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set totalActivos.
     *
     * @param int $totalActivos
     *
     * @return Metadata
     */
    public function setTotalActivos($totalActivos) {
        $this->totalActivos = $totalActivos;

        return $this;
    }

    /**
     * Get totalActivos.
     *
     * @return int
     */
    public function getTotalActivos() {
        return $this->totalActivos;
    }

    /**
     * Set valorTotal.
     *
     * @param float $valorTotal
     *
     * @return Metadata
     */
    public function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    /**
     * Get valorTotal.
     *
     * @return float
     */
    public function getValorTotal() {
        return $this->valorTotal;
    }

    /**
     * Set valorTotalMc.
     *
     * @param float $valorTotalMc
     *
     * @return Metadata
     */
    public function setValorTotalMc($valorTotalMc) {
        $this->valorTotalMc = $valorTotalMc;

        return $this;
    }

    /**
     * Get valorTotalMc.
     *
     * @return float
     */
    public function getValorTotalMc() {
        return $this->valorTotalMc;
    }

    /**
     * Set depAcuTotal.
     *
     * @param float $depAcuTotal
     *
     * @return Metadata
     */
    public function setDepAcuTotal($depAcuTotal) {
        $this->depAcuTotal = $depAcuTotal;

        return $this;
    }

    /**
     * Get depAcuTotal.
     *
     * @return float
     */
    public function getDepAcuTotal() {
        return $this->depAcuTotal;
    }

    /**
     * Set depAcuTotalMc.
     *
     * @param float $depAcuTotalMc
     *
     * @return Metadata
     */
    public function setDepAcuTotalMc($depAcuTotalMc) {
        $this->depAcuTotalMc = $depAcuTotalMc;

        return $this;
    }

    /**
     * Get depAcuTotalMc.
     *
     * @return float
     */
    public function getDepAcuTotalMc() {
        return $this->depAcuTotalMc;
    }

    /**
     * Set elaborado.
     *
     * @param string|null $elaborado
     *
     * @return Metadata
     */
    public function setElaborado($elaborado = null) {
        $this->elaborado = $elaborado;

        return $this;
    }

    /**
     * Get elaborado.
     *
     * @return string|null
     */
    public function getElaborado() {
        return $this->elaborado;
    }

    /**
     * Set responsable.
     *
     * @param string|null $responsable
     *
     * @return Metadata
     */
    public function setResponsable($responsable = null) {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable.
     *
     * @return string|null
     */
    public function getResponsable() {
        return $this->responsable;
    }

    /**
     * Set revisado.
     *
     * @param string|null $revisado
     *
     * @return Metadata
     */
    public function setRevisado($revisado = null) {
        $this->revisado = $revisado;

        return $this;
    }

    /**
     * Get revisado.
     *
     * @return string|null
     */
    public function getRevisado() {
        return $this->revisado;
    }

    /**
     * Set revision.
     *
     * @param \INV\CommonBundle\Entity\Revision|null $revision
     *
     * @return Metadata
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
}
