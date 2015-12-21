<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'AdminApi\Controller\BasicInfoApi'  =>	'AdminApi\Controller\BasicInfoApiController',
            'AdminApi\Controller\UserInformationApi'  =>'AdminApi\Controller\UserInformationApiController',
            'AdminApi\Controller\SynopsysApi'  =>'AdminApi\Controller\SynopsysApiController',
            'AdminApi\Controller\UnlistApi'  =>'AdminApi\Controller\UnlistApiController',
            'AdminApi\Controller\UnlistUsersApi'  =>'AdminApi\Controller\UnlistUsersApiController',
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
			'admin-add-shop' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/admin-add-shop[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\RegistrationApi',
					),
				),
			),
			'order-status' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/order-status[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\ReviewsApi',
					),
				),
			),
			'admin-all-shops' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/admin-all-shops[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\RegistrationApi',
					),
				),
			),
			'admin-delete-user' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/admin-delete-user[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\RegistrationApi',
					),
				),
			),
			'admin-allusers' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/admin-allusers[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\ChangepasswordApi',
					),
				),
			),
			'admin-delete-user' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/admin-delete-user[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\RegistrationApi',
					),
				),
			),
			'send-notification-to-shops' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/send-notification-to-shops[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\NotificationsApi',
					),
				),
			),
			'order-quotations-from-shops' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/order-quotations-from-shops[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\NotificationsApi',
					),
				),
			),
			'confirmation-order-to-shop' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/confirmation-order-to-shop[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\OrderApi',
					),
				),
			),
			'totalreports' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/totalreports[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\ReportsApi',
					),
				),
			),
			'reviews-and-ratings' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/reviews-and-ratings[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\ReviewsApi',
					),
				),
			),
			'all-complaints' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/all-complaints[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\ComplaintsApi',
					),
				),
			),
			'all-renewed-orders' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/all-renewed-orders[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\RenewedordersApi',
					),
				),
			),
			'disable-order-renewal' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/disable-order-renewal[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\RenewedordersApi',
					),
				),
			),
			'sendnewsletter' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/sendnewsletter[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'AdminApi\Controller\SendnewsletterApi',
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