<?php

namespace Client\Form;

use Zend\Form\Form;

class CampaignForm extends Form
{
    public function __construct($name = null, $list)
    {
        parent::__construct('Campaign');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');
                
        $this->add(array(
            'name' => 'campaign_id',
            'attributes' => array(
        	'hidden' => 'hidden', 
            ),
        )); 
        
	$this->add(array(
            'name' => 'campaign_name',
            'attributes' => array(
                'required' => 'required'                 
            ),
            'options' => array(
                'label' => 'Campaign Name',
            ),
        )); 
        
        $this->add(array(
            'name' => 'message',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'required' => 'required',
                'rows' => 9,
                'cols' => 5,
                'maxlength' => 160,
                'placeholder' => 'Type message upto 160 characters'
            ),
            'options' => array(
                'label' => 'Message',
            ),
        ));        
        
        $this->add(array(
            'name' => 'start_time',
            'attributes' => array(
                'required' => 'required'                 
            ),
            'options' => array(
                'label' => 'Start Date/Time',
            ),
        ));
        
        $this->add(array(
            'name' => 'end_time',
            'attributes' => array(
                'required' => 'required'                 
            ),
            'options' => array(
                'label' => 'End Date/Time',
            ),
        ));        
                
        $this->add(array(
            'name' => 'source_address',
            'attributes' => array(
                'required' => 'required'                 
            ),
            'options' => array(
                'label' => 'Source Address',
            ),
        ));                        
        
        $this->add(array(
            'name' => 'encoding',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'options' => array(
                    'UTF-8' => 'UTF-8',
                    'ASCII' => 'ASCII',
                ),
            ),
            'options' => array(
                'label' => 'Encoding',
            ),
        ));    
        
        $this->add(array(
            'name' => 'delivery_receipt_flag',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'checked_value' => "1",
                'unchecked_value' => "0",
                'label' => 'Delivery Report',
            ),
            'attributes' => array(
                'value' => "0",
                
            ),
        ));
           
        
        $this->add(array(
            'name' => 'active',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'checked_value' => "1",
                'unchecked_value' => "0",
                'label' => 'Active',
            ),
            'attributes' => array(
                'value' => "0",
                
            ),
        ));

        /*
         * population of subscriberlist for client while creating campaign
         * will be done at construction through service manager there is no 
         * need now to explicitly populating with addSubscriberListFromDatabase
         * hence deleting addSubscriberListFromDatabase function
         */
        $subscriber_list_id = new \Zend\Form\Element\Select('subscriber_list_id',
                ['label' => 'Subscriber List',
                    'value_options' => $list,]);
        $this->add($subscriber_list_id);
        
               
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Create',
                'class' => 'btn',
            ),
        )); 
    }
    
}
