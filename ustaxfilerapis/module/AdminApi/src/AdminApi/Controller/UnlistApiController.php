<?php
namespace AdminApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class UnlistApiController extends AbstractRestfulController
{
    public function getList()
    {			
    }
    public function get($id)
    {	
		header('Access-Control-Allow-Origin: *');
		$assignUserListTable =$this->getServiceLocator()->get('Models\Model\AssignUserListFactory');
		$userTable = $this->getServiceLocator()->get('Models\Model\UserFactory');
		$getAssignedUser = $assignUserListTable->getData($id);
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
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$assignUserListTable =$this->getServiceLocator()->get('Models\Model\AssignUserListFactory');
			$client_id = $data['client_id'];
			$clientalreadyAssigned = $assignUserListTable->userAssignedAlready($client_id);
			if($clientalreadyAssigned!="0"){
				return new JsonModel(array(
					'assigned' 	=> 'User Already assigned',
					'output' 	=> 'success',
					'success' 	=> true,
				));
			}else{
				$allocatedUserId = $assignUserListTable->assignUser($data);
				$processStatusTable = $this->getServiceLocator()->get('Models\Model\ProcessingStatusFactory');
				$st =1;
				$updateProcessStatus = $processStatusTable->updateProcess($client_id,$st);
				if($allocatedUserId!=0){
					return new JsonModel(array(
						'assigned' 	=> $allocatedUserId,
						'output' 	=> 'success',
						'success' 	=> true,
					));
				}else{
					return new JsonModel(array(
						'assigned' 	=> '',
						'output' 	=> 'notsuccess',
						'success' 	=> false,
					));
				}	
			}
		}else{
			return new JsonModel(array(
				'status' 	=> 'Logged Required',
			));			
		}			
    }
    public function update($uid,$data)
    {
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$uid = $_SESSION['user_id'];
			$uploadPdfsTable =$this->getServiceLocator()->get('Models\Model\UploadPdfsFactory');
			$addedStatus = $uploadPdfsTable->addUploadPdf($uid,$data);
			if($addedStatus!=0){
				return new JsonModel(array(
					'status' 	=> 'Uploaded successfully',
					'error' 	=> '1',
				));
			}else{
				return new JsonModel(array(
					'status' 	=> 'Not yet',
					'error' 	=> '0',
				));
			}			
		}else{
			return new JsonModel(array(
				'error' 	=> '0',
				'status' 	=> 'Logged Required',
			));
			
		}
		
    }
    public function delete($id)
    {
       
    }
}