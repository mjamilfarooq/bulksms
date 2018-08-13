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

class HomeController extends ClientActionController
{   
    public function indexAction(){
    
//        $authService = $this->getServiceLocator()->get('AuthService');
//        $user_data = $authService->getStorage()->read();
//        $this->layout('client/layout');
//        $this->layout()->user_data = $user_data;
        $viewModel = new ViewModel(array(
            'sms_package' => $this->getServiceLocator()->get('SMSPackageTable')->fetchAll(),
//            'subscriberList' => $this->getServiceLocator()
//                ->get('SubscriberListTable')
//                ->fetchAllByClientID($user_data['id']),
            'user_data' => $this->user_data,
        ));
        return $viewModel;
    }

    public function passwordAction(){
        $viewModel = new ViewModel(array(
            'form' => $this->getServiceLocator()->get('PasswordForm'),
        ));
        return $viewModel;
    }
    
    public function processAction(){
        if ( !$this->request->isPost() ){
            $this->redirect()->toRoute(NULL, array(
                'controller' => 'home',
                'action' => 'index',
            ));
        }
        
        
        $post = $this->request->getPost()->toArray();
        if ( $post['password'] === $post['confirm_password']){
            $userTable = $this->getServiceLocator()->get('UserTable');
            $user = $userTable->getUserByID($this->user_data->id);
            $userTable->setUserEncryptedPassword($user, $post['password']);
            $authService = $this->getServiceLocator()->get('AuthService');
//            $authService->clearIdentity();
//            
//            $this->redirect()->toRoute(NULL, array(
//                'controller' => 'signin',
//                'action' => 'index',
//            ));
            $this->flashMessenger()->addMessage('You have successfully changed the password!');
            $this->redirect()->toUrl('/client/home/index');
            
        }else {
            $viewModel = new ViewModel(array(
                'controller' => 'home',
                'action' => 'password',
                'form' => $this->getServiceLocator()->get('PasswordForm'),
                'error' => 'Please make sure, password and confirm password fields are alike!',
            ));
            $viewModel->setTemplate('/client/home/password');
            return $viewModel;
        }
        
        
    }
}
