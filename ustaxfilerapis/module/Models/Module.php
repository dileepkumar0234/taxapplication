<?php
namespace Models;
use Models\Model\User;
use Models\Model\UserTable;
use Models\Model\Userdetails;
use Models\Model\UserdetailsTable;
use Models\Model\Forgetpassword;
use Models\Model\ForgetpasswordTable;
use Models\Model\UploadPdfs;
use Models\Model\UploadPdfsTable;
use Models\Model\SchedulesTimings;
use Models\Model\SchedulesTimingsTable;
use Models\Model\RefferalFriends;
use Models\Model\RefferalFriendsTable;
use Models\Model\Spouse;
use Models\Model\SpouseTable;
use Models\Model\Dependent;
use Models\Model\DependentTable;
use Models\Model\ProcessingStatus;
use Models\Model\ProcessingStatusTable;
use Models\Model\AssignUserList;
use Models\Model\AssignUserListTable;
use Models\Model\Synopsys;
use Models\Model\SynopsysTable;
use Models\Model\ContactUs;
use Models\Model\ContactUsTable;
use Models\Model\Comments;
use Models\Model\CommentsTable;
use Models\Model\Payment;
use Models\Model\PaymentTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
				'Models\Model\UserFactory'					=>'Models\Factory\Model\UserTableFactory',
				'Models\Model\ForgetpasswordFactory'		=>'Models\Factory\Model\ForgetpasswordTableFactory',
				'Models\Model\UserDetailsFactory'			=>'Models\Factory\Model\UserDetailsTableFactory',
				'Models\Model\SchedulesTimingsFactory'		=>'Models\Factory\Model\SchedulesTimingsTableFactory',
				'Models\Model\UploadPdfsFactory'			=>'Models\Factory\Model\UploadPdfsTableFactory',
				'Models\Model\RefferalFriendsFactory'		=>'Models\Factory\Model\RefferalFriendsTableFactory',
				'Models\Model\SpouseFactory'		        =>'Models\Factory\Model\SpouseTableFactory',
				'Models\Model\DependentFactory'		        =>'Models\Factory\Model\DependentTableFactory',
				'Models\Model\ProcessingStatusFactory'	    =>'Models\Factory\Model\ProcessingStatusTableFactory',
				'Models\Model\AssignUserListFactory'	    =>'Models\Factory\Model\AssignUserListTableFactory',
				'Models\Model\SynopsysFactory'	            =>'Models\Factory\Model\SynopsysTableFactory',
				'Models\Model\ContactUsFactory'	            =>'Models\Factory\Model\ContactUsTableFactory',
				'Models\Model\CommentsFactory'	            =>'Models\Factory\Model\CommentsTableFactory',
				'Models\Model\PaymentFactory'	            =>'Models\Factory\Model\PaymentTableFactory',
			),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}