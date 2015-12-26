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
		
		$schedulesTimingsTable = $this->getServiceLocator()->get('Models\Model\SchedulesTimingsFactory');
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
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
			$usId = $_SESSION['user_id'];
			$schedulesTimingsTable = $this->getServiceLocator()->get('Models\Model\SchedulesTimingsFactory');
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