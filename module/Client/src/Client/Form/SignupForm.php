<?php
// filename : module/Users/src/Users/Form/RegisterForm.php
namespace Client\Form;

use Zend\Form\Form;
use Zend\Validator\EmailAddress;

class SignupForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Signup');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');
        
        $this->add(array(
            'name' => 'first_name',
            'attributes' => array(
                'required' => 'required'                 
            ),
            'options' => array(
                'label' => 'First Name',
            ),
            
        ));
        
        $this->add(array(
            'name' => 'last_name',
            'attributes' => array(
                'required' => 'required',    
            ),
            'options' => array(
                'label' => 'Second Name',
            ),
            
        ));
        
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'required'  => 'required',
                'type' => 'email',
            ),
            'options' => array(
                'label' => 'Email Address',
            ),
        )); 

        //formation of countries array 
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        $cl = [];
        foreach ($countries as $country){
            $cl[$country] = $country;
            
        }
            
        //creation of country_region form element and assigning of countries_list
	$this->add(array(
            'name' => 'country_region',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'required' => 'required',
                'options' => $cl,
            ),
            'options' => array(
                'label' => 'Country/Region',
                
            ),
            
        ));
        
        $this->add(array(
            'name' => 'company',
            'options' => array(
                'label' => 'Company',
            ),
            'attributes' => array(
                'required' => 'required',
            ),
            
        ));
        
        $this->add(array(
            'name' => 'date_of_birth',
            'attributes' => array(
                'required' => 'required',
                'placeholder' => 'MM-DD-YYYY',
            ),
            'options' => array(
                'label' => 'Birth Date',
                
            ),
            
        ));

        
        $this->add(array(
            'name' => 'gender',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'options' => array(
                    'Male' => 'Male',
                    'Female' => 'Female',
                ),
            ),
            'options' => array(
                'label' => 'Gender',
            ),
        ));    
        
        $this->add(array(
            'name' => 'country_code',
            'attribtues' => array(
                'type' => 'Zend\Form\Element\Select',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Country Code',
            ),
            
        ));
        
        
        $this->add(array(
            'name' => 'mobile_number',
            'attributes' => array(
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Mobile Number',
            ),
            
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Sign Up',
                'class' => 'btn',
            ),
        )); 
    }
}
