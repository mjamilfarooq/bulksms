<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Client\Form;

use Zend\Form\Form;

class SigninForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Signin');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');
                
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
		'required' => 'required' 
            ),
            'options' => array(
                'label' => 'Email:',
            ),
            
        )); 
        
	$this->add(array(
            'name' => 'password',
            'type' => 'password',
            'attributes' => array(
                'required' => 'required'                 
            ),
            'options' => array(
                'label' => 'Password:',
            ),
           
        )); 
        
        $this->add(array(
            'name' => 'remember_me',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'checked_value' => 1,
                'unchecked_value' => 0,
                'label' => 'Keep me logged in',
            ),
            'attributes' => array(
                'value' => 0,
                
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Login',
                'class' => 'btn',
            ),
        )); 
    }
}
