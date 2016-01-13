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
		$msg ='';$headers="";
		if($userDetailsId!=0){
			$getDetails = $userTable->getUserData($lastInsertedId);
			if($getDetails!=''){
				$username = $getDetails->user_name;
				$emailId = $getDetails->email;
				$password = $getDetails->locked_pwd;
				$from = 'Hello@umpiretaxsolutions.com';
				$headers = "From: " . strip_tags($from) . "\r\n";
				$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$msg .= '<body>';
				$msg .='<table width="600" border="0" cellspacing="0" cellpadding="0">';
				$msg .='<tr>';
				$msg .='<td><table width="600" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #178acc ">';
				$msg .='<tr><td bgcolor="#178acc ">';
				$msg .='<a href="Javascript:void(0);" target="_blank" style="text-decoration: none;">';
				$msg .='<span style="color:#fff; font:normal 30px arial">UTS</span></a></td>';
				$msg .='</tr>';
				$msg .='<tr>';
				$msg .='<td>';
				$msg .='<table width="100%" border="0" cellspacing="0" cellpadding="10" align="left">';
				$msg .='<tr><td><a href="javascript:void(0);" style="color:#4ca4b6 ; font:bold 12px arial; text-decoration:none;">
				Dear '.$username.',</a></td></tr>';
				$msg .='<tr><td>Greetings from Umpire Tax Solutions, LLC</td></tr>';				
				$msg .='<tr><td>Thank you for Associating with the Umpire Tax Solutions and getting registered. Your account has been 
				successfully created, below are your login credentials.</td></tr>';				
				$msg .='<tr><td>User name: '.$emailId.'</td></tr>';						
				$msg .='<tr><td>Password: '.$password.'</td></tr>';						
				$msg .='<tr><td>&nbsp;</td></tr>';
				$msg .='<tr><td>As a next step to the process, we request you to follow the below steps.</td></tr>';
				$msg .='<tr><td>&nbsp;&nbsp;&nbsp;&nbsp; Login into your account and update your personal information.</td></tr>';
				$msg .='<tr><td>&nbsp;&nbsp;&nbsp;&nbsp; Schedule the time for tax notes at your available time, so that we will collect some
				additional information which is required for Tax planning, and upload the necessary documents.</td></tr>';
				$msg .='<tr><td>&nbsp;&nbsp;&nbsp;&nbsp; You will receive the Free Tax Estimates within less than 24 hours after getting the
				required information from you. If you satisfied with our estimates, please pay the fees accordingly.</td></tr>';
				$msg .='<tr><td>&nbsp;&nbsp;&nbsp;&nbsp; After making the payment you will receive the Tax return copy, just review the
				document and give us the confirmation.</td></tr>';
				$msg .='<tr><td>&nbsp;&nbsp;&nbsp;&nbsp; After confirmation your return will be E-filed or Paper filed accordingly.</td></tr>';
				$msg .='<tr><td>&nbsp;</td></tr>';
				$msg .='<tr><td>Please do write to us at Hello@umpiretaxsolutions.com or please feel free to call us at 828-548-6793.</td></tr>';
				$msg .='<tr><td>Wishing you a very Triumphant New Year 2016, we sincerely thank you again for this opportunity given
				to us to serve for tax planning & filing needs.</td></tr>';
				$msg .='<tr><td>We wish to have a long relationship.</td></tr>';
				$msg .='<tr><td>&nbsp;</td></tr>';
				$msg .='</table>';
				$msg .='</td>';
				$msg .='</tr>';  
				$msg .='</table></td>';
				$msg .='</tr>'; 
				$msg .='</table>';
				$msg .='<br/><br/>';
				$msg .='Warm Regards,<br/>';
				$msg .='Umpire Tax solutions, LLC <br/>';
				$msg .='USA: 828-548-6793 <br/>';
				$msg .='INDIA: +91-720-754-3882<br/>';
				$msg .='</body>';
				$subj ='Welcome, To Umpire Tax solutions.';
				mail($emailId, $subj, $msg, $headers);
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