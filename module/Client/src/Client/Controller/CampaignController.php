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
use Common\Model\Campaign;

class CampaignController extends ClientActionController
{   
    
    /*
     * onDispatch will prevent any access from client
     * witch doesn't own the campaign. As particular campaign is reference by 
     * id in url, it is required to prevent such access. 
     */
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        parent::onDispatch($e);
        
        $id = $this->params()->fromRoute('id');
        if ( null != $id ){
            $sm = $this->getServiceLocator();
            $campaignTable = $sm->get('CampaignTable');
            $subscriberListTable = $sm->get('SubscriberListTable');
            $campaign = $campaignTable->getByID($id);
            $subscriberList = $subscriberListTable->getByID($campaign->subscriber_list_id);
            if ( null != $subscriberList )       
            if ( $subscriberList->client_id != $this->user_data->id ){
                $this->redirect()->toUrl('/client/campaign/index');
            }
        }
    }
    
    protected function getSubscriptionTableFromListID($id){
        $sm = $this->getServiceLocator();
        $subscriberListTable = $sm->get('SubscriberListTable');
        $subscriberList = $subscriberListTable->getByID($id);
        $subscriptionTable = new SubscriptionTable($sm, $subscriberList->list_table_name);
        return $subscriptionTable;
    }
    
    public function indexAction(){
        $page = $this->params()->fromRoute('page');
        $campaignTable = $this->getServiceLocator()->get('CampaignTable');
                
        
        $paginator = new \Zend\Paginator\Paginator(
                $campaignTable->getDbAdapterForPagination($this->user_data->id));
        
        $subscriberListTable = $this->getServiceLocator()->get('SubscriberListTable');
        $subscriberLists = $subscriberListTable->fetchAllByClientID($this->user_data->id);
        
        $count_array = [];
        foreach ( $subscriberLists as $subscriberList){
            $subscriptionTable = new \Common\Model\SubscriptionTable(
                $this->getServiceLocator(), 
                $subscriberList->list_table_name);
            $count_array[$subscriberList->list_id] = $subscriptionTable->count(); 
        }
        
        
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(10);
        $viewModel = new ViewModel(array(
            'paginator' => $paginator,
            'count_array' => $count_array,
        ));
        return $viewModel;
    }
    
    public function addAction(){
        $form = $this->getServiceLocator()->get('CampaignForm');
        $viewModel = new ViewModel(array(
            'form' => $this->getServiceLocator()->get('CampaignForm'),
            'title' => 'Create Campaign',
            'action' => 'process',
        ));
        $viewModel->setTemplate('client/campaign/add');
        return $viewModel;
    }

    public function editAction(){
    
        $campaign_id = $this->params()->fromRoute('id');
        $campaignTable = $this->getServiceLocator()->get('CampaignTable');
        $campaign = $campaignTable->getByID($campaign_id);
        $is_editable = $campaignTable->isEditable($campaign_id);

        $form = $this->getServiceLocator()->get('CampaignForm');
        $form->bind($campaign);
        
        $viewModel = new ViewModel(array(
            'form' => $form,
            'title' => 'Edit Campaign',
            'action' => 'editprocess',
            'is_editable' => $is_editable,
        ));
        $viewModel->setTemplate('client/campaign/add');
        return $viewModel;
    }
    
    
    public function processAction(){
        //if not a http post request redirect to add campaign page
        if ( !$this->request->isPost() ){
            $this->redirect()->toUrl('/client/campaign/add');
        }
        $data = $this->request->getPost()->toArray();
        $campaign = new Campaign();
        $campaign->exchangeArray($data);
        $campaignTable = $this->getServiceLocator()->get('CampaignTable');
        $subscriberListTable = $this->getServiceLocator()->get('SubscriberListTable');
        $list = $subscriberListTable->getByID($campaign->subscriber_list_id);
        $campaign->plan_id = $list->package_id;
        $campaign_id = $campaignTable->create($campaign);
        
        if ( null == $campaign_id ){
            $message = "Something went wrong, please report the issue";
            $this->flashMessenger()->addMessage($message);
        } else {
            $message = "Campaign has been added successfully!";
            $this->flashMessenger()->addMessage($message);
        }
        
        $this->redirect()->toRoute(NULL, array('controller' => 'campaign', 
            'action' => 'index',
        ));
        
    }
    
    public function editprocessAction(){
        //if not a http post request redirect to add campaign page
        if ( !$this->request->isPost() ){
            $this->redirect()->toUrl('/client/campaign/add');
        }
        $data = $this->request->getPost()->toArray();
        $campaign = new Campaign();
        $campaign->exchangeArray($data);
        $campaignTable = $this->getServiceLocator()->get('CampaignTable');
        $subscriberListTable = $this->getServiceLocator()->get('SubscriberListTable');
        $list = $subscriberListTable->getByID($campaign->subscriber_list_id);
        $campaign->plan_id = $list->package_id;
        
        \Zend\Debug\Debug::dump($campaign);
        
        $campaign_new = $campaignTable->update($campaign);
        
        if ( $campaign_new == 0 ) {
            $message = "Campaign can't be updated while running or has already expired!";
            $this->flashMessenger ()->addMessage ($message); 
        }else if ( $campaign_new == null ){
            $message = "Something went wrong while updating campaign";
            $this->flashMessenger ()->addMessage ($message); 
        }else{
            $message = "Campaign updated successfully!";
            $this->flashMessenger ()->addMessage ($message); 
        }
        
        $this->redirect()->toRoute(NULL, array(
            'controller' => 'campaign', 
            'action' => 'index',
        ));
        
    }
    
    
    public function deleteAction(){
        $campaign_id = $this->params()->fromRoute('id');
        $campaign = $this->getServiceLocator()->get('CampaignTable')
                       ->delete($campaign_id);
        
        if ( $campaign == 0 ){
            $message = "Something went wrong, please report the issue";
            $this->flashMessenger()->addMessage($message);
        } else if ( $campaign == null ){
            $message = "Something went wrong, please report the issue";
            $this->flashMessenger()->addMessage($message);
        } else {
            $message = "Campaign has been deleted successfully!";
            $this->flashMessenger()->addMessage($message);
        }
        
        $this->redirect()->toUrl('/client/campaign/index');
        
        
    }
    
    public function pauseAction(){
        $campaign_id = $this->params()->fromRoute('id');
        $campaign = $this->getServiceLocator()->get('CampaignTable')
                       ->pause($campaign_id);
        $this->redirect()->toUrl('/client/campaign/index');
        
        
    }
    
    public function playAction(){
        $campaign_id = $this->params()->fromRoute('id');
        $campaign = $this->getServiceLocator()->get('CampaignTable')
                       ->play($campaign_id);
        $this->redirect()->toUrl('/client/campaign/index');
    }
    
}
