<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Common;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    
    public function getServiceConfig(){
        return array(
            'abstract_factories' => array(),
            'aliases' => array(),
            'factories' => array(
                // SERVICES
                
                //DB
                'UserTable' => function($sm){
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new \Common\Model\UserTable($tableGateway);
                    return $table;
                },
                'UserTableGateway' => function($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new \Common\Model\User());
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
                'SMSPackageTable' => function($sm){
                    $tableGateway = $sm->get('SMSPackageTableGateway');
                    $table = new \Common\Model\SMSPackageTable($tableGateway);
                    return $table;
                },
                'SMSPackageTableGateway' => function($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new \Common\Model\SMSPackage());
                    return new TableGateway('sms_package', $dbAdapter, null, $resultSetPrototype);
                },
                'CampaignTable' => function($sm){
                    $tableGateway = $sm->get('CampaignTableGateway');
                    $table = new \Common\Model\CampaignTable($tableGateway);
                    return $table;
                },
                'CampaignTableGateway' => function($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new \Common\Model\Campaign());
                    return new TableGateway('campaign', $dbAdapter, null, $resultSetPrototype);
                },
                'SubscriberListTable' => function($sm){
                    $tableGateway = $sm->get('SubscriberListTableGateway');
                    $table = new \Common\Model\SubscriberListTable($tableGateway, $sm);
                    return $table;
                },
                'SubscriberListTableGateway' => function($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new \Common\Model\SubscriberList());
                    return new TableGateway('subscribers_list', $dbAdapter, null, $resultSetPrototype);
                },        

            ),
            'invokeables' => array(),
            'services' => array(),
            'shared' => array(),
        );
    }
    
}
