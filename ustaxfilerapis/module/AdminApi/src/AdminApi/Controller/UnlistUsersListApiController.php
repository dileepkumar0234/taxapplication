<?php
namespace AdminApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class UnlistUsersListApiController extends AbstractRestfulController
{
    public function getList()
    {	
		
	}
    public function get($userData)
    {	
		header('Access-Control-Allow-Origin: *');
		$data = explode('-',$userData);
		$unlistid = $data['0'];
		$id = $data['1'];
		$assignUserListTable =$this->getServiceLocator()->get('Models\Model\AssignUserListFactory');
		$getData =array();
		if($id=='0'){
			$getData = $assignUserListTable->getToassignedData($unlistid,$id);
		}else if($id=='1'){
			$getData = $assignUserListTable->getBaseInfoData($unlistid,$id);
		}else if($id=='2'){
			$getData = $assignUserListTable->getScheduleData($unlistid,$id);
		}else if($id=='3'){
			$getData = $assignUserListTable->getInterviewData($unlistid,$id);
		}else if($id=='4'){
			$getData = $assignUserListTable->getDocsData($unlistid,$id);
		}else if($id=='5'){
			$getData = $assignUserListTable->getOtherDocsData($unlistid,$id);
		}else if($id=='6'){
			$getData = $assignUserListTable->getPreparationData($unlistid,$id);
		}
		// else if($id=='7'){
			// $getData = $processStatusTable->getSynopsisData($id);
		// }else if($id=='8'){
			// $getData = $processStatusTable->getPaymentData($id);
		// }
		$list =array();
		if(count($getData)>0){
			foreach($getData as $users){
				$list[]=$users;				
			}
			return new JsonModel(array(
				'value'  => 1,
				'output'   => 'success',
				'list' 	 => $list
			));
		}else{
			return new JsonModel(array(
				'value' 	=> 0,
				'output' 	=> 'boom',
				'list' 	   => '',
			));
		}
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');
			
    }
    public function update($uid,$data)
    {
				
    }
    public function delete($id)
    {
       
    }
}