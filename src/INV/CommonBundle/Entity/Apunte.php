<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Apunte
 *
 * @ORM\Table(name="apunte")
 * @ORM\Entity
 */
class Apunte {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="rotulo", type="string", length=100, nullable=false)
     */
    private $rotulo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=100, nullable=false, options={"fixed"=true})
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", length=65535, nullable=false)
     */
    private $observacion;

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
     * Set rotulo.
     *
     * @param string $rotulo
     *
     * @return Apunte
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
     * Set fecha.
     *
     * @param \DateTime $fecha
     *
     * @return Apunte
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
     * Set asunto.
     *
     * @param string $asunto
     *
     * @return Apunte
     */
    public function setAsunto($asunto) {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto.
     *
     * @return string
     */
    public function getAsunto() {
        return $this->asunto;
    }

    /**
     * Set observacion.
     *
     * @param string $observacion
     *
     * @return Apunte
     */
    public function setObservacion($observacion) {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion.
     *
     * @return string
     */
    public function getObservacion() {
        return $this->observacion;
    }

    /**
     * Set usuario.
     *
     * @param \INV\CommonBundle\Entity\Usuario|null $usuario
     *
     * @return Apunte
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
