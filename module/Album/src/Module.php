<?php
/**
 * Created by PhpStorm.
 * User: thyago
 * Date: 07/02/2017
 * Time: 22:37
 */

namespace Album;


use Album\Controller\AlbumController;
use Album\Controller\AlbumRestController;
use Doctrine\ORM\EntityManager;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ServiceManager\ServiceManager;

class Module implements ConfigProviderInterface
{

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\AlbumController::class => function(ServiceManager $serviceManager) {
                    return new AlbumController($serviceManager->get(EntityManager::class));
                },
                Controller\AlbumRestController::class => function(ServiceManager $serviceManager) {
                    return new AlbumRestController($serviceManager->get(EntityManager::class));
                }
            ]
        ];
    }
}