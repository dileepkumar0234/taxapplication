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
		$getcount = $assignUserListTable->getUnlistUserCount($id);
		$userList = array();
		if($getcount>0){
			return new JsonModel(array(
				'unListUsersCount' 	=> $getcount,
				'output' 	=> 'success',
				'success' 	=> true,
			));			
		}else{
			return new JsonModel(array(
				'unListUsersCount' 	=> '0',
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