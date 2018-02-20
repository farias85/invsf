<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace INV\MediaBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader {

    public function upload(UploadedFile $file) {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move(self::getTargetDir(), $fileName);
        return $fileName;
    }

    /**
     * La ruta absoluta del directorio donde se deben guardar los archivos cargados
     * @return string
     */
    public static function getWebDir() {
        return __DIR__ . '/../../../../web';
    }

    /**
     * Se deshace del __DIR__ para no meter la pata al mostrar el documento/imagen cargada en la vista.
     * @return string
     */
    public static function getUploadPath() {
        return '/uploads/media';
    }

    public static function getTargetDir() {
        return self::getWebDir() . self::getUploadPath();
    }

    public static function getAssetPath() {
        return substr(self::getUploadPath(), 1, strlen(self::getUploadPath()) - 1) . '/';
    }
}
