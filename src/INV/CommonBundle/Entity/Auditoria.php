<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auditoria
 *
 * @ORM\Table(name="auditoria")
 * @ORM\Entity
 */
class Auditoria {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
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
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="datetime", nullable=false)
     */
    private $hora;

    /**
     * @var string
     *
     * @ORM\Column(name="rotulo", type="string", length=18, nullable=false)
     */
    private $rotulo;

    /**
     * @var string
     *
     * @ORM\Column(name="activo", type="text", length=65535, nullable=false)
     */
    private $activo;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="id", nullable=false)
     * })
     */
    private $usuario;


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
     * @return Auditoria
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
     * Set hora.
     *
     * @param \DateTime $hora
     *
     * @return Auditoria
     */
    public function setHora($hora) {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora.
     *
     * @return \DateTime
     */
    public function getHora() {
        return $this->hora;
    }

    /**
     * Set rotulo.
     *
     * @param string $rotulo
     *
     * @return Auditoria
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
     * Set activo.
     *
     * @param string $activo
     *
     * @return Auditoria
     */
    public function setActivo($activo) {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activoAntes.
     *
     * @return string
     */
    public function getActivo() {
        return $this->activo;
    }

    /**
     * Set usuario.
     *
     * @param \INV\CommonBundle\Entity\Usuario|null $usuario
     *
     * @return Auditoria
     */
    public function setUsuario(\INV\CommonBundle\Entity\Usuario $usuario = null) {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario.
     *
     * @return \INV\CommonBundle\Entity\Usuario|null
     */
    public function getUsuario() {
        return $this->usuario;
    }
}
