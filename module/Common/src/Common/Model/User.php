<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Common\Model;


class User{
    public $id;
    public $email;
    public $encrypted_password;
    public $reset_password_token;
    public $reset_password_sent_at;
    public $signup_token;
    public $signup_token_sent_at;
    public $remeber_created_at;
    public $sign_in_count;
    public $current_sign_in_at;
    public $last_sign_in_at;
    public $current_sign_in_ip;
    public $last_sign_in_ip;
    public $created_at;
    public $updated_at;
    public $role;
    public $first_name; 
    public $last_name; 
    public $country_region; 
    public $company; 
    public $date_of_birth; 
    public $country_code; 
    public $mobile_number; 
    public $archive_number; 
    public $archived_at;
    
    public function exchangeArray(array $data){
        $this->id = isset($data["id"])?$data["id"]:null;
        $this->email = isset($data["email"])?$data["email"]:null;
        $this->encrypted_password = isset($data["encrypted_password"])?$data["encrypted_password"]:null;
        $this->reset_password_token = isset($data["reset_password_token"])?$data["reset_password_token"]:null;
        $this->reset_password_sent_at = isset($data["reset_password_sent_at"])?$data["reset_password_sent_at"]:null;
        $this->signup_token = isset($data["signup_token"])?$data["signup_token"]:null;
        $this->signup_token_sent_at = isset($data["signup_token_sent_at"])?$data["signup_token_sent_at"]:null;
        $this->remeber_created_at = isset($data["remeber_created_at"])?$data["remeber_created_at"]:null;
        $this->sign_in_count = isset($data["sign_in_count"])?$data["sign_in_count"]:null;
        $this->current_sign_in_at = isset($data["current_sign_in_at"])?$data["current_sign_in_at"]:null;
        $this->last_sign_in_at = isset($data["last_sign_in_at"])?$data["last_sign_in_at"]:null;
        $this->current_sign_in_ip = isset($data["current_sign_in_ip"])?$data["current_sign_in_ip"]:null;
        $this->last_sign_in_ip = isset($data["last_sign_in_ip"])?$data["last_sign_in_ip"]:null;
        $this->created_at = isset($data["created_at"])?$data["created_at"]:null;
        $this->updated_at = isset($data["updated_at"])?$data["updated_at"]:null;
        $this->role = isset($data["role"])?$data["role"]:null;
        $this->first_name = isset($data["first_name"])?$data["first_name"]:null; 
        $this->last_name = isset($data["last_name"])?$data["last_name"]:null; 
        $this->country_region = isset($data["country_region"])?$data["country_region"]:null; 
        $this->company = isset($data["company"])?$data["company"]:null; 
        $this->date_of_birth = isset($data["date_of_birth"])?$data["date_of_birth"]:null; 
        $this->country_code = isset($data["country_code"])?$data["country_code"]:null; 
        $this->mobile_number = isset($data["mobile_number"])?$data["mobile_number"]:null; 
        $this->archive_number = isset($data["archive_number"])?$data["archive_number"]:null; 
        $this->archived_at = isset($data["archived_at"])?$data["archived_at"]:null;

    }
    
    public function getArrayCopy(){
        return get_object_vars($this);
    }
}