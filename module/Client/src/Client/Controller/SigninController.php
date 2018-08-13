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

class SigninController extends AbstractActionController
{   
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $user_data = $this->getServiceLocator()->get('AuthService')
                ->getStorage()->read();
        if ($user_data != null ) $this->redirect ()->toUrl ('/client/home/index');
        parent::onDispatch($e);
    }
    
    public function indexAction()
    {
        $user_data = $this->getServiceLocator()->get('AuthService')
                ->getStorage()->read();
        
        
        $form = new \Client\Form\SigninForm();
        return array('form' => $form);
    }

    protected $storage;
    protected $authservice;
    
    public function getAuthService(){
        if (! $this->authservice) {
          $this->authservice = $this->getServiceLocator()->get('AuthService');
        }
        return $this->authservice;
    }
        
    public function logoutAction(){
        $this->getAuthService()->clearIdentity();
        return $this->redirect()->toRoute('home');
    }
	
  
    public function processAction()
    {

        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute(NULL , array( 
                'controller' => 'signin', 
                'action' =>  'index' 
            ));
        }

        $post = $this->request->getPost();


        $form = $this->getServiceLocator()->get('SigninForm');
        $form->setData($post);
        if ( !$form->isValid() ) {
            $model = new ViewModel(array(
//                'error' => '',
                'form'  => $form,
            ));
            $model->setTemplate('client/signin/index');
            return $model;
        } 
        
        
        
        //check authentication...
        
        $this->getAuthService()->getAdapter()
            ->setIdentity($this->request->getPost('email'))
            ->setCredential($this->request->getPost('password'));

    
        $result = $this->getAuthService()->authenticate();
        
        if ($result->isValid()) {

            $user_data = array( );
            $email = $this->request->getPost('email');
            $user_data = $this->getServiceLocator()->get('UserTable')->getUserByEmail($email);
            
             
            
//          $user_data['password'] = $this->request->getPost('password');
            $this->getAuthService()->getStorage()->write($user_data);

            if ($post['remember_me'] == 1){
                $storage = $this->getServiceLocator()->get('Client\Model\ClientAuthStorage');
                $storage->setRememberMe(1);
                $this->getAuthService()->setStorage($storage);
            } else {
                $storage = $this->getServiceLocator()->get('Client\Model\ClientAuthStorage');
                $storage->forgetMe();
                $this->getAuthService()->setStorage($storage);
            }   

            return $this->redirect()->toUrl('/client/home/index');
        }
        
        $viewModel = new ViewModel();
        if ( $result->getCode() == \Zend\Authentication\Result::FAILURE_IDENTITY_NOT_FOUND )
            $viewModel->setVariable('error', "That BulkSMS account doesn't exist. Enter a different account or get a new one.");
        else if ( $result->getCode() == \Zend\Authentication\Result::FAILURE_CREDENTIAL_INVALID )
            $viewModel->setVariable('error', "That password is incorrect. Be sure you're using the password for your BulkSMS account.");
        
        $viewModel->setVariable('form', $form);
        $viewModel->setTemplate('client/signin/index');
        return $viewModel;
        

    }

    public function confirmAction()
    {
//        $user_data = $this->getAuthService()->getStorage()->read();
////        $this->layout('layout/layout');
//        $this->layout('layout/layout');
//        $this->layout()->user_data = $user_data;
//        
//        $viewModel  = new ViewModel(array(
//            'user_data' => $user_data, 
//        )); 
//        
//        return $viewModel; 
        
        return $this->redirect()->toRoute('home');
    }
    
    public function forgotpasswordAction(){
        
        
        $this->layout('layout/recovery_layout');
        $viewModel = new ViewModel();
        if ( !$this->request->isPost() ){
            return $viewModel;
        }
    
        $post = $this->request->getPost();
        $option = $post['fgpass_options'];
        
        if ( $option == 1){
//            $viewModel->setTemplate('client/signin/recover');
            $this->redirect()->toRoute(NULL, array(
                'controller' => 'signin',
                'action' => 'recover',
            ));
            
        }else if ( $option == 2 ){
//            $viewModel->setTemplate('client/signin/logintip');
            $this->redirect()->toRoute(NULL, array(
                'controller' => 'signin',
                'action' => 'logintip',
            ));
        }
        
        return $viewModel;
        
    }
    
    
    
    public function recoverAction(){
        $this->layout('layout/recovery_layout');
        
        $viewModel = new ViewModel();
        if ( !$this->request->isPost() ){
            return $viewModel;
        }
        
        $post = $this->request->getPost();
        $email = $post['email'];
        
        $userTable = $this->getServiceLocator()->get('UserTable');
        $user = $userTable->getUserByEmail($email);
               
        if ( false == $user ){
            $viewModel->setVariable('error', 'user for this email is not registered. use registered email address.');
            return $viewModel;
        }
        
        //follow recovery steps here
        $user = $userTable->setupResetPasswordHash($user);
        if ( null == $user ){
            $viewModel->setVariable('error', 'something went wrong. try again');
            return $viewModel;
        }
        
        $status = $this->send_reset_password_email($user);
        if ( false == $status ){
            $viewModel->setVariable('error', 'couldn\'t send email at this time. please try again later');
            return $viewModel;
        }
        
        $viewModel->setVariable('status', 'complete');
        return $viewModel;
        
        
    }
    
    public function resetAction(){
        $this->layout('layout/recovery_layout');
        $reset_password_token = $this->params()->fromQuery('token');
        if ( null == $reset_password_token ){
            $this->redirect()->toUrl('client/signin/index');
        }
        
        $userTable = $this->getServiceLocator()->get('UserTable');
        $user = $userTable->getUserByResetPasswordToken($reset_password_token);
        if ( false == $user ){
            $this->redirect()->toUrl('client/signin/index');
        }
             
        $viewModel = new ViewModel();
        $viewModel->setVariable('form', $this->getServiceLocator()->get('PasswordForm'));
        $viewModel->setVariable('reset_password_token', $reset_password_token);
        return $viewModel;
    }
    
    public function completeAction(){
        $this->layout('layout/recovery_layout');
        $viewModel = new ViewModel();
        if ( !$this->request->isPost() ){
            $this->redirect()->toUrl('client/signin/index');
        }
        
        $post = $this->request->getPost();
        $reset_password_token = $this->params()->fromQuery('token');
//        \Zend\Debug\Debug::dump($reset_password_token);
        $userTable = $this->getServiceLocator()->get('UserTable');
        $user = $userTable->getUserByResetPasswordToken($reset_password_token);

        
        $userTable->setUserEncryptedPassword($user, $post['password']);
        $viewModel->setVariable('status', 'complete');
        $viewModel->setTemplate('client/signin/reset');
        return $viewModel;
        
    }
    
    public function logintipAction(){
        $this->layout('layout/recovery_layout');
        $viewModel = new ViewModel();
        return $viewModel;
    }
    
    
    protected function send_reset_password_email($user){
        require_once 'libphp-phpmailer/class.phpmailer.php';
        
        $view = new \Zend\View\Renderer\PhpRenderer();
        $resolver = new \Zend\View\Resolver\TemplateMapResolver();
        $resolver->setMap(array(
            'mailTemplate' => __DIR__ . '/../../../view/client/emails/recover.phtml', 
        ));
        $view->setResolver($resolver);
        $viewModel = new ViewModel();
        $viewModel->setTemplate('mailTemplate')->setVariables(array(
            'username' => $user->last_name,
            'email' => $user->email,
            'token' => $user->reset_password_token,
        ));
        $bodyPart = new \Zend\Mime\Message();
        $bodyMessage    = new \Zend\Mime\Part($view->render($viewModel));
        $bodyMessage->type = 'text/html';
        $bodyPart->setParts(array($bodyMessage));
        
        
        $mail = new \PHPMailer();
        //Send mail using gmail
        if(1){
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->SMTPAuth = true; // enable SMTP authentication
            $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
            $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
            $mail->Port = 465; // set the SMTP port for the GMAIL server
            $mail->Username = "jamil.farooq@gorillabox.net"; // GMAIL username
            $mail->Password = "p35215824p-"; // GMAIL password
        }

        
        //Typical mail data
        $mail->AddAddress($user->email, $user->last_name);
        $mail->SetFrom('jamil.farooq@gorillabox.net', 'BulkSMS Support');
        $mail->Subject = "Reset Password email";
//        $mail->Body = "Hi ".$user->last_name.' please access following link to reset your password on BulkSMS.com http://bulk_sms/client/signin/reset?token='.$user->reset_password_token;
        $mail->Body = $bodyMessage->getContent();
        $mail->IsHTML(true);
        try{
            $mail->Send();
            return true;
        } catch(Exception $e){
            //Something went bad
            echo "Fail - " . $mail->ErrorInfo;
            return false;
        }
    }
    
}
