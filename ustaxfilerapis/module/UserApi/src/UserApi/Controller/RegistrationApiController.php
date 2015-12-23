<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class RegistrationApiController extends AbstractRestfulController
{
    public function getList()
    {			
			
    }
    public function get($user_id)
    {		
		header('Access-Control-Allow-Origin: *');
		$data=array();		
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$uid = $_SESSION['user_id'];
		}else{
			$uid = $user_id;
		}
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
		header('Access-Control-Allow-Origin: *');
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		$userDetailsTable=$this->getServiceLocator()->get('Models\Model\UserDetailsFactory');
		$processStatusTable = $this->getServiceLocator()->get('Models\Model\ProcessingStatusFactory');
		$lastInsertedId = $userTable->saveUserData($data);
		$unique_code = 'UTS'.str_pad((int)$lastInsertedId, 4, "0", STR_PAD_LEFT);
		$updatedUCode = $userTable->updateUniqueCode($unique_code,$lastInsertedId);
		$userDetailsId = $userDetailsTable->saveUserDetails($data,$lastInsertedId);
		$processStart = $processStatusTable->saveProccessingStatus($lastInsertedId);
		$msg ='';
		if($userDetailsId!=0){
			$getDetails = $userTable->getUserData($lastInsertedId);
			if($getDetails!=''){
				$username = $getDetails->user_name;
				$emailId = $getDetails->email;
				$password = $getDetails->password;
				$msg .= '<body>';
				$msg .='<table width="600" border="0" cellspacing="0" cellpadding="0">';
				$msg .='<tr>';
				$msg .='<td><table width="600" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #178acc ">';
				$msg .='<tr><td bgcolor="#178acc ">';
				$msg .='<a href="Javascript:void(0);" target="_blank" style="text-decoration: none;">';
				$msg .='<span style="color:#fff; font:normal 30px arial">UmpireTaxFiler</span></a></td>';
				$msg .='</tr>';
				$msg .='<tr>';
				$msg .='<td>';
				$msg .='<table width="100%" border="0" cellspacing="0" cellpadding="10" align="left">';
				$msg .='<tr><td><a href="javascript:void(0);" style="color:#4ca4b6 ; font:bold 12px arial; text-decoration:none;">
				Dear&nbsp;'.$username.'</a></td></tr>';
				$msg .='<tr><td>Your Login Credentials.</td></tr>';						
				$msg .='<tr><td>'.$emailId.'</td></tr>';						
				$msg .='<tr><td>'.$password.'</td></tr>';						
				$msg .='<tr><td>&nbsp;</td></tr>';
				$msg .='<tr><td>Sincerely,</td></tr>';
				$msg .='<tr><td>UmpireTaxFiler Team</td></tr>';
				$msg .='</table>';
				$msg .='</td>';
				$msg .='</tr>';  
				$msg .='</table></td>';
				$msg .='</tr>'; 
				$msg .='</table>';
				$msg .='<br/><br/>';
				$msg .='Regards,<br/>';
				$msg .='UmpireTaxFiler';
				$msg .='</body>';
				$subj ='Welcome, New User.';
				//mail($emailId,$subj,$msg);
				return new JsonModel(array(
					'Success' =>'Registration Success',
					'UserId'	=>	$lastInsertedId,
					'Email' =>$emailId
				));
			}
		}else{
			return new JsonModel(array(
				'UserId'	=>	0,
			));
		}
    }
    public function update($uid, $data)
    {
		header('Access-Control-Allow-Origin: *');	
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		$userDetailsTable=$this->getServiceLocator()->get('Models\Model\UserDetailsFactory');
		$userRegistration = $userTable->updateUserData($data,$uid);
		$userRegistrationDetails = $userDetailsTable->updateUserDetails($data,$uid);
		if($userRegistrationDetails){
			return new JsonModel(array(
				'value' 	=> 1,
			));
		}else{
			return new JsonModel(array(
				'value' 	=> 0,
			));
		}
    }
    public function delete($id)
    {
       
    }
}