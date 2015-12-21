<?php
namespace AdminApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class UnlistUsersApiController extends AbstractRestfulController
{
    public function getList()
    {	
		
	}
    public function get($id)
    {	
		header('Access-Control-Allow-Origin: *');
		$assignUserListTable =$this->getServiceLocator()->get('Models\Model\AssignUserListFactory');
		$userTable = $this->getServiceLocator()->get('Models\Model\UserFactory');
		$getAssignedUser = $assignUserListTable->getUnlistUserCount($id);
		$userList = array();
		if(count($getAssignedUser)>0){
			foreach($getAssignedUser as $userListt){
				$userList[]= $userListt;
			}
			if(count($userList)>0){
				return new JsonModel(array(
					'userList' 	=> $userList,
					'output' 	=> 'success',
					'success' 	=> true,
				));
			}else{
				return new JsonModel(array(
					'output' 	=> 'success',
					'userList' 	=> ''
				));
			}
		}else{
			return new JsonModel(array(
				'output' 	=> 'success',
				'userList' 	=> ''
			));
		}
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');
			
    }
    public function update($uid,$data)
    {
				
    }
    public function delete($id)
    {
       
    }
}