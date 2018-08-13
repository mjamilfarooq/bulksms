<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Common\Model;

class SubscriberList{
    public $list_id; 
    public $client_id;
    public $package_id;
    public $list_name;
    public $list_table_name;
    public $description; 
    public $enabled; 
    public $sent_sms; 
    public $expiry_date; 
    public $created_at; 
    public $updated_at; 
    public $archive_number; 
    public $archived_at;
    
    
    //below fields are added for convieniance in joining with sms_package table
    public $package_name;
    public $sms_quota;
    
    
    public function exchangeArray(array $data){
        $this->list_id = isset($data["list_id"])?$data["list_id"]:null;
        $this->client_id = isset($data["client_id"])?$data["client_id"]:null;
        $this->package_id = isset($data["package_id"])?$data["package_id"]:null;
        $this->list_name = isset($data["list_name"])?$data["list_name"]:null;
        $this->list_table_name = isset($data["list_table_name"])?$data["list_table_name"]:null;
        $this->description = isset($data["description"])?$data["description"]:null;
        $this->enabled = isset($data["enabled"])?$data["enabled"]:null;
        
        //auto set
        $this->sent_sms = isset($data["sent_sms"])?$data["sent_sms"]:null;
        $this->expiry_date = isset($data["expiry_date"])?$data["expiry_date"]:null;
        $this->created_at = isset($data["created_at"])?$data["created_at"]:null;
        $this->updated_at = isset($data["updated_at"])?$data["updated_at"]:null;
        $this->archive_number = isset($data["archive_number"])?$data["archive_number"]:null; 
        $this->archived_at = isset($data["archived_at"])?$data["archived_at"]:null;
        
        //for joining
        $this->package_name = isset($data["package_name"])?$data["package_name"]:null;
        $this->sms_quota = isset($data["sms_quota"])?$data["sms_quota"]:null;
    }
    
    public function getArrayCopy(){
        return get_object_vars($this);
    }
}