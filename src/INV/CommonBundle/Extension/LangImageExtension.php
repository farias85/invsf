<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 03/09/2017
 * Time: 12:16
 */

namespace INV\CommonBundle\Extension;


class LangImageExtension extends LangExtension {

    /**
     * @var \INV\MediaBundle\Entity\Media
     */
    private $image;

    /**
     * @return \INV\MediaBundle\Entity\Media
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param \INV\MediaBundle\Entity\Media $image
     */
    public function setImage(\INV\MediaBundle\Entity\Media $image) {
        $this->image = $image;
    }

}