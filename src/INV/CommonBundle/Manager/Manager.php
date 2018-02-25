<?php

namespace INV\CommonBundle\Manager;

use Doctrine\ORM\EntityManager;
use JMS\Serializer\SerializerBuilder;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


/**
 * Created by PhpStorm.
 * User: farias
 * Date: 01/05/2017
 * Time: 9:32
 */
class Manager {
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * AbstractManager constructor.
     * @param EntityManager $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(EntityManager $entityManager, ContainerInterface $container) {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection() {
        return $this->getEntityManager()->getConnection();
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
     * @param null $id
     * @param $show string Key Url para el show
     * @param $index string Key Url para el index
     * @return RedirectResponse
     */
    public function successRedirect($id = null, $show, $index) {
        $request = $this->getRequest();
        $flash = $request->getSession()->getFlashBag();
        $flash->add('success', $this->get('translator')->trans('operation.success', [], 'common'));

        return $id != null ? $this->redirectToRoute($show, array('id' => $id)) :
            $this->redirectToRoute($index);
    }

    /**
     * @param $route
     * @param array $parameters
     * @param int $status
     * @return RedirectResponse
     */
    protected function redirectToRoute($route, array $parameters = array(), $status = 302) {
        $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH;
        $url = $this->get('router')->generate($route, $parameters, $referenceType);
        return new RedirectResponse($url, $status);
    }

    /**
     * @return bool
     */
    public function isXmlHttpRequest() {
        return $this->getRequest()->isXmlHttpRequest() || $this->getRequest()->get('_xml_http_request');
    }

    /**
     * @param $data
     * @param int $status
     * @param array $headers
     * @return Response
     */
    public function renderJson($data, $status = 200, $headers = array()) {
        if ($this->getRequest()->get('_xml_http_request')
            && strpos($this->getRequest()->headers->get('Content-Type'), 'multipart/form-data') === 0
        ) {
            $headers['Content-Type'] = 'text/plain';
        } else {
            $headers['Content-Type'] = 'application/json';
        }

        return new Response(json_encode($data), $status, $headers);
    }

    /**
     * Convierte un objeto en un array asociativo
     * @param $object
     * @return array
     */
    function dismount($object) {
        $reflectionClass = new \ReflectionClass(get_class($object));
        $array = array();
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($object);
            $property->setAccessible(false);
        }
        return $array;
    }

    /**
     * @return mixed
     */
    public function getRequest() {
        return $this->get('request_stack')->getCurrentRequest();
    }

    /**
     * Serializa un objeto o array de doctrine o de cualquier tipo en un json
     * @param $data
     * @return mixed|string
     */
    public function serializeJSON($data) {
        $serializer = SerializerBuilder::create()->build();
        $raw = $serializer->serialize($data, 'json');
        $raw = addslashes($raw); //escapando la comilla simple en el texto de la descripcion y el resumen
        return $raw;
    }

    public function getUser() {
        return $this->container->get('security.token_storage')->getToken()->getUser();
    }
}