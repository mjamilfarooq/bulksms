<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Client\Controller;

use Zend\View\Model\ViewModel;
use Common\Model\Subscription;
use Common\Model\SubscriberList;
use Common\Model\SubscriptionTable;


class SubscriptionController extends ClientActionController
{   
    
    protected $list_id; //holds id of current subscriberList if provided in route
    protected $subscriberList;  //holds current subscriberList
    protected $subscriberListTable; //hold instance of SubscriberListTable
    
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        
        parent::onDispatch($e);
        $id = $this->params()->fromRoute('id');
        if ( null != $id ){
            $subscriberListTable = $this->getServiceLocator()->get('SubscriberListTable');
            $subscriberList = $subscriberListTable->getByID($id);
            if ( null != $subscriberList ){
                if ( $subscriberList->client_id != $this->user_data->id ){
                    $this->redirect()->toUrl('/client/subscription/index');
                    
                }
            }
        }
        
        
        
    }
    
    public function addAction(){
        $package = $this->params()->fromQuery('package');
        
        $form = $this->getServiceLocator()->get('SubscriberListForm');
        if ( $package != null ){
            $select = $form->get('package_id')->setValue($package);
        }
        
        $viewModel = new ViewModel(array(
            'form' => $form,
            'action' => 'process',
            'user_data' => $this->user_data,
        ));
        $viewModel->setTemplate('/client/subscription/add');
        return $viewModel;
    }
    
    public function processAction(){
        if ( !$this->request->isPost() ){
            $this->redirect()->toUrl("/client/subscription/index");
        }
        
        $post = $this->request->getPost()->toArray();
        $subscriberList = new SubscriberList();
        $subscriberList->exchangeArray($post);
        $subscriberListTable = $this->getServiceLocator()->get('SubscriberListTable');
        $subscriberListTable->create($subscriberList);
        
        $message = "You have successfully added new subscriber list";
        $this->flashMessenger()->addMessage($message);
        
        $this->redirect()->toRoute(NULL, array(
            'controller' => 'subscription', 
            'action' => 'index',
            ));
        
    }
    
    
    
    public function editAction(){
        if ( !$this->request->isPost() ){
            $this->redirect()->toRoute(NULL, array(
                'controller' => 'subscription',
                'action' => 'more',
            ));
        }
        
        $id = $this->params()->fromRoute('id');
        $page = $this->params()->fromRoute('page');
        
        $post = $this->getRequest()->getPost();
        $data = $post->toArray();
        
        $subscription = new Subscription();
        $subscription->exchangeArray($data);
//        \Zend\Debug\Debug::dump($subscription);
        
        $subscriptionTable = $this->getSubscriptionTableFromIDAtRoute();
        $subscriptionTable->update($subscription);
        
        $message = 'You have successfully updated subscriber information';
        $this->flashMessenger()->addMessage($message);
        
        
        $this->redirect()->toRoute(NULL, array(
            'controller' => 'subscription',
            'action' => 'more',
            'id' => $id,
            'page' => $page,
            
        ));
    }
    
    public function deleteAction(){
        
    }
    
    public function indexAction(){
        
        $subscriberListTable = $this->getServiceLocator()
                ->get('SubscriberListTable');
        $subscriberList = $subscriberListTable
                ->getSubscriptionListWithPlanforClient($this->user_data->id);
        
        

        $paginator = new \Zend\Paginator\Paginator($subscriberListTable->getDbAdapterForPagination($this->user_data->id));
        
        $page = $this->params()->fromRoute('page');
        
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(10);
        
        $viewModel = new ViewModel(array(
            'paginator' => $paginator,
        ));
        return $viewModel;
    }
    
    public function uploadAction(){
    
        if ( !$this->request->isPost() ){
            $this->redirect()->toRoute('client/subscription');
        }
        
        $id = $this->params()->fromRoute('id');
        if ( null == $id ){
            $this->redirect()->toUrl('client/subscription/index');
        }
        $post = $this->request->getPost();
//        \Zend\Debug\Debug::dump($post);
        $file = $this->params()->fromFiles();
        $config = $this->getServiceLocator()->get('config');
        $uploadPath = $config['module_config']['upload_location'];
//        \Zend\Debug\Debug::dump($uploadPath);
        $adapter = new \Zend\File\Transfer\Adapter\Http();
        $adapter->setDestination($uploadPath);
        $adapter->receive($post['filename']);

        $file_name = $uploadPath.'/'.$file['filename']['name'];
        
        
        
        //writing csv into corresponding subscription table
        $f = fopen($file_name, 'r');
        
        if ( FALSE == $f ){
            error_log("SubscriptionController: can't open file ".$file_name."\n");
            return $this->redirect()->toUrl('/client/subscription/more/'.$id);
        }
        $subscription = new Subscription();
        $subscriptionTable = $this->getSubscriptionTableFromIDAtRoute();
        $first_iteration = true;
        while ( ($csv_row = fgets($f))!= false ){
            if ( $first_iteration ){//check to see if first row in CSV is desired header
                if ( $subscription->hasValidCSVHeader($csv_row) ){
                    $first_iteration = false;
                    continue;
                }
                else{
                    
                    break;
                }
                
            }

            $subscription->exchangeCSV($csv_row);
            $subscriptionTable->subscribe($subscription);

        }
        fclose($f);
        unlink($file_name);    
        
        if ( $first_iteration ){
            $message = "File has invalid header/data";
            $this->flashMessenger()->addMessage($message);
            return $this->redirect()->toUrl('/client/subscription/more/'.$id);
        }
        //route to subscription list more page
        $message = "Your file has been uploaded successfully";
        $this->flashMessenger()->addMessage($message);
        return $this->redirect()->toUrl('/client/subscription/more/'.$id);
        
    }
    
    
    
    protected function getSubscriptionTableFromIDAtRoute(){
        $id = $this->params()->fromRoute('id');
        $sm = $this->getServiceLocator();
        $subscriberListTable = $sm->get('SubscriberListTable');
        $subscriberList = $subscriberListTable->getByID($id);
        $subscriptionTable = new SubscriptionTable($sm, $subscriberList->list_table_name);
        return $subscriptionTable;
    }
    
    protected function getAllSubscriptionsFromIDAtRoute(){
        $subscriberListTable = $this->getServiceLocator()->get('SubscriberListTable');
        $subscriberList = $subscriberListTable->getByID($this->params()->fromRoute('id'));
        $subscriptionTable = new SubscriptionTable($this->getServiceLocator(), $subscriberList->list_table_name);
        return $subscriptionTable->fetchAll();
    }
    //Backup all the contacts in subscriber lists
    public function backupAction(){
  
  
        $subscriptions = $this->getAllSubscriptionsFromIDAtRoute();
        $total = count($subscriptions);
        
        if ( $total == 0 ){
            $this->flashMessenger()->addMessage("No records for backup");
            $url = $this->getRequest()->getHeader('Referer')->getUri();
            return $this->redirect()->toUrl($url);
        }
        
        $config = $this->getServiceLocator()->get('config');
        $loc = $config['module_config']['upload_location'];
        $file_name = $loc.'/contacts'.'_'.date('Y-m-d h:i:s').'.txt';
        
        
        $file = fopen($file_name,'w');
        
        if ( $file == false ){
            error_log("SubscriptionController[backupAction]: Can't Open file");
            $this->redirect()->toRoute(NULL, array('controller' => 'subscription',
                'action' => 'index'));
        }
        //should write in CSV format subscription recordset
        $first_iteration = true;
        foreach ( $subscriptions as $subscription){
            if ( $first_iteration ){
                $first_iteration = false;
                fwrite($file, "first name, last name, cell, email, street address\n");
            }
            $csv_string = $subscription->getCSVCopy();
            $len = strlen($csv_string);
            fwrite($file, $csv_string."\n");
        }
        fclose($file);
        
        
        $response = new \Zend\Http\Response\Stream();
        $response->setStream(fopen($file_name,'r'));
        $response->setStatusCode(200);
        $response->setStreamName(basename($file_name));
        $headers = new \Zend\Http\Headers();
        $headers->addHeaders(array(
            'Content-Disposition' => 'attachment; filename="' . basename($file_name) .'"',
            'Content-Type' => 'application/octet-stream',
            'Content-Length' => filesize($file_name),
            'Expires' => '@0', // @0, because zf2 parses date as string to \DateTime() object
            'Cache-Control' => 'must-revalidate',
            'Pragma' => 'public'
        ));
        $response->setHeaders($headers);
        unlink($file_name);
        
        return $response;
        
        
    }
    
    public function subscribeAction(){
        if (!$this->request->isPost()) {
            $this->redirect()->toRoute(NULL, array(
                'controller' => 'subscription',
                'action' => 'more'
            ));
        }

        $post = $this->request->getPost()->toArray();
        if ( null == $post ){
            $this->redirect()->toRoute(NULL, array(
                'controller' => 'subscription',
                'action' => 'more'
            ));
        }
        
        
        $subscription = new Subscription();
        $subscription->exchangeArray($post);
        
        $subscriptionTable = $this->getSubscriptionTableFromIDAtRoute();
        $subscriptionTable->subscribe($subscription);
        
        $id = $this->params()->fromRoute('id');
        $message = "New subscriber added successfully";
        $this->flashMessenger()->addMessage($message);
        
        $this->redirect()->toRoute(NULL, array(
            'controller' => 'subscription',
            'action' => 'more',
            'id' => $id,
        ));
    }
    
    public function unsubscribeAction(){
        $user_id = $this->params()->fromRoute('user_id');
        $page = $this->params()->fromRoute('page');
        $id = $this->params()->fromRoute('id');
        
        if ( null == $user_id ){
            $this->redirect()->toRoute(NULL, array(
                'controller' => 'subscription',
                'action' => 'index'));
        }
        
        $subscriptionTable = $this->getSubscriptionTableFromIDAtRoute();
        $subscriptionTable->unsubscribe($user_id);
        
        $message = "Subscriber has been deleted successfully!";
        $this->flashMessenger()->addMessage($message);
        
        $this->redirect()->toRoute(NULL, array(
            'controller' => 'subscription',
            'action' => 'more',
            'page' => $page,
            'id' => $id,
        ));
        
        
    }
    
    public function moreAction(){
        
        $search_string = null;
        if ( $this->request->isPost() ){
            $search_string = $this->request->getPost()['search'];
        }
        
        if ( $temp = $this->params()->fromQuery('search') ){
            $search_string = $temp;
        }
            
        $id = $this->params()->fromRoute('id');
        $page = $this->params()->fromRoute('page');
        $subscriberList = $this->getServiceLocator()->get('SubscriberListTable')
                ->getByID($id);
        
        $subscriptionTable = $this->getSubscriptionTableFromIDAtRoute();
        
        $paginator = new \Zend\Paginator\Paginator($subscriptionTable->getDbAdapterforPagination($search_string));
        
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(10);
        
        $form = $this->getServiceLocator()->get('SubscribeForm');
        
        if ( $search_string != null && $paginator->count() == 0)
            $error = 'No record found!';
        
        $viewModel = new ViewModel(array(
            'paginator' => $paginator,
            'subscriberList' => $subscriberList,
            'search_string' => $search_string,
            'form' => $form,
            'error' => $error,
          
        ));
        return $viewModel;
    }
    
    
    public function changeAction(){
        
        $id  = $this->params()->fromRoute('id');
        if ( null == $id ){
            $this->redirect()->toRoute(NULL, array(
                'controller' => 'subscription',
                'action' => 'index',
            ));
        }
        
        $form = $this->getServiceLocator()->get('SubscriberListForm');
        $subscriberList = $this->getServiceLocator()->get('SubscriberListTable')
                ->getByID($id);
        
  
        $form->bind($subscriberList);
        
        
        
        $viewModel = new ViewModel(array(
            'controller' => 'subscription',
            'action' => 'update',
            'user_data' => $this->user_data,
            'form' => $form,
        ));
        
        $viewModel->setTemplate('/client/subscription/add');
        return $viewModel;
    }
    
    public function updateAction(){
        if ( !$this->request->isPost() ){
            $this->redirect()->toRoute(NULL, array(
                'controller' => 'subscription',
                'action' => 'index',
            ));
        }
        
        $data = $this->request->getPost()->toArray();
        $subscriberList = new SubscriberList();
        $subscriberList->exchangeArray($data);
        
        
        $subscriberListTable = $this->getServiceLocator()->get('SubscriberListTable');
        $ret = $subscriberListTable->update($subscriberList);

        if ( $ret == 0 ){
            
        }else if ( $ret == null ){
            $message = "Something went wrong, please report issue!";
            $this->flashMessenger()->addMessage($message);
        }else {
            $message = "List has been successfully updated!";
            $this->flashMessenger()->addMessage($message);
        }
        
        $this->redirect()->toRoute(NULL, array(
            'controller' => 'subscription',
            'action' => 'index',
        ));
        
        
    }
    
}
