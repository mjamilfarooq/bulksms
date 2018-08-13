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

class SMSPackageTable{
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll(){
        $row_set = $this->tableGateway->select(array('enabled' => 1));
        return $row_set;
    }
        
    /*
     * this table fetch all sms packages/plans as 
     * key value pair for filling in html Select element
     */
    public function fetchAllAsArray(){
        $rows = $this->tableGateway->select(array('archived_at' => null));
        $list = array();
        foreach ( $rows as $row ) $list[$row->package_id] = $row->package_name;
        return $list;
    }
    
    public function getByID($package_id){
        return $this->tableGateway->select(array('package_id' => $package_id))->current();
    }
   
}



