<?php

namespace INV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chequeo
 *
 * @ORM\Table(name="chequeo")
 * @ORM\Entity
 */
class Chequeo {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Apunte
     *
     * @ORM\ManyToOne(targetEntity="Apunte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="apunte", referencedColumnName="id", nullable=false)
     * })
     */
    private $apunte;

    /**
     * @var Informe
     *
     * @ORM\ManyToOne(targetEntity="Informe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="informe", referencedColumnName="id", nullable=false)
     * })
     */
    private $informe;

    /**
     * @var TipoResultado
     *
     * @ORM\ManyToOne(targetEntity="TipoResultado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_resultado", referencedColumnName="id", nullable=false)
     * })
     */
    private $tipoResultado;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set apunte.
     *
     * @param \INV\CommonBundle\Entity\Apunte|null $apunte
     *
     * @return Chequeo
     */
    public function setApunte(\INV\CommonBundle\Entity\Apunte $apunte = null) {
        $this->apunte = $apunte;

        return $this;
    }

    /**
     * Get apunte.
     *
     * @return \INV\CommonBundle\Entity\Apunte|null
     */
    public function getApunte() {
        return $this->apunte;
    }

    /**
     * Set informe.
     *
     * @param \INV\CommonBundle\Entity\Informe|null $informe
     *
     * @return Chequeo
     */
    public function setInforme(\INV\CommonBundle\Entity\Informe $informe = null) {
        $this->informe = $informe;

        return $this;
    }

    /**
     * Get informe.
     *
     * @return \INV\CommonBundle\Entity\Informe|null
     */
    public function getInforme() {
        return $this->informe;
    }

    /**
     * Set tipoResultado.
     *
     * @param \INV\CommonBundle\Entity\TipoResultado|null $tipoResultado
     *
     * @return Chequeo
     */
    public function setTipoResultado(\INV\CommonBundle\Entity\TipoResultado $tipoResultado = null) {
        $this->tipoResultado = $tipoResultado;

        return $this;
    }

    /**
     * Get tipoResultado.
     *
     * @return \INV\CommonBundle\Entity\TipoResultado|null
     */
    public function getTipoResultado() {
        return $this->tipoResultado;
    }
}
