<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'UserApi\Controller\LoginUserApi' 		=> 	'UserApi\Controller\LoginUserApiController',	
            'UserApi\Controller\ForgetpasswordApi' 	=> 	'UserApi\Controller\ForgetpasswordApiController',	
            'UserApi\Controller\ChangepasswordApi' 	=> 	'UserApi\Controller\ChangepasswordApiController',
			'UserApi\Controller\RegistrationApi'	=>	'UserApi\Controller\RegistrationApiController',
			'UserApi\Controller\EmailCheckingApi'   =>  'UserApi\Controller\EmailCheckingApiController',
			'UserApi\Controller\DependentApi'       =>  'UserApi\Controller\DependentApiController',
			'UserApi\Controller\SpouseApi'          =>  'UserApi\Controller\SpouseApiController',
			'UserApi\Controller\TaxPayerApi'        =>  'UserApi\Controller\TaxPayerApiController',
			'UserApi\Controller\SchedulesApi'       =>  'UserApi\Controller\SchedulesApiController',
			'UserApi\Controller\UploadPdfsApi'      =>  'UserApi\Controller\UploadPdfsApiController',
			'UserApi\Controller\ReferralFriendApi'  =>  'UserApi\Controller\ReferralFriendApiController',
			'UserApi\Controller\LogoutApi'          =>  'UserApi\Controller\LogoutApiController',
        ),
    ),
    // The following section is new` and should be added to your file
    'router' => array(
        'routes' => array(		
            'register' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/register[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'UserApi\Controller\RegistrationApi',
                    ),
                ),
            ),
			'getprescription' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/getprescription[/:id]',
                    'constraints' => array(
                        'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'UserApi\Controller\GetorderdetailsApi',
                    ),
                ),
            ),
			'discounts' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/discounts[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\DiscountsApi',
					),
				),
			),
			'complaints' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/complaints[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\ComplaintsApi',
					),
				),
			),
			'reviews' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/reviews[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\ReviewsRatingsApi',
					),
				),
			),
			'login' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/login[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\LoginUserApi',
					),
				),
			),
			'logout' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/logout[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\LogoutApi',
					),
				),
			),
			'dependent-page' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/dependent-page[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\DependentApi',
					),
				),
			),
			'referral-friend' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/referral-friend[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\ReferralFriendApi',
					),
				),
			),
			'uploadPdfs-page' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/uploadPdfs-page[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\UploadPdfsApi',
					),
				),
			),
			'schedules-page' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/schedules-page[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\SchedulesApi',
					),
				),
			),
			'spouse-page' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/spouse-page[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\SpouseApi',
					),
				),
			),
			'taxpayer-page' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/taxpayer-page[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\TaxPayerApi',
					),
				),
			),
			'email-verified' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/email-verified[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\EmailCheckingApi',
					),
				),
			),
			'subscriber' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/subscriber[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\SubscribeApi',
					),
				),
			),
			'forgetpassword' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/forgetpassword[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\ForgetpasswordApi',
					),
				),
			),
			'changepassword' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/changepassword[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\ChangepasswordApi',
					),
				),
			),
			'registration' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/registration[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\RegistrationApi',
					),
				),
			),
			'order' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/order[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\OrderApi',
					),
				),
			),
			'country' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/country[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\CountryApi',
					),
				),
			),
			'state' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/state[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\StateApi',
					),
				),
			),
			'renuwalorder' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/renuwalorder[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\RenuwalorderApi',
					),
				),
			),
			'shopregister' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/shopregister[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\ShopregistationApi',
					),
				),
			),
			'userpaginator' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/userpaginator[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\UserpaginatorApi',
					),
				),
			),
			'notifications' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/notifications[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\NotificationsApi',
					),
				),
			),
			'userreports' => array(
				'type'    => 'Segment',
				'options' => array(
					'route'    => '/userreports[/:id]',
					'constraints' => array(
						'id' => '[%&@*.;a-zA-Z0-9][%&@*.;a-zA-Z0-9_-]*',
					),
					'defaults' => array(
						'controller' => 'UserApi\Controller\UsersreportsApi',
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