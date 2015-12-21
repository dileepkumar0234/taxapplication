<?php
namespace AdminApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class UserInformationApiController extends AbstractRestfulController
{
    public function getList()
    {
		header('Access-Control-Allow-Origin: *');
		$userTable = $this->getServiceLocator()->get('Models\Model\UserFactory');
		$getOfUsers = $userTable->getUserList();
		$userList = array();
		foreach($getOfUsers as $users){
			$userList[] = $users;			
		}
		if(count($userList)>0){
			return new JsonModel(array(
				'output'   => 'success',
				'success' 	 => $userList
			));
			
		}else{
			return new JsonModel(array(
				'output'   => 'nosuccess',
				'success' 	 => ''
			));
			
		}
		
    }
    public function get($id)
    {	
		header('Access-Control-Allow-Origin: *');
		$userTable = $this->getServiceLocator()->get('Models\Model\UserFactory');
		$getOfUsers = $userTable->getUnListUserList();
		$userList = array();
		foreach($getOfUsers as $users){
			$userList[] = $users;			
		}
		if(count($userList)>0){
			return new JsonModel(array(
				'output'   => 'success',
				'UnListUser' 	 => $userList
			));
			
		}else{
			return new JsonModel(array(
				'output'   => 'nosuccess',
				'UnListUser'=> ''
			));
			
		}
	}
    public function create($oder)
    {
		
    }
    public function update($order_id,$order)
    {
		header('Access-Control-Allow-Origin: *');
	}
		
    public function delete($id)
    {
       
    }
}