<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Client\Form;

use Zend\Form\Form;

class PasswordForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Password');
//        $this->setAttribute('method', 'post');
//        $this->setAttribute('enctype','multipart/form-data');
//        
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'attributes' => array(
                'required' => 'required'                 
            ),
            'options' => array(
                'label' => 'Password',
            ),
            
        ));
        
        
        
        $this->add(array(
            'name' => 'confirm_password',
            'type' => 'password',
            'attributes' => array(
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Confirm Password',
                
            ),
//            'validators' => array(
//                array(
//                    'name' => 'Zend\Validator\Identical',
//                    'options' => array(
//                        'token' => 'password',
//                    ),
//                ),
//            ),
            
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Continue',
                'class' => 'btn',
            ),
        )); 
    }
}
