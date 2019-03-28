Bulk SMS Portal
=======================

Introduction
------------

This is simple bulk sms portal made in Zend Framework2.

Installation
------------

- clone the repo in your /var/www/bulksms/ folder
- create database using db.sql in mysql.
- configure apache server as given below.

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

    <VirtualHost *:80>
        ServerName bulksms
        DocumentRoot /var/www/bulksms/
        SetEnv APPLICATION_ENV "development"
        <Directory /var/www/bulksms/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
    
  
  
  ### DockerFile
  
  To setup quickly dockerfile is added to repo which setups apache settings and initialize database. In client module one still needs to setup email/password information for the mailer function that sends emails to client for signup and forget password functionality.
