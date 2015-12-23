<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class TaxPayerApiController extends AbstractRestfulController
{
    public function getList()
    {			
    }
    public function get($id)
    {		
		header('Access-Control-Allow-Origin: *');
		$data=array();		
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		$uid = $id;
      	$userData = $userTable->getUserData($uid);
		if(count($userData)!=0){
			return new JsonModel(array(
				'data' 		=> $userData,
			));
		}else{
			return new JsonModel(array(
				'output' 	=> 'no data',
			));
		}
    }
    public function create($data)
    {
    }
    public function update($uid, $data)
    {
		header('Access-Control-Allow-Origin: *');	
		$usId = $uid;
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		$userDetailsTable=$this->getServiceLocator()->get('Models\Model\UserDetailsFactory');
		$userRegistration = $userTable->updateUserData($data,$usId);
		$userRegistrationDetails = $userDetailsTable->updateTaxPayer($data,$usId);		
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