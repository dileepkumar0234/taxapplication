<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;
class ReachApiController extends AbstractRestfulController
{
    public function getList()
    {
		header('Access-Control-Allow-Origin: *');
		$contactUsTable  = $this->getServiceLocator()->get('Models\Model\ContactUsFactory');
		$list = $contactUsTable->allContacts();
		$allContacts = array();
		if(count($list)>0){
			foreach($list as $contact){
				$allContacts[] = $contact;
			}
			if($allContacts>0){
				return new JsonModel(array(
					'output' 	=> 'success',
					'allContacts' 	=> $allContacts
				));
			}else{
				return new JsonModel(array(
					'output' 	    => 'boom',
					'allContacts' 	=> ''
				));
			}
		}else{
			return new JsonModel(array(
				'output' 	    => 'boom',
				'allContacts' 	=> ''
			));
		}
    }
    public function get($logout)
    {
		header('Access-Control-Allow-Origin: *');
		
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');
		if(isset($data['c_name']) && $data['c_name']!=""){
			$contactBy = $data['c_name'];
		}else{
			$contactBy = '';
		}
		if(isset($data['c_email']) && $data['c_email']!=""){
			$contactEmail = $data['c_email'];
		}else{
			$contactEmail = '';
		}
		if(isset($data['c_phone']) && $data['c_phone']!=""){
			$contactPhone = $data['c_phone'];
		}else{
			$contactPhone = '';
		}
		if(isset($data['c_message']) && $data['c_message']!=""){
			$contactMessage = $data['c_message'];
		}else{
			$contactMessage = '';
		}
		$contactUsTable  = $this->getServiceLocator()->get('Models\Model\ContactUsFactory');
		$insertedContact = $contactUsTable->inserContact($data);
		$msg = '';
		$msg .= '<body>';
		$msg .='<table width="600" border="0" cellspacing="0" cellpadding="0">';
		$msg .='<tr>';
		$msg .='<td><table width="600" border="0" cellspacing="0" cellpadding="5" style="border:1px solid #178acc ">';
		$msg .='<tr><td bgcolor="#178acc ">';
		$msg .='<a href="Javascript:void(0);" target="_blank" style="text-decoration: none;">';
		$msg .='<span style="color:#fff; font:normal 30px arial">UTS Team</span></a></td>';
		$msg .='</tr>';
		$msg .='<tr>';
		$msg .='<td>';
		$msg .='<table width="100%" border="0" cellspacing="0" cellpadding="10" align="left">';
		$msg .='<tr><td><a href="javascript:void(0);" style="color:#4ca4b6 ; font:bold 12px arial; text-decoration:none;">
		Dear&nbsp Team</a></td></tr>';
		$msg .='<tr><td>Your Login Credentials.</td></tr>';						
		$msg .='<tr><td>Contact Name : '.$contactBy.'</td></tr>';						
		$msg .='<tr><td>Contact Email : '.$contactEmail.'</td></tr>';						
		$msg .='<tr><td>Mobile Number : '.$contactPhone.'</td></tr>';						
		$msg .='<tr><td>Query : '.$contactMessage.'</td></tr>';						
		$msg .='<tr><td>&nbsp;</td></tr>';
		$msg .='<tr><td>Sincerely,</td></tr>';
		$msg .='<tr><td>UTS Team</td></tr>';
		$msg .='</table>';
		$msg .='</td>';
		$msg .='</tr>';  
		$msg .='</table></td>';
		$msg .='</tr>'; 
		$msg .='</table>';
		$msg .='<br/><br/>';
		$msg .='Regards,<br/>';
		$msg .='UTSTeam';
		$msg .='</body>';
		$subj ='Reach some us.';
		$to = 'dileepkumarkonda@gmail.com';
		//mail($to,$subj,$msg);
		return new JsonModel(array(
			'output'    =>'Request Sent',
			'success'	=>'Request has been successfully sent.'
		));
    }
    public function update($id, $data)
    {
        
    }
    public function delete($id)
    {
       
    }
}