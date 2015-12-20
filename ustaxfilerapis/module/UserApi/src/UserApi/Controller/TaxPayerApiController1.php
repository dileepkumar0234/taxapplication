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
    		
    }
    public function create($data)
    {
    }
    public function update($uid, $data)
    {
		header('Access-Control-Allow-Origin: *');	
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
			$usId = $_SESSION['user_id'];
		}else{
			$usId = $uid;
		}
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