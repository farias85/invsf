<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace INV\CommonBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MediaSetterListener {

    /**
     * @var ContainerInterface
     */
    private $container;


    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function postLoad(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if (method_exists($entity, 'setImage')) {
            $mediaManager = $this->container->get('inv.media.manager');
            $media = $mediaManager->findOne($entity);
            if (!empty($media)) {
                $entity->setImage($media);
            }
        } else {
            return;
        }
    }
}
