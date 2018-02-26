<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Informe
 *
 * @ORM\Table(name="informe")
 * @ORM\Entity
 */
class Informe {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var bool
     *
     * @ORM\Column(name="completado", type="boolean", nullable=false)
     */
    private $completado;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="INV\CommonBundle\Entity\ActivoFijo", mappedBy="informes")
     */
    private $activos;

    function __construct() {
        $this->activos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fecha.
     *
     * @param \DateTime $fecha
     *
     * @return Informe
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha.
     *
     * @return \DateTime
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set completado.
     *
     * @param bool $completado
     *
     * @return Informe
     */
    public function setCompletado($completado) {
        $this->completado = $completado;

        return $this;
    }

    /**
     * Get completado.
     *
     * @return bool
     */
    public function getCompletado() {
        return $this->completado;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Informe
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Add activo
     *
     * @param ActivoFijo $activo
     *
     * @return Informe
     */
    public function addActivo(ActivoFijo $activo) {
        $activo->addInforme($this);
        $this->activos[] = $activo;

        return $this;
    }

    /**
     * Remove activo
     *
     * @param ActivoFijo $activo
     */
    public function removeActivo(ActivoFijo $activo) {
        $this->activos->removeElement($activo);
    }

    /**
     * Get activos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivos() {
        return $this->activos;
    }

    function __toString() {
        return $this->getNombre();
    }
}
