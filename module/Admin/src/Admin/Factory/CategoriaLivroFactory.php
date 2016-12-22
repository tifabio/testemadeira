<?php
namespace Admin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use Admin\Service\CategoriaLivroService;

class CategoriaLivroFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $em = $serviceLocator->get("Doctrine\ORM\EntityManager");
        $service = new CategoriaLivroService($em);
        return $service;
    }    
}