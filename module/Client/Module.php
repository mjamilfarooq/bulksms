<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Client;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

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
                'Client\Model\ClientAuthStorage' => function($sm){
                    return new \Client\Model\ClientAuthStorage('bulksms');
                },
                // SERVICES
                'AuthService' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'users','email','encrypted_password', 'sha1(?)');

                    $authService = new AuthenticationService();
                    $authService->setAdapter($dbTableAuthAdapter);
                    $authService->setStorage($sm->get('Client\Model\ClientAuthStorage'));
                    return $authService;
                },
                //DB
                
                        
                //FORMS
                'SignInForm' => function($sm){
                    $form = new \Client\Form\SigninForm();
                    $form->setInputFilter($sm->get('SigninFilter'));
                    return $form;
                },
                'SignupForm' => function($sm){
                    $form = new \Client\Form\SignupForm();
                    $form->setInputFilter($sm->get('SignupFilter'));
                    return $form;
                },
                'PasswordForm' => function($sm){
                    $form = new \Client\Form\PasswordForm();
                    $form->setInputFilter($sm->get('PasswordFilter'));
                    return $form;
                },
                'CampaignForm' => function($sm){
                    /*
                     * this service is now populating subscriberList for campaign
                     * form and return campaign form instance.
                     */
                    $user_data = $sm->get('AuthService')->getStorage()->read();
                    $subscriberList = $sm->get('SubscriberListTable');
                    $list = $subscriberList->fetchAllforClientAsArray($user_data->id);                   
                    $form = new \Client\Form\CampaignForm('CampaignForm', $list);
                    $form->setInputFilter($sm->get('CampaignFilter'));
                    return $form;
                },
                'SubscriberListForm' => function($sm){
                    $smsPackageTable = $sm->get('SMSPackageTable');
                    $list = $smsPackageTable->fetchAllAsArray();
                    $form = new \Client\Form\SubscriberListForm("subscriber", $list);
                    $form->setInputFilter($sm->get('SubscriberListFilter'));
                    return $form;
                },
                'SubscribeForm' => function($sm){
                    $form = new \Client\Form\SubscribeForm();
                    $form->setInputFilter($sm->get('SubscribeFilter'));
                    return $form;
                },
                //Filters
                'SignInFilter' => function($sm){
                    $filter = new \Client\Form\SigninFilter();
                    return $filter;
                },
                'SignupFilter' => function($sm){
                    $filter = new \Client\Form\SignupFilter();
                    return $filter;
                },
                'PasswordFilter' => function($sm){
                    $filter = new \Client\Form\PasswordFilter();
                    return $filter;
                },
                'CampaignFilter' => function($sm){
                    $filter = new \Client\Form\CampaignFilter();
                    return $filter;
                },
                'SubscriberListFilter' => function($sm){
                    $filter = new \Client\Form\SubscriberListFilter();
                    return $filter;
                },
                'SubscribeFilter' => function($sm){
                    $filter = new \Client\Form\SubscribeFilter();
                    return $filter;
                },
            ),
            'invokeables' => array(),
            'services' => array(),
            'shared' => array(),
        );
    }
    
}
