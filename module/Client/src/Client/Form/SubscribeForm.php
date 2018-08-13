<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Client\Form;

use Zend\Form\Form;


class SubscribeForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Subscription');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'hidden' => 'hidden',
            ),
        ));
        
        $this->add(array(
            'name' => 'first_name',
            'required' => 'required',
            'attributes' => array(
//                'required' => 'required'                 
            ),
            'options' => array(
                'label' => 'First Name',
            ),
            
        ));
        
        $this->add(array(
            'name' => 'last_name',
            'attributes' => array(
//                'required' => 'required',    
            ),
            'options' => array(
                'label' => 'Second Name',
            ),
            
        ));
        
        $this->add(array(
            'name' => 'cell',
            'attributes' => array(
                'required' => 'required',    
            ),
            'options' => array(
                'label' => 'Cell Number',
            ),
            
        ));
        
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
//                'required'  => 'required',
                'type' => 'email',
            ),
            'options' => array(
                'label' => 'Email Address',
            ),
        ));
        
        $this->add(array(
            'name' => 'street_address',
            'attributes' => array(
//                'required'  => 'required',
                
            ),
            'options' => array(
                'label' => 'Street Address',
            ),
        )); 
        
	$this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Subscribe',
                'class' => 'btn',
            ),
        )); 
    }
}
