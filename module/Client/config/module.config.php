<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Client\Controller\Signin' => 'Client\Controller\SigninController',
            'Client\Controller\Signup' => 'Client\Controller\SignupController',
            'Client\Controller\Home' => 'Client\Controller\HomeController',
            'Client\Controller\Campaign' => 'Client\Controller\CampaignController',
            'Client\Controller\Subscription' => 'Client\Controller\SubscriptionController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'client' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/client',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Client\Controller',
                        'controller'    => 'Signin',
                        'action'        => 'index',
                    ),
                    
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:token]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'signin' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[?token=:signin_token]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'signup' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[?token=:signup_token]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'campaign' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id[/:page]]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'    => '[1-9][0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'subscription' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id[/:page[/:user_id]]]]][?search=:search_string][?package=:package_id]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'    => '[1-9][0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
                
            ),
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'client/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            'client' => __DIR__ . '/../view',
        ),
    ),
    'module_config' => array(
        'upload_location' => __DIR__ . '/../data/tmp',
    ),
      
);
