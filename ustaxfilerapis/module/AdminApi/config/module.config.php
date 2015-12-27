<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'AdminApi\Controller\BasicInfoApi'        =>'AdminApi\Controller\BasicInfoApiController',
            'AdminApi\Controller\UserInformationApi'  =>'AdminApi\Controller\UserInformationApiController',
            'AdminApi\Controller\SynopsysApi'         =>'AdminApi\Controller\SynopsysApiController',
            'AdminApi\Controller\UnlistApi'           =>'AdminApi\Controller\UnlistApiController',
            'AdminApi\Controller\UnlistUsersApi'      =>'AdminApi\Controller\UnlistUsersApiController',
            'AdminApi\Controller\ChangepasswordApi'   =>'AdminApi\Controller\ChangepasswordApiController',
            'AdminApi\Controller\LogoutApi'           =>'AdminApi\Controller\LogoutApiController',
            'AdminApi\Controller\UnlistUsersCountListApi' =>'AdminApi\Controller\UnlistUsersCountListApiController',

		),
    ),
    // The following section is new` and should be added to your file
    'router' => array(
        'routes' => array(		
            'user-list' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/user-list[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\UserInformationApi',
                    ),
                ),
            ),
			'unlist-user-count' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/unlist-user-count[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\UnlistUsersCountListApi',
                    ),
                ),
            ),
			'assign-user' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/assign-user[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\UnlistApi',
                    ),
                ),
            ),
			'admin-logout' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/admin-logout[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\LogoutApi',
					),
				),
			),
			'unlist-logout' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/unlist-logout[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\LogoutApi',
					),
				),
			),
			'admin-change-password' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/admin-change-password[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\ChangepasswordApi',
                    ),
                ),
            ),
			'get-unlistusers-count' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/get-unlistusers-count[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\UnlistUsersApi',
                    ),
                ),
            ),
			'get-unlists' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/get-unlists[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\UserInformationApi',
                    ),
                ),
            ),
			'get-unlist-user' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/get-unlist-user[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\UnlistApi',
                    ),
                ),
            ),
			'get-processing-info' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/get-processing-info[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\BasicInfoApi',
                    ),
                ),
            ),
			'upload-synopsys' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/upload-synopsys[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\SynopsysApi',
                    ),
                ),
            ),
			'get-user-synopsy' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/get-user-synopsy[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\SynopsysApi',
                    ),
                ),
            ),
			'update-process' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/update-process[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\BasicInfoApi',
                    ),
                ),
            ),
			'count-each-stages' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/count-each-stages[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\BasicInfoApi',
                    ),
                ),
            ),
			'synopsy-upload' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/synopsy-upload[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'AdminApi\Controller\SynopsysApi',
                    ),
                ),
            ),
		),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
	
);