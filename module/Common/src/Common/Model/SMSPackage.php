<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Common\Model;

class SMSPackage{
    public $package_id; 
    public $package_name; 
    public $description; 
    public $enabled; 
    public $sms_quota;
    public $sms_per_second;
    public $validity;
    public $number_of_subscribers;
    public $is_registered_delivery;
    public $encoding_type;
    public $price;
    public $created_at;
    public $updated_at;
    public $archive_number;
    public $archived_at;
    
    public function exchangeArray(array $data){
        $this->package_id = isset($data["package_id"])?$data["package_id"]:null;
        $this->package_name = isset($data["package_name"])?$data["package_name"]:null;
        $this->description = isset($data["description"])?$data["description"]:null;
        $this->enabled = isset($data["enabled"])?$data["enabled"]:null;
        $this->sms_quota = isset($data["sms_quota"])?$data["sms_quota"]:null;
        $this->sms_per_second = isset($data["sms_per_second"])?$data["sms_per_second"]:null;
        $this->validity = isset($data["validity"])?$data["validity"]:null;
        $this->number_of_subscribers = isset($data["number_of_subscribers"])?$data["number_of_subscribers"]:null;
        $this->is_registered_delivery = isset($data["is_registered_delivery"])?$data["is_registered_delivery"]:null;
        $this->encoding_type = isset($data["encoding_type"])?$data["encoding_type"]:null;
        $this->price = isset($data["price"])?$data["price"]:null;
        $this->created_at = isset($data["created_at"])?$data["created_at"]:null;
        $this->updated_at = isset($data["updated_at"])?$data["updated_at"]:null;
        $this->archive_number = isset($data["archive_number"])?$data["archive_number"]:null;
        $this->archived_at = isset($data["archived_at"])?$data["archived_at"]:null;
       
    }
    
    public function getArrayCopy(){
        return get_object_vars($this);
    }
}