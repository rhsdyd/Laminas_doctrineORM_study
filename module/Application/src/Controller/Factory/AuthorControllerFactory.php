<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Application\Service\AuthorManager;
use Application\Controller\AuthorController;


class AuthorControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container,
                           $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $authorManager = $container->get(AuthorManager::class);


        return new AuthorController($entityManager, $authorManager);
    }
}
