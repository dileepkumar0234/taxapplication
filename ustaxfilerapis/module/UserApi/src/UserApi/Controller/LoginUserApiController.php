<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;
class LoginUserApiController extends AbstractRestfulController
{
    public function getList()
    {
		
    }
    public function get($email)
    {
		header('Access-Control-Allow-Origin: *');		
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');		
		$checkUser = $userTable->checkUniqueRecord($email)->toarray();		
		if(count($checkUser)!=0){
			return new JsonModel(array(
				'data' => 'Email already exists',
				'value' => 1,
			));			
		}else{
			return new JsonModel(array(
				'data'  => 'Valid email',
				'value' => 0,
			));			
		}
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');	
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		$email = $data['userEmail'];
		$checkUserloginemail = $userTable->checkDetails($data)->current();	
		if($checkUserloginemail!=''){
			$user_type_id = $checkUserloginemail->user_type_id;
			$user_id = $checkUserloginemail->user_id;
			if($user_type_id==1){
				// $ip = $_SERVER['REMOTE_ADDR'];
				$ip = '127.0.0.1';
				$checkIpAddress = $userTable->checkAdminIp($data,$ip)->current();				
				if($checkIpAddress!=''){
					$uid = '';
					$_SESSION['user_id']=$checkIpAddress->user_id;
					$userType = 'Admin';
					$uEmail = $checkIpAddress->email;
					$uName =  $checkIpAddress->user_name;
					$uPhone = $checkIpAddress->phone;
					return new JsonModel(array(
						'status' 	=>  'sucess',
						'UserType' 	=>  $userType,
						'uid' 	    =>  $uid,
						'useremail' =>  $uEmail,
						'username'  =>  $uName,
						'userphone' =>  $uPhone
					));			
				}else{
					return new JsonModel(array(
						'status'	=>	'fail',
						'ip'		=>  'Login root is wrong',
						'UserType' 	=>  '',
					));			
				}
			}else if($user_type_id==3){
				// $ip = $_SERVER['REMOTE_ADDR'];
				$ip = '127.0.0.1';
				$checkIpAddress = $userTable->checkAdminIp($data,$ip)->current();				
				if($checkIpAddress!=''){
					$uid = '';
					$_SESSION['user_id']=$checkIpAddress->user_id;
					$userType = 'Agent';
					$uEmail = $checkIpAddress->email;
					$uName =  $checkIpAddress->user_name;
					$uPhone = $checkIpAddress->phone;
					return new JsonModel(array(
						'status' 	=>  'sucess',
						'UserType' 	=>  $userType,
						'uid' 	    =>  $uid,
						'useremail' =>  $uEmail,
						'username'  =>  $uName,
						'userphone' =>  $uPhone
					));			
				}else{
					return new JsonModel(array(
						'status'	=>	'fail',
						'ip'		=>  'login root is wrong',
						'UserType' 	=>  '',
					));			
				}
			}else{
				$uid = '';
				$checkUser = $userTable->getUserData($user_id);	
				$_SESSION['user_id']=$checkUser->user_id;
				$userType = 'User';
				$uEmail = $checkUser->email;
				$uName = $checkUser->user_name;
				$uPhone = $checkUser->phone;
				$uid = $_SESSION['user_id'];
				if($checkUser){
					return new JsonModel(array(
						'status' 	=>  'sucess',
						'data' 	    =>  $checkUser,
						'UserType' 	=>  $userType,
						'uid' 	=>  $uid,
						'useremail' =>  $uEmail,
						'username' =>  $uName,
						'userphone' =>  $uPhone
					));			
				}else{
					return new JsonModel(array(
						'status'	=>	'fail',
						'data'		=>  '',
						'UserType' 	=>  '',
					));			
				}
			}			
		}else{
			return new JsonModel(array(
				'status'		=>  'Fail',
				'data'		    =>  '',
				'UserType'      =>  ''
			));			
		}
    }
    public function update($id, $data)
    {
        
    }
    public function delete($id)
    {
       
    }
}