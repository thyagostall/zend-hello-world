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
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

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
        return [
//            'services' => [
//                EntityManager::class =>
//            ]
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\AlbumController::class => function() {
                    return new AlbumController();
                },
                Controller\AlbumRestController::class => function($container) {
                    return new AlbumRestController($container->get('doctrine.entitymanager.orm_default'));
                }
            ]
        ];
    }
}