<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class SchedulesApiController extends AbstractRestfulController
{
    public function getList()
    {			
    }
    public function get($id)
    {		
		header('Access-Control-Allow-Origin: *');	
		$usId = $id;
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
			$userId = $_SESSION['user_id'];
			$userTable=$this->getServiceLocator()->get('Models\Model\UserFactory');
			$schedulesTimingsTable = $this->getServiceLocator()->get('Models\Model\SchedulesTimingsFactory');
			$getUserInfo = $userTable->getUserDataInfo($userId);
			$user_type_id = $getUserInfo->user_type_id;
			if($user_type_id==2){
				$getData = $schedulesTimingsTable->getData($usId);
				if($getData!=""){
					return new JsonModel(array(
						'output' 	=> 'success',
						'data' 	=> $getData
					));
				}else{
					return new JsonModel(array(
						'output' 	=> 'boom',
						'data' 	=> '',
					));
				}
			}else{
				$getData = $schedulesTimingsTable->getTotalData($usId);
				$getTotalData = '';
				if(count($getData)>0){
					foreach($getData as $userData){
						$getTotalData[]=$userData;
					}
					if($getTotalData!=""){
						return new JsonModel(array(
							'output' 	=> 'success',
							'data' 	=> $getTotalData
						));
					}else{
						return new JsonModel(array(
							'output' 	=> 'boom',
							'data' 	=> '',
						));
					}
				}else{
					return new JsonModel(array(
						'output' 	=> 'boom',
						'data' 	=> '',
					));
				}
			}
		}else{
			return new JsonModel(array(
				'output' 	=> 'success',
				'data' 	=> $getData
			));
		}		
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
			$usId = $_SESSION['user_id'];
			$schedulesTimingsTable = $this->getServiceLocator()->get('Models\Model\SchedulesTimingsFactory');
			$updateSchStatus = $schedulesTimingsTable->updateScheduleTime($usId);
			$insertedLastId = $schedulesTimingsTable->addScheduleTime($data,$usId);
			if($insertedLastId>=0){
				return new JsonModel(array(
					'value' 	=> 1,
					'output' 	=> 'success',
					'uid' 	    => $usId,
					'timing_id' => $insertedLastId
				));
			}else{
				return new JsonModel(array(
					'value' 	=> 0,
					'output' 	=> 'boom',
					'uid' 	=> '',
				));
			}
		}else{
			return new JsonModel(array(
				'value' 	=> 0,
				'output' 	=> 'boom',
				'uid' 	=> '',
			));
		}
		
    }
    public function update($timing_id,$data)
    {
		header('Access-Control-Allow-Origin: *');
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
			$usId = $_SESSION['user_id'];
			$schedulesTimingsTable = $this->getServiceLocator()->get('Models\Model\SchedulesTimingsFactory');
			$lastUpdated = $schedulesTimingsTable->updateScheduleTime($timing_id,$data);
			if($lastUpdated>=0){
				return new JsonModel(array(
					'output' 	=> 'success',
				));
			}else{
				return new JsonModel(array(
					'output' 	=> 'boom',
				));
			}
		}else{
			return new JsonModel(array(
				'output' 	=> 'boom',
			));
		}
		
    }
    public function delete($id)
    {
       
    }
}