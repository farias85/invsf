<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="rol")
 * @ORM\Entity
 */
class Rol {
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
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="rol")
     */
    private $usuario;

    /**
     * Constructor
     */
    public function __construct() {
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Rol
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
     * Set descripcion.
     *
     * @param string|null $descripcion
     *
     * @return Rol
     */
    public function setDescripcion($descripcion = null) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion.
     *
     * @return string|null
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Add usuario.
     *
     * @param \INV\CommonBundle\Entity\Usuario $usuario
     *
     * @return Rol
     */
    public function addUsuario(\INV\CommonBundle\Entity\Usuario $usuario) {
        $this->usuario[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario.
     *
     * @param \INV\CommonBundle\Entity\Usuario $usuario
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUsuario(\INV\CommonBundle\Entity\Usuario $usuario) {
        return $this->usuario->removeElement($usuario);
    }

    /**
     * Get usuario.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuario() {
        return $this->usuario;
    }
}
