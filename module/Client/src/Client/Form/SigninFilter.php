<?php
namespace Client\Form;

use Zend\InputFilter\InputFilter;

class SigninFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name'       => 'email',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'EmailAddress',
                    'options' => array(
                        'domain' => true,
                    ),
                ),
            ),
        ));
        $this->add(array(
            'name'       => 'password',
            'required'   => true,
        ));
    }
}
