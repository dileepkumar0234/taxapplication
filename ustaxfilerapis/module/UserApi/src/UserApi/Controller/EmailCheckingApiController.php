<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class EmailCheckingApiController extends AbstractRestfulController
{
    public function getList()
    {			
			
    }
    public function get($email)
    {		
		header('Access-Control-Allow-Origin: *');
		$data=array();		
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		$checkingExists = $userTable->checkUniqueRecord($email);
		if($checkingExists!=0){
			return new JsonModel(array(
				'output' 		=> 'exists',
			));
		}else{
			return new JsonModel(array(
				'output' 	=> 'noyet',
			));
		}
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');
		$email = $data['user_email'];
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		$checkingExists = $userTable->checkUniqueRecord($email);
		if($checkingExists!=0){
			return new JsonModel(array(
				'output' 		=> 'exists',
			));
		}else{
			return new JsonModel(array(
				'output' 	=> 'noyet',
			));
		}
    }
    public function update($uid, $data)
    {
		
    }
    public function delete($id)
    {
       
    }
}