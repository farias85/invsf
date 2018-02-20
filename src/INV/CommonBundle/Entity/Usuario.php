<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario {
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
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=100, nullable=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="contrasenna", type="string", length=200, nullable=false)
     */
    private $contrasenna;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rol", inversedBy="usuario")
     * @ORM\JoinTable(name="usuario_rol",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="rol", referencedColumnName="id")
     *   }
     * )
     */
    private $rol;

    /**
     * Constructor
     */
    public function __construct() {
        $this->rol = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Usuario
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
     * Set apellidos.
     *
     * @param string $apellidos
     *
     * @return Usuario
     */
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos.
     *
     * @return string
     */
    public function getApellidos() {
        return $this->apellidos;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Usuario
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set contrasenna.
     *
     * @param string $contrasenna
     *
     * @return Usuario
     */
    public function setContrasenna($contrasenna) {
        $this->contrasenna = $contrasenna;

        return $this;
    }

    /**
     * Get contrasenna.
     *
     * @return string
     */
    public function getContrasenna() {
        return $this->contrasenna;
    }

    /**
     * Add rol.
     *
     * @param \INV\CommonBundle\Entity\Rol $rol
     *
     * @return Usuario
     */
    public function addRol(\INV\CommonBundle\Entity\Rol $rol) {
        $this->rol[] = $rol;

        return $this;
    }

    /**
     * Remove rol.
     *
     * @param \INV\CommonBundle\Entity\Rol $rol
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRol(\INV\CommonBundle\Entity\Rol $rol) {
        return $this->rol->removeElement($rol);
    }

    /**
     * Get rol.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRol() {
        return $this->rol;
    }
}
