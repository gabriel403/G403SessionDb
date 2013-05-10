<?php
namespace G403SessionDb;

use Zend\Session\Config\SessionConfig;
use Zend\Session\SaveHandler;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(\Zend\EventManager\EventInterface $e)
    {
        $sm = $e->getApplication()->getServiceManager();

        $sessionManager = $sm->get('session_save_manager');
        Container::setDefaultManager($sessionManager);
        $sessionManager->start();
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'session_table' => function ($serviceManager) {
                    $config = $serviceManager->get('config');

                    $sessionTableName = null;
                    if ( array_key_exists('session_table_name', $config)) {
                        $sessionTableName = $config['session_table_name'];
                    }

                    $sessionTableGateway = new TableGateway(
                        $sessionTableName,
                        $serviceManager->get('Zend\Db\Adapter\Session'));

                    return $sessionTableGateway;
                },
                'session_db_options' => function ($serviceManager) {
                    $config = $serviceManager->get('config');

                    $sessionDbOptions = null;
                    if ( array_key_exists('session_table', $config) && is_array($config['session_table']) ) {
                        $sessionDbOptions = new SaveHandler\DbTableGatewayOptions($config['session_table']);
                    }

                    return $sessionDbOptions;
                },
                'session_save_handler' => function ($serviceManager) {
                    $saveHandler = new SaveHandler\DbTableGateway(
                        $serviceManager->get('session_table'),
                        $serviceManager->get('session_db_options'));

                    return $saveHandler;
                },
                'session_options' => function ($serviceManager) {
                    $config = $serviceManager->get('config');

                    $sessionConfig = null;
                    if ( array_key_exists('session', $config) && is_array($config['session']) ) {
                        $sessionConfig = new SessionConfig();
                        $sessionConfig->setOptions($config['session']);
                    }

                    return $sessionConfig;
                },
                'session_save_manager' => function ($serviceManager) {
                    $sessionManager = new SessionManager(
                        $serviceManager->get('session_options'),
                        null,
                        $serviceManager->get('session_save_handler'));

                    return $sessionManager;
                },
            )
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
