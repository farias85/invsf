<?php

namespace INV\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media", indexes={@ORM\Index(name="Reftipo_media103", columns={"tipo_media"})})
 * @ORM\Entity
 */
class Media {
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
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=250, nullable=false)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=250, nullable=false)
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="entity_id", type="integer", nullable=false)
     */
    private $entityId;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_name", type="string", length=250, nullable=false)
     */
    private $entityName;

    /**
     * @var TipoMedia
     *
     * @ORM\ManyToOne(targetEntity="TipoMedia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_media", referencedColumnName="id")
     * })
     */
    private $tipoMedia;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Media
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set alt.
     *
     * @param string $alt
     *
     * @return Media
     */
    public function setAlt($alt) {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt.
     *
     * @return string
     */
    public function getAlt() {
        return $this->alt;
    }

    /**
     * Set path.
     *
     * @param string $path
     *
     * @return Media
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path.
     *
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Media
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Media
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set entityId.
     *
     * @param int $entityId
     *
     * @return Media
     */
    public function setEntityId($entityId) {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * Get entityId.
     *
     * @return int
     */
    public function getEntityId() {
        return $this->entityId;
    }

    /**
     * Set entityName.
     *
     * @param string $entityName
     *
     * @return Media
     */
    public function setEntityName($entityName) {
        $this->entityName = $entityName;

        return $this;
    }

    /**
     * Get entityName.
     *
     * @return string
     */
    public function getEntityName() {
        return $this->entityName;
    }

    /**
     * Set tipoMedia.
     *
     * @param TipoMedia|null $tipoMedia
     *
     * @return Media
     */
    public function setTipoMedia(TipoMedia $tipoMedia = null) {
        $this->tipoMedia = $tipoMedia;

        return $this;
    }

    /**
     * Get tipoMedia.
     *
     * @return TipoMedia|null
     */
    public function getTipoMedia() {
        return $this->tipoMedia;
    }
}
