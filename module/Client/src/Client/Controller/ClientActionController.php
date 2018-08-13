<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Client\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClientActionController extends AbstractActionController
{   
    protected $user_data;
    protected $sm;
    //this should ensure proper Authentication and redirection in case of unauthentic request
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $this->sm = $this->getServiceLocator();
        $user_data = $this->sm->get('AuthService')->getStorage()->read();
        if ( null == $user_data ){
            $this->redirect()->toUrl('/client/signin/index');
        }
        $this->user_data = $user_data;
        $this->layout('client/layout');
        $this->layout()->user_data = $user_data;
        return parent::onDispatch($e);
        
    }       
    
}
