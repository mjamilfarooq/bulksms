<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Common\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class CampaignTable{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    /*
     * create new campaign and return the id of newly created campaign.
     */
    public function create(Campaign $campaign){
        if ( !isset($campaign) ) return null;
        $data = array(
//            "campaign_id" => $campaign->campaign_id, 
            "campaign_name" => $campaign->campaign_name, 
            "message" => $campaign->message, 
            "start_time" => $campaign->start_time, 
            "end_time" => $campaign->end_time, 
            "source_address" => $campaign->source_address, 
            "encoding" => $campaign->encoding, 
            "subscriber_list_id" => $campaign->subscriber_list_id, 
            "plan_id" => $campaign->plan_id, 
            "delivery_receipt_flag" => $campaign->delivery_receipt_flag, 
            "created_at" => date('Y-m-d H:i:s'), 
            "updated_at" => date('Y-m-d H:i:s'), 
//            "archive_number" => $campaign->archive_number, 
//            "archived_at" => $campaign->archived_at, 
            "active" => $campaign->active, 
            //below fields are campaign status
//            "row_count" => $campaign->row_current, 
//            "submit_response_received" => $campaign->submit_response_received, 
//            "delivery_receipt_received" => $campaign->delivery_receipt_received,
            
        );
        
        try {
            $this->tableGateway->insert($data);
            $id = $this->tableGateway->getLastInsertValue();
            return $id;
        }  catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e){
            
            \Zend\Debug\Debug::dump($data);
            return NULL;
        }
    }
    
    /*
     * update and return the updated campaign 
     */
    public function update(Campaign $campaign){
        if ( !isset($campaign) ) return null;
        $data = array(
//            "campaign_id" => $campaign->campaign_id, 
            "campaign_name" => $campaign->campaign_name, 
            "message" => $campaign->message, 
            "start_time" => $campaign->start_time, 
            "end_time" => $campaign->end_time, 
            "source_address" => $campaign->source_address, 
            "encoding" => $campaign->encoding, 
            "subscriber_list_id" => $campaign->subscriber_list_id, 
            "plan_id" => $campaign->plan_id, 
            "delivery_receipt_flag" => $campaign->delivery_receipt_flag, 
//            "created_at" => date('Y-m-d H:i:s'), 
            "updated_at" => date('Y-m-d H:i:s'), 
//            "archive_number" => $campaign->archive_number, 
//            "archived_at" => $campaign->archived_at, 
            "active" => $campaign->active, 
//            "row_count" => $campaign->row_current, 
//            "submit_response_received" => $campaign->submit_response_received, 
//            "delivery_receipt_received" => $campaign->delivery_receipt_received,
            
        );
        
        try {
            //currently executing campaigns shouldn't be updated
            $rows = $this->tableGateway->update($data, 
                    array('campaign_id' => $campaign->campaign_id, 
                        'NOW() not between start_time  and end_time AND NOW() < end_time '));
            if ( $rows == 0 ) return 0;
            else return $this->getByID($campaign->campaign_id);
        }  catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e){
            return NULL;
        }
    }

    public function pause(Campaign $campaign){
        if ( !isset($campaign) ) return null;
        $data = array(
            "active" => 0, 
        );
        
        try {
            $this->tableGateway->update($data, array('campaign_id' => $campaign->campaign_id));
            return $this->getByID($campaign->campaign_id);
        }  catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e){
            return NULL;
        }
    }
    
    public function play(Campaign $campaign){
        if ( !isset($campaign) ) return null;
        $data = array(
            "active" => 1, 
        );
        
        try {
            $this->tableGateway->update($data, array('campaign_id' => $campaign->campaign_id));
            return $this->getByID($campaign->campaign_id);
        }  catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e){
            return NULL;
        }
    }
    
    public function getDbAdapterForPagination($client_id, $search_string = null){
        if ( null != $search_string ){
            $search_clause = "campaign_name like '%".$search_string."%' OR "
                    . "message like '%".$search_string."%'";
//            \Zend\Debug\Debug::dump($search_clause);
        }
        
        if ( isset($search_clause) ){
            $select = $this->tableGateway->getSql()
                ->select()
                ->join('subscribers_list', 
                        'subscribers_list.list_id = campaign.subscriber_list_id', array('client_id'))
                ->where(array('campaign.archived_at' => null, 
                    'subscribers_list.client_id' => $client_id, 
                    $search_clause))
                ->order('created_at DESC');
        } else {
            $select = $this->tableGateway->getSql()
                ->select()
                ->join('subscribers_list', 
                        'subscribers_list.list_id = campaign.subscriber_list_id', array('client_id'))
                ->where(array('campaign.archived_at' => null, 
                    'subscribers_list.client_id' => $client_id))
                ->order('created_at DESC');
        }
        
        $dbSelect = new \Zend\Paginator\Adapter\DbSelect(
                $select, 
                $this->tableGateway->getAdapter(), 
                $this->tableGateway->getResultSetPrototype());
       
        return $dbSelect;        
    }
    
    public function fetchAllforUserID($user_id){
        //fetch all the un-deleted users
        $select = $this->tableGateway->getSql()
                ->select()
                ->join('subscribers_list', 
                        'subscribers_list.list_id = campaign.subscriber_list_id', 
                        array('client_id'))
                ->where(array('campaign.archived_at' => null, 
                    'subscribers_list.client_id' => $user_id));
        return $this->tableGateway->selectWith($select);
    }
    
    public function getByID($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('campaign_id' => $id));
        return $rowset->current();
    }
    
      
    public function delete($campaign_id){
        $id = (int)$id;
        $rowset = $this->tableGateway->update(
                array(  //set
                    'archive_number' => 1,
                    'archived_at' => date('Y-m-d H:i:s'),
                ), 
                array(
                    'campaign_id' => $campaign_id, 
                ));
        return $rowset;
    }
    
    
    public function isEditable($campaign_id){
        $rowset = $this->tableGateway->select(array(
            'archived_at' => null,
            'campaign_id' => $campaign_id,
            'NOW() not between start_time  and end_time AND NOW() < end_time'
        ));
        if ( $rowset->count() ) return true; else return false;
    }
   
}



