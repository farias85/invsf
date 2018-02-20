<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 03/09/2017
 * Time: 12:24
 */

namespace INV\CommonBundle\Extension;


class LangImageTranslatesExtension extends LangImageExtension {

    /**
     * @var string
     */
    private $translates;

    /**
     * @return string
     */
    public function getTranslates() {
        return $this->translates;
    }

    /**
     * @param string $translates
     */
    public function setTranslates($translates) {
        $this->translates = $translates;
    }
}