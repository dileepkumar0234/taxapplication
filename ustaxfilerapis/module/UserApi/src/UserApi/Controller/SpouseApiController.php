<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class SpouseApiController extends AbstractRestfulController
{
    public function getList()
    {			
    }
    public function get($id)
    {		
		header('Access-Control-Allow-Origin: *');
		if(isset($id) && $id!=""){
			$spouseTable = $this->getServiceLocator()->get('Models\Model\SpouseFactory');
			
				$usId = $id;
			
			$getData = $spouseTable->getData($usId);
			if($getData!=""){
				return new JsonModel(array(
					'data' 	=> $getData
				));
			}else{
				return new JsonModel(array(
					'data' 	=> '',
				));
			}
		}
    }
    public function create($data)
    {
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
			header('Access-Control-Allow-Origin: *');
			$spouseTable = $this->getServiceLocator()->get('Models\Model\SpouseFactory');
			$insertId = $spouseTable->saveSpouseData($data);
			$usId = $_SESSION['user_id'];
			if($insertId>0){
				return new JsonModel(array(
					'data' 	=> 'success',
					'spouse_id'=>$insertId,
					'user_id'=>$usId
				));
			}else{
				return new JsonModel(array(
					'data' 	=> 'not success',
					'spouse_id'=>''
				));
			}
		}else{
			return new JsonModel(array(
				'data' 	   => 'not success',
				'required' => 'Login Required'
			));
		}
    }
    public function update($uid, $data)
    {
		header('Access-Control-Allow-Origin: *');
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		$userRegistration = $userTable->updateUserData($data,$usId);
		$userRegistrationDetails = $userDetailsTable->updateSpouse($data,$usId);
		if($userRegistrationDetails){
			return new JsonModel(array(
				'value' 	=> 1,
				'output' 	=> 'success',
				'uid' 	=> $usId
			));
		}else{
			return new JsonModel(array(
				'value' 	=> 0,
				'output' 	=> 'boom',
				'uid' 	=> '',
			));
		}
    }
    public function delete($id)
    {
       
    }
}