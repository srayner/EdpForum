<?php
return array(

    'zfcuser' => array(
        'enable_username' => true,
        'enable_display_name' => true
    ),
    
    'view_manager' => array('template_path_stack' => array(__DIR__ . '/../view')),
    'controllers' => array(
        'invokables' => array(
            'EdpForum\Controller\DiscussController' => 'EdpForum\Controller\DiscussController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'forum' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/forum',
                    'defaults' => array(
                        'controller' => 'EdpForum\Controller\DiscussController',
                        'action' => 'forums',
                    ),
                ),
            ),
            'edpforum' => array(
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/:tagslug{-}-:tagid',
                    'constraints' => array(
                        'tagslug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'tagid'   => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'EdpForum\Controller\DiscussController',
                        'action'     => 'threads',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'thread' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route'    => '/:threadslug{-}-:threadid/:action',
                            'constraints' => array(
                                'threadslug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'threadid'   => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'EdpForum\Controller\DiscussController',
                                'action'     => 'messages',
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                    'newthread' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route'    => '/newthread',
                            'defaults' => array(
                                'controller' => 'EdpForum\Controller\DiscussController',
                                'action'     => 'newthread',
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                ),
            ),
        ),
    ),
);
