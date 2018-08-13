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

class UserTable{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    protected function generateFirstPassword(){
        //TODO: must implement function to create a first use random password
        //password must be reset at first login.
        return "1234";
    }
    
    protected function generateResetPasswordToken(){
        return substr(str_shuffle(sha1(microtime())), 0, 128); 
    }
    
    
    //this function should generate random string
    protected function generateSignupToken(){
        return substr(str_shuffle(sha1(microtime())), 0, 128); 
    }
    
    //this will generate a reset hash that will be sent to user through registered
    //email address.
    public function setupResetPasswordHash(User $user){
        if ( !isset($user) ) return null;
        $data = array (
            "reset_password_token" => $this->generateResetPasswordToken(),
            "reset_password_sent_at" => date('Y-m-d H:i:s'),
        );
        try{
            $this->tableGateway->update($data, array('id' => $user->id));
            $user = $this->getUserByID($user->id);
            return $user;            
        }  catch (Zend\Db\Adapter\Exception\InvalidQueryException $e){
            return null;
        }
    }
    
    
    public function createNewUser(User $user){
        $signupToken = $this->generateSignupToken();
        if ( !isset($user) ) return null;
        $data = array(
            //"id" => $user->id,
            "email" => $user->email,
//            "encrypted_password" => $this->generateFirstPassword(),//$user->encrypted_password,
//            "reset_password_token" => $this->generateResetPasswordToken(),
//            "reset_password_sent_at" => date('Y-m-d H:i:s'),//$user->reset_password_sent_at,
            "signup_token" => $signupToken,
            "signup_token_sent_at" => date('Y-m-d H:i:s'),//$user->signup_token_sent_at,
//            "remeber_created_at" => $user->remeber_created_at,
//            "sign_in_count" => $user->sign_in_count,
//            "current_sign_in_at" => $user->current_sign_in_at,
//            "last_sign_in_at" => $user->last_sign_in_at,
//            "current_sign_in_ip" => $user->current_sign_in_ip,
//            "last_sign_in_ip" => $user->last_sign_in_ip,
            "created_at" => date('Y-m-d H:i:s'),//$user->created_at,
            "updated_at" => date('Y-m-d H:i:s'),//$user->updated_at,
            "role" => "client",//$user->role,
            "first_name" => $user->first_name, 
            "last_name" => $user->last_name, 
            "country_region" => $user->country_region, 
            "company" => $user->company, 
            "date_of_birth" => $user->date_of_birth, 
            "country_code" => $user->country_code, 
            "mobile_number" => $user->mobile_number, 
//            "archive_number" => $user->archive_number, 
//            "archived_at" => $user->archived_at,
        );

        try {
            $this->tableGateway->insert($data);
            $id = $this->tableGateway->getLastInsertValue();
            return $this->getUserByID($id);
        }  catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e){
            var_dump($e->getMessage());
            throw $e;
            return NULL;
        } catch (\Zend\Db\Adapter\Exception $e) {
            var_dump($e);
            return NULL;
        }
    }
    
    public function updateUserInfo(User $user){
        
    }
    
    
   public function saveUser(User $user){
        $data = array(
            'email' => $user->email,
            'encrypted_password' => $user->encrypted_password,
            'reset_password_token' => $user->reset_password_token, 
            'reset_password_sent_at' => $user->reset_password_sent_at, 
            'remember_created_at' => $user->remeber_created_at, 
            'sign_in_count' => $user->sign_in_count, 
            'current_sign_in_at' => $user->current_sign_in_at, 
            'last_sign_in_at' => $user->last_sign_in_at, 
            'current_sign_in_ip' => $user->current_sign_in_ip, 
            'last_sign_in_ip' => $user->last_sign_in_ip, 
            'created_at' => $user->created_at, 
            'updated_at' => $user->updated_at, 
            'role' => $user->role, 
            'client_id' => $user->client_id, 
            'api_key' => $user->api_key, 
            'archive_number' => $user->archive_number, 
            'archived_at' => $user->archived_at,
             
        );
        $id = (int)$user->id;
        if ($id == 0) {
            try{
                $this->tableGateway->insert($data);
            }  catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e){
                return 0;
            }
        }else {
            if ($this->getUserByID($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('User ID does not exist');
            }
        }
    }

    public function fetchAll(){
        //fetch all the un-deleted users
        return $this->tableGateway->select(array( 'archived_at' => null ));
    }
    
    public function getUserByID($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        return $rowset->current();
    }
    
    public function getUserBySignupToken($signup_token){
        $rowset = $this->tableGateway->select(array('signup_token' => $signup_token));
        return $rowset->current();
    }
    
    public function getUserByResetPasswordToken($reset_password_token){
        $rowset = $this->tableGateway->select(array('reset_password_token' => $reset_password_token));
        return $rowset->current();
    }
    
    //this function is also reseting signup_token and reset_password_token to null to prevent user to use 
    //this token in future
    public function setUserEncryptedPassword($user, $password){
//        \Zend\Debug\Debug::dump($user);
        $this->tableGateway->update(array('encrypted_password' => sha1($password), 'signup_token' => null, 'reset_password_token' => null), array('id' => $user->id));
    }
    
    public function getUserByEmail($email){
        $rowset = $this->tableGateway->select(array('email' => $email));
        $row = $rowset->current();
        return $row;
    }
    
    public function deleteUser($id){
        $id = (int)$id;
        $rowset = $this->tableGateway->update(
                array(  //set
                    'archive_number' => 1,
                    'archived_at' => date('Y-m-d H:i:s'),
                ), 
                array(
                    'id' => $id, 
                ));
    }
    
    public function deleteUserByEmail($email){
        $rowset = $this->tableGateway->update(
                array(  //set
                    'archive_number' => 1,
                    'archived_at' => date('Y-m-d H:i:s'),
                ), 
                array(
                    'email' => $email, 
                )
            );
    }
    
   
}



