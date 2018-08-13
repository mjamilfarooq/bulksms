<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Common\Model;

class Campaign{
    public $campaign_id;
    public $campaign_name;
    public $message;
    public $start_time;
    public $end_time;
    public $source_address;
    public $encoding;
    public $subscriber_list_id;
    public $plan_id;
    public $delivery_receipt_flag;
    public $created_at;
    public $updated_at;
    public $archive_number; 
    public $archived_at;
    public $active; 
    public $row_current; 
    public $submit_response_received; 
    public $delivery_receipt_received;
    
    public function exchangeArray(array $data){
        $this->campaign_id = isset($data["campaign_id"])?$data["campaign_id"]:null;
        $this->campaign_name = isset($data["campaign_name"])?$data["campaign_name"]:null;
        $this->message = isset($data["message"])?$data["message"]:null;
        $this->start_time = isset($data["start_time"])?$data["start_time"]:null;
        $this->end_time = isset($data["end_time"])?$data["end_time"]:null;
        $this->source_address = isset($data["source_address"])?$data["source_address"]:null;
        $this->encoding = isset($data["encoding"])?$data["encoding"]:null;
        $this->subscriber_list_id = isset($data["subscriber_list_id"])?$data["subscriber_list_id"]:null;
        $this->plan_id = isset($data["plan_id"])?$data["plan_id"]:null;
        $this->delivery_receipt_flag = isset($data["delivery_receipt_flag"])?$data["delivery_receipt_flag"]:null;
        $this->created_at = isset($data["created_at"])?$data["created_at"]:null;
        $this->updated_at = isset($data["updated_at"])?$data["updated_at"]:null;
        $this->archive_number = isset($data["archive_number"])?$data["archive_number"]:null; 
        $this->archived_at = isset($data["archived_at"])?$data["archived_at"]:null;
        $this->active = isset($data["active"])?$data["active"]:null; 
        $this->row_current = isset($data["row_current"])?$data["row_current"]:null;
        $this->submit_response_received = isset($data["submit_response_received"])?$data["submit_response_received"]:null; 
        $this->delivery_receipt_received = isset($data["delivery_receipt_received"])?$data["delivery_receipt_received"]:null;
    }
    
    public function getArrayCopy(){
        return get_object_vars($this);
    }
}