<?php

namespace Client\Model;
 
use Zend\Authentication\Storage;
 
class ClientAuthStorage extends Storage\Session
{
    public function setRememberMe($rememberMe = 0, $time = 1209600)
    {
         if ($rememberMe == 1) {
            
            $manager = $this->session->getManager();
            $manager->rememberMe($time);
            
         }
    }
     
    public function forgetMe()
    {
        $this->session->getManager()->forgetMe();
    } 
}