<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Common\Model;


use Zend\Db\TableGateway\TableGateway;

class SubscriberListTable{
    protected $tableGateway;
    protected $sm;
    
    public function __construct(TableGateway $tableGateway, $sm) {
        $this->tableGateway = $tableGateway;
        $this->sm = $sm;
    }
    
    /*
     * create new subscriberlist 
     * also create subscription table to hold all subscribers info
     * for subscriberList
     * and return the id of newly created list.
     * in case of failure it returns false;
     */
    public function create(SubscriberList $list){
        if ( !isset($list) ) return null;
        
        $smsPackage = $this->sm->get('SMSPackageTable')->getByID($list->package_id);
        $data = array(
//            "list_id" => $list->list_id, 
            "client_id" => $list->client_id,
            "package_id" => $list->package_id,
            "list_name" => $list->list_name,
//            "list_table_name" => $list->list_table_name,
            "description" => $list->description, 
            "enabled" => $list->enabled, 
            "sent_sms" => 0, 
            "expiry_date" => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').' + '.$smsPackage->validity.' days')), 
            "created_at" => date('Y-m-d H:i:s'), 
            "updated_at" => date('Y-m-d H:i:s'), 
//            "archive_number" => $list->archive_number, 
//            "archived_at" => $list->archived_at,
        );
        
        try {
            $this->tableGateway->insert($data);
            $id = $this->tableGateway->getLastInsertValue();
            $list = $this->getByID($id);
            $table_name = "subscription_".$list->client_id."_".$list->list_id;
            $status = SubscriptionTable::createSubscriptionTable($this->sm, $table_name);
            if ( true == $status ){
                //in case subscription table is created update name of subscription
                //table in subscriptionListTable
                $this->tableGateway->update(array('list_table_name' => $table_name),
                        array('list_id' => $id));
                return $id;
                
            }else {
                //in case creation of subscription table fails this should
                //rollback list creation and return false
                $this->tableGateway->delete(array('list_id' => $id ));
                return false;
            } 
        }  catch (\Zend\Db\Adapter\Exception $e){
            return false;
        }
    }
    
    /*
     * update and return the updated subscriberlist
     */
    public function update(SubscriberList $list){
        if ( !isset($list) ) return null;
        $data = array(
            "list_name" => $list->list_name,
            "description" => $list->description, 
            "enabled" => $list->enabled, 
            "updated_at" => date('Y-m-d H:i:s'), 
        );
        
        try {
            $this->tableGateway->update($data, array('list_id' => $list->list_id));
            $list = $this->getByID($list->list_id);
            return $list;
        }  catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e){
            return NULL;
        }
    }

    /*
     * this table fetch all rows of client subscriber list and return in the form of
     * key value pair of list_name and list_id in respective order.
     */
    public function fetchAllforClientAsArray($client_id){
        $rows = $this->tableGateway->select(array('client_id' => $client_id));
        $list = array();
        foreach ( $rows as $row ) $list[$row->list_id] = $row->list_name;
        return $list;
    }
    
    
    public function fetchAllforUserID($user_id){
        //fetch all the un-deleted users
        return $this->tableGateway->select(array( 'archived_at' => null ));
    }
    
    public function getByID($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('list_id' => $id));
        $row = $rowset->current();
        return $row;
    }
    
    public function fetchAllByClientID($client_id){
        $rowset = $this->tableGateway->select(array('client_id' => $client_id));
        return $rowset;
    }
      
    public function delete($list_id){
        $id = (int)$id;
        $rowset = $this->tableGateway->update(array('archive_number' => 1,
            'archived_at' => date('Y-m-d H:i:s'),), array('list_id' => $list_id,
                ));
    }
    
    public function getDbAdapterForPagination($client_id, $search_string = null){
        if ( null != $search_string ){
            $search_clause = "list_name like '%".$search_string."%' OR "
                    . "description like '%".$search_string."%'";
//            \Zend\Debug\Debug::dump($search_clause);
        }
        
        if ( isset($search_clause) ){
            $select = $this->tableGateway->getSql()
                ->select()
                ->join('sms_package', 
                        'subscribers_list.package_id = sms_package.package_id', 
                        array('package_name', 'sms_quota'))
                ->where(array('client_id' => $client_id, $search_clause))
                ->order('created_at DESC');
        } else {
            $select = $this->tableGateway->getSql()
                ->select()
                ->join('sms_package', 
                        'subscribers_list.package_id = sms_package.package_id', 
                        array('package_name', 'sms_quota'))
                ->where(array('client_id' => $client_id))
                ->order('created_at DESC');
        }
        
        $dbSelect = new \Zend\Paginator\Adapter\DbSelect(
                $select, 
                $this->tableGateway->getAdapter(), 
                $this->tableGateway->getResultSetPrototype());
        
            

        
        return $dbSelect;        
    }
    
    public function getSubscriptionListwithPlanforClient($client_id){
        $select = $this->tableGateway->getSql()
                ->select()
                ->join('sms_package', 
                        'subscribers_list.package_id = sms_package.package_id', 
                        array('package_name', 'sms_quota'))
                ->where(array('client_id' => $client_id));
        $result = $this->tableGateway->selectWith($select);
        return $result;
        
        
    }
}



