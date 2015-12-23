<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;
class ReferralFriendApiController extends AbstractRestfulController
{
    public function getList()
    {
		
    }
    public function get($id)
    {
		header('Access-Control-Allow-Origin: *');	
		$refferalFriendTable=$this->getServiceLocator()->get('Models\Model\RefferalFriendsFactory');
		$getRefferal = $refferalFriendTable->getRefferal($id);
		$reFFeral = array();
		if(count($getRefferal)>0){
			foreach($getRefferal as $refD){
				$reFFeral[]=$refD;
			}
			return new JsonModel(array(
				'status'	=>	'success',
				'reFFeral'		=>  $reFFeral,
			));	
		}else{
			return new JsonModel(array(
				'status'	=>	'Fail',
				'reFFeral'	=>  '',
			));	
		}
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');	
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$uid = $_SESSION['user_id'];
			if(isset($data['rf_on_email']) && $data['rf_on_email']!=""){
				$refferalFriendTable=$this->getServiceLocator()->get('Models\Model\RefferalFriendsFactory');
				$checkAlreadyRequested = $refferalFriendTable->checkRequestOneWay($data['rf_on_email'],$data['rf_email']);
				if($checkAlreadyRequested>0){
					return new JsonModel(array(
						'status'		=>  'Fail',
						'super'		    =>  '0',
						'funny'		    =>  'Alredy Reffered to you.',
					));	
				}else{
					$checkAlreadyReply = $refferalFriendTable->checkRequestsecondWay($data['rf_email'],$data['rf_on_email']);
					if($checkAlreadyReply>0){
						return new JsonModel(array(
							'status'		=>  'Fail',
							'super'		    =>  '0',
							'funny'		    =>  'Your friend Reffered to you.',
						));	
					}else{
						$refferalInserted = $refferalFriendTable->saveRerfferal($uid,$data);
						$msg = '';
						if($refferalInserted!=''){
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
							Dear&nbsp;'.$data['rf_name'].'</a></td></tr>';
							$msg .='<tr><td>Your friend '.$data['rf_on_name'].' is reffered to you.</td></tr>';						
							$msg .='<tr><td>'.$data['rf_email'].'</td></tr>';						
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
							echo $msg;exit;
							$subj ='Refferal Friends.';
							$emailId = $data['rf_email'];
							//mail($emailId,$subj,$msg);
							return new JsonModel(array(
								'status'	=>	'success',
								'value'		=>  '1',
								'uid'		=>  $uid,
							));			
						}else{
							return new JsonModel(array(
								'status'		=>  'Fail',
								'value'		    =>  '0',
							));			
						}
					}
				}
			}else{
				return new JsonModel(array(
					'status'		=>  'Fail',
					'super'		    =>  '0',
				));
			}
		}else{
			return new JsonModel(array(
				'status'		=>  'Fail',
				'super'		    =>  '0',
				'funny'         => 'Login Requried'
			));
		}
    }
    public function update($id, $data)
    {
        
    }
    public function delete($id)
    {
       
    }
}