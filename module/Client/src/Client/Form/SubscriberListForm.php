<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Client\Form;

use Zend\Form\Form;


class SubscriberListForm extends Form
{
    public function __construct($name = null, $list)
    {
        parent::__construct('SubscriberListForm');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');

        $this->add(array(
            'name' => 'list_id',
            'attributes' => array(
                'hidden' => 'hidden',
            ),
        ));
        
        $this->add(array(
            'name' => 'client_id',
            'attributes' => array(
                'hidden' => 'hidden',
            ),
        ));
        
        
        $this->add(array(
            'name' => 'list_name',
            'required' => 'required',
            'attributes' => array(
                'required' => 'required',                 
            ),
            'options' => array(
                'label' => 'List Name',
            ),
            
        ));
        
        //adding form will not be useful in case assigning list on construction
        //as string creation of adding form element is using Zend Service Manager
        //which is not available at form.
        $package_id = new \Zend\Form\Element\Select('package_id', [
            'label' => 'Available Packages',
            'value_options' => $list,
        ]);
        $this->add($package_id);
        
        
        $this->add(array(
            'name' => 'enabled',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'use_hidden_element' => true,
                'checked_value' => "1",
                'unchecked_value' => "0",
                'label' => 'Enabled',
            ),
            'attributes' => array(
                'value' => "0",
                
            ),
        ));
        
        
        $this->add(array(
            'name' => 'description',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
//                'required' => 'required',
                'rows' => 9,
                'cols' => 5,
                'maxlength' => 160,
//                'placeholder' => 'Type message upto 160 characters'
            ),
            'options' => array(
                'label' => 'Description',
            ),
            
        ));
        
        
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
