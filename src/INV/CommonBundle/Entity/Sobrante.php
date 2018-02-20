<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sobrante
 *
 * @ORM\Table(name="sobrante")
 * @ORM\Entity
 */
class Sobrante {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rotulo", type="string", length=20, nullable=true)
     */
    private $rotulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

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
     * @param string|null $rotulo
     *
     * @return Sobrante
     */
    public function setRotulo($rotulo = null) {
        $this->rotulo = $rotulo;

        return $this;
    }

    /**
     * Get rotulo.
     *
     * @return string|null
     */
    public function getRotulo() {
        return $this->rotulo;
    }

    /**
     * Set descripcion.
     *
     * @param string $descripcion
     *
     * @return Sobrante
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
     * Set estado.
     *
     * @param \INV\CommonBundle\Entity\Estado|null $estado
     *
     * @return Sobrante
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
     * @return Sobrante
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
     * @return Sobrante
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
}
