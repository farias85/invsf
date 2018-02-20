<?php

namespace INV\MediaBundle\Manager;

use Doctrine\ORM\EntityManager;
use INV\MediaBundle\Entity\Media;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MediaManager {
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Nombre del método de la entidad que devuelve el nombre completo de la Entidad
     * siguiendo la forma CommonBundle:Evaluacion por ejemplo...
     * @var string
     */
    private $callEntityNameMethod;

    /**
     * AbstractManager constructor.
     * @param EntityManager $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(EntityManager $entityManager, ContainerInterface $container, $callEntityNameMethod) {
        $this->entityManager = $entityManager;
        $this->container = $container;
        $this->callEntityNameMethod = $callEntityNameMethod;
    }

    /**
     * @return EntityManager
     */
    public function getManager() {
        return $this->entityManager;
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection() {
        return $this->getManager()->getConnection();
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer() {
        return $this->container;
    }

    /**
     * Gets a service.
     * @param $id string The service identifier
     * @return object mixed The associated service
     */
    public function get($id) {
        return $this->container->get($id);
    }

    /**
     * @param $entity mixed
     * @throws \Exception
     * @return string
     */
    private function getEntityName($entity) {
        $method = $this->callEntityNameMethod;
        if (method_exists($entity, $method)) {
            $entityName = $entity->$method();
        } else {
            throw new \Exception('The entity must have a method called ' . $method);
        }
        return $entityName;
    }

    /**
     * @param $entity mixed
     * @throws \Exception
     * @return Media|null|object
     */
    public function findOne($entity) {
        $em = $this->getManager();
        $entityName = $this->getEntityName($entity);

        $media = $em->getRepository('MediaBundle:Media')
            ->findOneBy(['entityId' => $entity->getId(), 'entityName' => $entityName]);
        return $media;
    }

    /**
     * @param $name string
     * @param $alt string
     * @param $path string
     * @param $entity mixed
     * @throws \Exception
     * @return Media
     */
    public function save($name, $alt, $path, $entity) {
        $em = $this->getManager();
        $entityName = $this->getEntityName($entity);

        $media = new Media();
        $media->setCreatedAt(new \DateTime('now'));
        $media->setUpdatedAt(new \DateTime('now'));
        $media->setName($name);
        $media->setPath($path);
        $media->setAlt($alt);
        $media->setEntityId($entity->getId());
        $media->setEntityName($entityName);

        $em->persist($media);
        $em->flush();

        return $media;
    }

    public function remove(Media $media) {
        $em = $this->getManager();
        $dir = $this->get('inv.media.file.uploader')::getTargetDir() . '/';
        $file = $media->getPath();

        if (file_exists($dir . $file)) @unlink($dir . $file);
        $em->remove($media);
        $em->flush($media);
    }
}