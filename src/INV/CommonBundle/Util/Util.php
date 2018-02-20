<?php

namespace INV\CommonBundle\Util;

use INV\CommonBundle\Extension\EntityNameExtension;

class Util {

    public static function getSlug($cadena, $separador = '-') {
        // Código copiado de http://cubiq.org/the-perfect-php-clean-url-generator
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = strtolower(trim($slug, $separador));
        $slug = preg_replace("/[\/_|+ -]+/", $separador, $slug);
        return $slug;
    }

    public static function json_decode($json) {
        return json_decode($json);
    }

    public static function ucfirst($str) {
        return ucfirst($str);
    }

    public static function equals($str1, $str2) {
        if (strcasecmp($str1, $str2) == 0) {
            return true;
        }
        return false;
    }

    /**
     * @param $obj mixed
     * @param $fullName boolean
     * @return string
     */
    public static function getClass($obj, $fullName = true) {
        $dir = get_class($obj); //Nous\CommonBundle\Entity\Usuario
        $str = str_replace("\\", " ", $dir, $count); //Nous CommonBundle Entity Usuario
        $words = preg_split("/[\s,]+/", $str);
        return $fullName ? $words[1] . ':' . $words[3] : $words[3]; //CommonBundle:Usuario
    }

    /**
     * @param $entity mixed
     * @return string
     * @throws \Exception
     */
    public static function getEntityName($entity) {
        if ($entity instanceof EntityNameExtension) {
            $entityName = $entity->getEntityName();
        } else {
            throw new \Exception('The entity must have a method called getEntityName');
        }
        return $entityName;
    }

    /**
     * Delete unicode class from regular expression patterns
     * @param string $pattern
     * @return string pattern
     */
    public static function cleanNonUnicodeSupport($pattern) {
        return preg_replace('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }
}
