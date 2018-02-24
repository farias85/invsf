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
     * @ORM\Column(name="rotulo", type="string", length=18, nullable=false)
     */
    private $rotulo;

    /**
     * @var string
     *
     * @ORM\Column(name="aft_antes", type="text", length=65535, nullable=false)
     */
    private $aftAntes;

    /**
     * @var string
     *
     * @ORM\Column(name="aft_despues", type="text", length=65535, nullable=false)
     */
    private $aftDespues;

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

    /**
     * @return string
     */
    public function getAftAntes() {
        return $this->aftAntes;
    }

    /**
     * @param string $aftAntes
     */
    public function setAftAntes($aftAntes) {
        $this->aftAntes = $aftAntes;
    }

    /**
     * @return string
     */
    public function getAftDespues() {
        return $this->aftDespues;
    }

    /**
     * @param string $aftDespues
     */
    public function setAftDespues($aftDespues) {
        $this->aftDespues = $aftDespues;
    }

}
