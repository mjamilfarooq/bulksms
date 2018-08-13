<?php
namespace Common\Model;


use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbTableGateway;
use Zend\Db\Sql\Sql;


class SubscriptionTable{
    protected $tableGateway;
    
    //this create statement is mysql specific and will replicate the definition
    //of subscriber_template for given table name
    protected static $subscription_table_create_statement = "CREATE TABLE %s LIKE `subscriber_template`";

    /*
     * should create tableGateway for table with name $table_name
     * with the help of service manager given by $sm. sm should help
     * populating database adapter 
     */
    public function __construct($sm, $table_name){
        $dbAdapter = $sm->get("Zend\Db\Adapter\Adapter");
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new Subscription());
        $this->tableGateway = new TableGateway($table_name, $dbAdapter, null, $resultSetPrototype);
    }
    

    /*
     * This function takes service manager and table name and create subscription
     * table with given name for each subscriberList to keep each subscriberList
     * in seperate table
     */
    public static function createSubscriptionTable($sm, $table_name){
        $adapter = $sm->get('Zend\Db\Adapter\Adapter');
        $sql = new Sql($adapter);
        $statement = sprintf(self::$subscription_table_create_statement, $table_name);
        
        try {
            $adapter->query($statement, 
                    $adapter::QUERY_MODE_EXECUTE);
            return true;
        }  catch (Zend\Db\Adapter\Exception $e){
            return false;
        }
    }
 
    /*
     * create new Subscription Record in SubscriptionTable and return the id
     * of newly subscribed subscriber.
     */
    public function subscribe(Subscription $subscription){
        if ( !isset($subscription) ) return null;
        if ( $subscription->cell == '' ) return null;
        $data = array(
//            "id" => $subscription->id,
            "first_name" => $subscription->first_name,
            "last_name" => $subscription->last_name,
            "cell" => $subscription->cell,
            "email" => $subscription->email,
            "street_address" => $subscription->street_address,
            "subscribe_at" => date('Y-m-d H:i:s'),
//            "unsubscribe_at" => $subscription->unsubscribe_at,
            "status" => 1,
        );
        
        try {
            $this->tableGateway->insert($data);
            $id = $this->tableGateway->getLastInsertValue();
            return $id;
        }  catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e){
            return NULL;
        }
    }
    
    /*
     * update and return the updated Subscriber Info
     */
    public function update(Subscription $subscription){
        if ( !isset($subscription) ) return null;
        $data = array(
            "first_name" => $subscription->first_name,
            "last_name" => $subscription->last_name,
            "cell" => $subscription->cell,
            "email" => $subscription->email,
            "street_address" => $subscription->street_address,
//            "subscribe_at" => date('Y-m-d H:i:s'),
//            "unsubscribe_at" => $subscription->unsubscribe_at,
            "status" => 1,
        );
        
        try {
            $this->tableGateway->update($data, array('id' => $subscription->id));
            $subscription = $this->getByID($subscription->id);
            return $subscription;
        }  catch (\Zend\Db\Adapter\Exception\InvalidQueryException $e){
            return NULL;
        }
    }

    
    public function getByID($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        return $rowset->current();
    }
    
    /*
     * unsubscribe subscription
     */  
    public function unsubscribe($id){
        $id = (int)$id;
        $rowset = $this->tableGateway->update(array('status' => 0,
            'unsubscribe_at' => date('Y-m-d H:i:s'),), array('id' => $id,
                ));
    }
    
    
    public function getTableGateway(){
        return $this->tableGateway;
    }
    
    public function getDbAdapterforPagination($search_string){
        
        
        if ( null != $search_string ){
            $search_clause = "first_name like '%".$search_string."%' OR "
                    . "last_name like '%".$search_string."%' OR "
                    . "cell like '%".$search_string."%' OR "
                    . "email like '%".$search_string."%' OR "
                    . "street_address like '%".$search_string."%'";
//            \Zend\Debug\Debug::dump($search_clause);
        }
        
        if ( isset($search_clause) )
            $paginator = new DbTableGateway($this->tableGateway,
                    array('status' => 1,
                        $search_clause,
                    ),
                    array('subscribe_at DESC'));
        else
            $paginator = new DbTableGateway($this->tableGateway,
                array('status' => 1 ),
                array('subscribe_at DESC'));
            

        
        return $paginator;        
    }
    
    public function fetchAll(){
        $select = $this->tableGateway->select(array('status' => 1));
        return $select;
        
    }
    
    public function count(){
        return $this->tableGateway->select(array('status' => 1))->count();
    }
}