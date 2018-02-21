<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario implements AdvancedUserInterface, \Serializable {

    const ROLE_DEFAULT = 'ROLE_EDITOR';

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
     * @var string
     *
     * @ORM\Column(name="salt", type="text", nullable=true)
     */
    private $salt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="latest_connection", type="datetime", nullable=true)
     */
    private $latestConnection;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_confirm", type="boolean", nullable=false)
     */
    private $isConfirm;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=false)
     */
    private $slug;

    /**
     * @var array
     */
    protected $roles;

    /**
     * Constructor
     */
    public function __construct() {
        $this->rol = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = [static::ROLE_DEFAULT];
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

    /**
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt) {
        $this->salt = $salt;
    }

    /**
     * @return \DateTime
     */
    public function getLatestConnection() {
        return $this->latestConnection;
    }

    /**
     * @param \DateTime $latestConnection
     */
    public function setLatestConnection($latestConnection) {
        $this->latestConnection = $latestConnection;
    }

    /**
     * @return bool
     */
    public function isActive() {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    /**
     * @return bool
     */
    public function isConfirm() {
        return $this->isConfirm;
    }

    /**
     * @param bool $isConfirm
     */
    public function setIsConfirm($isConfirm) {
        $this->isConfirm = $isConfirm;
    }

    /**
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug) {
        $this->slug = $slug;
    }


    public function getUsername() {
        return $this->getEmail();
    }

    public function eraseCredentials() {
    }

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function isEnabled() {
        return $this->isActive;
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->email,
            $this->contrasenna,
            $this->isActive,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
            $this->id,
            $this->email,
            $this->contrasenna,
            $this->isActive,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    public function getRoles() {
        $roles = $this->roles;
        $roles[] = static::ROLE_DEFAULT;
        return array_unique($roles);
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword() {
        return $this->getContrasenna();
    }

    function __toString() {
        return $this->getNombre();
    }
}
