<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Common\Model;
/*
 * Subscription model object of Subscription record, that will be 
 * information of subscriber to any subscription list and will be 
 * uploaded from file or can be manually subscribe for each subscriberList
 */

class Subscription{
    public $id; 
    public $first_name; 
    public $last_name; 
    public $cell; 
    public $email; 
    public $street_address; 
    public $subscribe_at; 
    public $unsubscribe_at; 
    public $status;
    
    public function exchangeArray(array $data){
        $this->id = isset($data["id"])?$data["id"]:null;
        $this->first_name = isset($data["first_name"])?$data["first_name"]:null;
        $this->last_name = isset($data["last_name"])?$data["last_name"]:null;
        $this->cell = isset($data["cell"])?$data["cell"]:null;
        $this->email = isset($data["email"])?$data["email"]:null;
        $this->street_address = isset($data["street_address"])?$data["street_address"]:null;
        $this->subscribe_at = isset($data["subscribe_at"])?$data["subscribe_at"]:null;
        $this->unsubscribe_at = isset($data["unsubscribe_at"])?$data["unsubscribe_at"]:null;
        $this->status = isset($data["status"])?$data["status"]:null;
    }
    
    /*
     * to recognize valid CSV text file for subscriber contacts a header is needed
     * format of header is 
     * first name, last name, cell, email, street address
     */
    public function hasValidCSVHeader($csv_string){
        
        $temp = array();
        $temp = explode(",",  rtrim($csv_string), 5);
        
        if ( strcasecmp(trim($temp[0]), "first name") == 0 &&
             strcasecmp(trim($temp[1]), "last name") == 0 &&
             strcasecmp(trim($temp[2]), "cell") == 0 &&
             strcasecmp(trim($temp[3]), "email") == 0 &&
             strcasecmp(trim($temp[4]), "street address") == 0 ){
        
            return true;
        }else return false;
    }
    
    
    
    public function exchangeCSV($csv_string){
        $temp = array();
        $temp = explode(",",  trim($csv_string), 5);
        
        if ( isset($temp[2]) && trim($temp[2]) != '' ){
            $this->first_name = trim($temp[0]);
            $this->last_name = trim($temp[1]);
            //cell number should only be number charachters
            $this->cell = trim(preg_replace("/[^0-9]+/", "", $temp[2]));
            $this->email = trim($temp[3]);
            $this->street_address = trim($temp[4]);
        }
    }
    
    public function getCSVCopy(){
        return rtrim($this->first_name).', '.rtrim($this->last_name).', '.rtrim($this->cell).', '.
                rtrim($this->email).', '.rtrim($this->street_address);
    }
    
    
    public function getArrayCopy(){
        return get_object_vars($this);
    }
}