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
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="entity", type="string", length=100, nullable=false)
     */
    private $entity;

    /**
     * @var string
     *
     * @ORM\Column(name="rotulo", type="string", length=100, nullable=false)
     */
    private $rotulo;

    /**
     * @var string
     *
     * @ORM\Column(name="antes", type="text", length=65535, nullable=false)
     */
    private $antes;

    /**
     * @var string
     *
     * @ORM\Column(name="despues", type="text", length=65535, nullable=false)
     */
    private $despues;

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
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;


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
     * @return Usuario
     */
    public function getUsuario() {
        return $this->usuario;
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
     * @return string
     */
    public function getEntity() {
        return $this->entity;
    }

    /**
     * @param string $entity
     */
    public function setEntity($entity) {
        $this->entity = $entity;
    }

    /**
     * @return string
     */
    public function getAntes() {
        return $this->antes;
    }

    /**
     * @param string $antes
     */
    public function setAntes($antes) {
        $this->antes = $antes;
    }

    /**
     * @return string
     */
    public function getDespues() {
        return $this->despues;
    }

    /**
     * @param string $despues
     */
    public function setDespues($despues) {
        $this->despues = $despues;
    }

    /**
     * @return null|string
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * @param null|string $descripcion
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
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
}
