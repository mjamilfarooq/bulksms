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


class SignupController extends AbstractActionController
{
    public function indexAction(){
        $this->layout('layout/layout');
        $form = new \Client\Form\SignupForm();
        return array('form' => $form);
    }

    public function processAction(){
        $this->layout('layout/recovery_layout');
        $viewModel = new ViewModel();
        
        //if directly try to access process action
        if (!$this->request->isPost()){
            $form = $this->getServiceLocator()->get('SignupForm');
            $viewModel->setVariable('form', $form);
            $viewModel->setTemplate('client/signup/index');
            return $viewModel;
        }
        
        //getting post data and filling form with it.
        $post = $this->request->getPost();
        
        $form = $this->getServiceLocator()->get('SignupForm');
        $form->setData($post);
        
        //check to see if user already exist. if user already exist abort sign up
        $userTable = $this->getServiceLocator()->get('UserTable');
        $user = $userTable->getUserByEmail($post->email);
        if ( $user == true ){
            $this->layout('layout/layout');
            $error = "Email already registered!";
            $viewModel->setVariable('error', $error);
            $viewModel->setVariable('form', $form);
            $viewModel->setTemplate('client/signup/index');
            return $viewModel;
        }
        
        if ( !$form->isValid() ){
            $error = "One or more errors with your submission. please resubmit entries";
            $viewModel->setVariable('error', $error);
            $viewModel->setVariable('form', $form);
            $viewModel->setTemplate('client/signup/index');
            return $viewModel;
        }
        $data = $form->getData();
        
        
        $user = new \Common\Model\User();
        $user->exchangeArray($data);
        $user = $userTable->createNewUser($user); 
        
 
        
        
        if ($this->send_signup_email($user)){
            $viewModel->setTemplate('client/signup/successfull');
            return $viewModel;
        }else{
            $viewModel->setVariable('form', $form);
            $viewModel->setTemplate('client/signup/index');
            return $viewModel;
        }
    }
    
    
    protected function successfullAction(){
        $this->layout('layout/recovery_layout');
        $viewModel = new ViewModel();
        return $viewModel;
    }
    
    protected function exist(){
        $viewModel = new ViewModel();
        return $viewModel;
    }
    
    protected function send_signup_email($user){
        
        if ( $user == null ) {
            return  false;

        }
                
        $view = new \Zend\View\Renderer\PhpRenderer();
        $resolver = new \Zend\View\Resolver\TemplateMapResolver();
        $resolver->setMap(array(
            'mailTemplate' => __DIR__ . '/../../../view/client/emails/account.phtml', 
        ));
        $view->setResolver($resolver);
        $viewModel = new ViewModel();
        $viewModel->setTemplate('mailTemplate')->setVariables(array(
            'username' => $user->last_name,
            'email' => $user->email,
            'token' => $user->signup_token,
        ));
        $bodyPart = new \Zend\Mime\Message();
        $bodyMessage    = new \Zend\Mime\Part($view->render($viewModel));
        $bodyMessage->type = 'text/html';
        $bodyPart->setParts(array($bodyMessage));
 
        $mail = $this->getServiceLocator()->get('Mailer');

        
        //Typical mail data
        $mail->AddAddress($user->email, $user->last_name);
        $mail->Subject = "Account activation email";
        $mail->Body = "Hi ".$user->last_name.' please access following link to complete the activation process on BulkSMS.com http://bulksms/client/signup/setup?token='.$user->signup_token;
        $mail->Body = $bodyMessage->getContent() ;
        $mail->IsHTML(true);
        try{
            if ($mail->Send())
                return true;
            else {    
                var_dump($mail->ErrorInfo);
//                throw new \Exception("mail function fails " + $mail->ErrorInfo);
                return false;
            }
        } catch(Exception $e){
            //Something went bad
            echo "Fail - " . $mail->ErrorInfo;
            return false;
        }
    }
    
    public function setupAction(){
        $this->layout('layout/recovery_layout');
        $viewModel = new ViewModel();
        $signup_token = $this->params()->fromQuery('token');
        if ( !isset($signup_token) ){
            $this->redirect()->toUrl('/client/signup');
        }
        
        $userTable = $this->getServiceLocator()->get('UserTable');
        $user = $userTable->getUserBySignupToken($signup_token);
        if ( $user == null ){
            
            $viewModel->setTemplate('error/404');
            return $viewModel;
//            $this->redirect()->toUrl('/client/signup');
        }
        
        //if user with signup_token exist allow user to setup password
        $form = $this->getServiceLocator()->get('PasswordForm');
        $viewModel->setTemplate('client/signup/password');
        $viewModel->setVariable('form', $form);
        $viewModel->setVariable('signup_token', $signup_token);
        
        return $viewModel;
        
    }
    
    public function completeAction(){
        $this->layout('layout/recovery_layout');
        $viewModel = new ViewModel();
        if ( !$this->request->isPost() ){
            $this->redirect()->toUrl('/client/signup/index');
        }
        //getting posted password info and signup_token
        $post = $this->request->getPost();
        $signup_token = $this->params()->fromQuery('token');
        \Zend\Debug\Debug::dump($signup_token);
//        \Zend\Debug\Debug::dump($post);
        //pull user info from database
        $userTable = $this->getServiceLocator()->get('UserTable');
        $user = $userTable->getUserBySignupToken($signup_token);
        
        //set the password for user for subscequent logins
        $userTable->setUserEncryptedPassword($user, $post['password']);
        
//        redirect to login page
        $this->redirect()->toUrl('/client/signin/index');
    }
}
