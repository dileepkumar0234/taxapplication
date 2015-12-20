<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class ForgetpasswordApiController extends AbstractRestfulController
{
    public function getList()
    {			
			
    }
    public function get($token)
    {
		header('Access-Control-Allow-Origin: *');
		$forgetpasswordTable=$this->getServiceLocator()->get('Models\Model\ForgetpasswordFactory');
		$tokenExit=$forgetpasswordTable->gettoken($token)->toarray();		
		if(count($tokenExit)!=0){		
			return new JsonModel(array(									
				'value' => '1',
			));
		}else{
			return new JsonModel(array(									
				'value' => '0',
			));
		}
    }
    public function create($s_eamil)
    {
		header('Access-Control-Allow-Origin: *');
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		$email=$s_eamil['email'];	
		$checkingExists = $userTable->checkUniqueRecord($email);
		if($checkingExists!=0){
			$getDetails = $userTable->getUserEmailData($email);
			$msg ='';
			if(count($getDetails)!=''){
				$user_id = base64_encode($getDetails->user_id);
				$logInPassword = $getDetails->locked_pwd;
				$username = $getDetails->user_name;
				$emailId = $getDetails->email;
				$url = 'http://localhost/ustaxfiler-main/ustaxfilerhtmls/reset-password.php?uid='.$user_id;
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
				Dear&nbsp;'.ucfirst($username).'</a></td></tr>';
				$msg .='<tr><td>Your Login Details.</td></tr>';						
				$msg .='<tr><td>EamilId : '.$emailId.'</td></tr>';						
				$msg .='<tr><td>PassWord : '.$logInPassword.'</td></tr>';						
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
				echo 'Reset Password:'.$msg;exit;
				$subj ='Reset Password.';
				mail($emailId,$subj,$msg);
				return new JsonModel(array(
					'output'	=>	'success',
				));
			}
		}else{
			return new JsonModel(array(
				'output' 	=> 'No Data Found',
			));
		}
		return $result;
    }
    public function update($id, $data)
    {
		header('Access-Control-Allow-Origin: *');
		$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
		$getDetails = $userTable->getUserData($id);
		if($getDetails!=''){					
			$changepwd = $userTable->changepwd($getDetails->user_id,$data['cnfPwd']);			
			if($changepwd>=0){
				$result = new JsonModel(array(					
					'value' => '1',
					'Success' => 'Password Successfully Updated'
				));			
			}else{
				$result = new JsonModel(array(					
					'value' => '0'
				));
			}
			return $result;	
		}else{
			return new JsonModel(array(					
				'value' => '0'
			));
		}
    }
    public function delete($id)
    {
       
    }
}