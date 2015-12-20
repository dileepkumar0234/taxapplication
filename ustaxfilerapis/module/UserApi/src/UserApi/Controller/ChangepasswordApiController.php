<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class ChangepasswordApiController extends AbstractRestfulController
{
    public function getList()
    {			
			
    }
    public function get($user_id)
    {			
		
    }
    public function create($passwords)
    {
		header('Access-Control-Allow-Origin: *');
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){	
			$uid = $_SESSION['user_id'];
			$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
			$check_old_password = $userTable->getpassword($uid,$passwords['oldPwd']);
			if($check_old_password!=0){
				$change_password = $userTable->changepwd($uid,$passwords['cnfPwd']);
				if($change_password==0 || $change_password==1){
					return new JsonModel(array(
						'value' 	=> '1',
						'status' 	=> 'Password Successfully Updated.',
					));
				}
			}else{
				return new JsonModel(array(
					'value' 	=> '0',
					'status' 	=> 'Old Password Is Wrong.',
				));	
			}
		}else{
			return new JsonModel(array(
				'value' 	=> '0',
				'login' 	=> 'Requried',
			));	
		}
    }
    public function update($uid,$passwords)
    {
		
    }
    public function delete($id)
    {
       
    }
}