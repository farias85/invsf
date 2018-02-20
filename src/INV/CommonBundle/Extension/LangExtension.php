<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 03/09/2017
 * Time: 11:28
 */

namespace INV\CommonBundle\Extension;


class LangExtension {

    /**
     * The Entity Lang
     * @var mixed
     */
    private $el;

    /**
     * The Any Entity Lang
     * @var mixed
     */
    private $any;

    /**
     * @return mixed
     */
    public function getEl() {
        return $this->el;
    }

    /**
     * @param mixed $el
     */
    public function setEl($el) {
        $this->el = $el;
    }

    /**
     * @return mixed
     */
    public function getAny() {
        return $this->any;
    }

    /**
     * @param mixed $any
     */
    public function setAny($any) {
        $this->any = $any;
    }
}