<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class DependentApiController extends AbstractRestfulController
{
    public function getList()
    {			
    }
    public function get($id)
    {	
		header('Access-Control-Allow-Origin: *');	
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
			$usId = $_SESSION['user_id'];
		}else{
			$usId = $id;
		}
		$dependentTable=$this->getServiceLocator()->get('Models\Model\DependentFactory');
		$getData = $dependentTable->getData($usId);
		$dep = array();
		foreach($getData as $dataD){
			$dep[]= $dataD;			
		}
		if($getData){
			return new JsonModel(array(
				'output' 	=> 'success',
				'dep' 	=> $dep
			));
		}else{
			return new JsonModel(array(
				'output' 	=> 'boom',
				'dep' 	=> '',
			));
		}
    }
    public function create($data)
    {
		// $data = array();
		// $data['dep'] = array();
		// $data['dep'] = array(
			// array(
				// "first_name"=>"Dileep",
				// "last_name" =>"DKumar",
				// "occupation"=>"occupation",
				// "dob"=>"dob",
				// "address"=>"address",
				// "phone"=>"8500222765",
				// "mail_id"=>"abc@gmail.com",
			// ),
			// array(
				// "first_name"=>"Dileep",
				// "last_name" =>"DKumar",
				// "occupation"=>"occupation",
				// "dob"=>"dob",
				// "address"=>"address",
				// "phone"=>"8500222765",
				// "mail_id"=>"abc@gmail.com",
			// ),
			// array(
				// "first_name"=>"Dileep",
				// "last_name" =>"DKumar",
				// "occupation"=>"occupation",
				// "dob"=>"dob",
				// "address"=>"address",
				// "phone"=>"8500222765",
				// "mail_id"=>"abc@gmail.com",
			// ),
			// array(
				// "first_name"=>"Dileep",
				// "last_name" =>"DKumar",
				// "occupation"=>"occupation",
				// "dob"=>"dob",
				// "address"=>"address",
				// "phone"=>"8500222765",
				// "mail_id"=>"abc@gmail.com",
			// ),
			// array(
				// "first_name"=>"Dileep",
				// "last_name" =>"DKumar",
				// "occupation"=>"occupation",
				// "dob"=>"dob",
				// "address"=>"address",
				// "phone"=>"8500222765",
				// "mail_id"=>"abc@gmail.com",
			// )
		// );
		// echo json_encode($data);exit;
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
			header('Access-Control-Allow-Origin: *');
			$dependentTable = $this->getServiceLocator()->get('Models\Model\DependentFactory');
			$datad = array();
			if(isset($data) && $data!=""){
				foreach($data['dep'] as $users )
				{
					if(isset($users['first_name']) && $users['first_name']!=''){
						$datad['first_name']  = $users['first_name'];
					}else{
						$datad['first_name'] = '';
					}
					if(isset($users['last_name']) && $users['last_name']!=''){
						$datad['last_name'] = $users['last_name'];
					}else{
						$datad['last_name'] ='';
					}
					if(isset($users['occupation']) && $users['occupation']!=''){
						$datad['occupation'] = $users['occupation'];
					}else{
						$datad['occupation'] ='';
					}
					if(isset($users['dob']) && $users['dob']!=''){
						$datad['dob'] = $users['dob'];
					}else{
						$datad['dob'] ='';
					}
					if(isset($users['address']) && $users['address']!=''){
						$datad['address'] = $users['address'];
					}else{
						$datad['address'] ='';
					}
					if(isset($users['phone']) && $users['phone']!=''){
						$datad['phone'] = $users['phone'];
					}else{
						$datad['phone'] ='';
					}
					if(isset($users['mail_id']) && $users['mail_id']!=''){
						$datad['mail_id'] = $users['mail_id'];
					}else{
						$datad['mail_id'] ='';
					}	
					$insertId = $dependentTable->saveDependent($datad);
				}				
				$usId = $_SESSION['user_id'];
				if($insertId>0){
					return new JsonModel(array(
						'data' 	=> 'success',
						'user_id'=>$usId
					));
				}else{
					return new JsonModel(array(
						'data' 	=> 'not success',
						'user_id'=>''
					));
				}
			}else{
				return new JsonModel(array(
					'data' 	=> 'Data Not Found',
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
		
    }
    public function delete($id)
    {
		header('Access-Control-Allow-Origin: *');
		$dependentTable = $this->getServiceLocator()->get('Models\Model\DependentFactory');
		$deleDependentStatus = $dependentTable->deleteDependent($id);
		return new JsonModel(array(
			'data' 	   => 'not success',
			'required' => 'Login Required'
		));
    }
}