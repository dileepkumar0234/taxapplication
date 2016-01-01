<?php
namespace AdminApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class CommentsApiController extends AbstractRestfulController
{
    public function getList()
    {
		header('Access-Control-Allow-Origin: *');
	}
    public function get($id)
    {	
		header('Access-Control-Allow-Origin: *');
		$commentsTable = $this->getServiceLocator()->get('Models\Model\CommentsFactory');
		$getComment = $commentsTable->getComments($id);
		$cmmts = '';
		if(count($getComment)>0){
			foreach($getComment as $comments){
				$cmmts[] = $comments;
			}
			if($cmmts!=""){
				return new JsonModel(array(
					'output' 	=> 'success',
					'data' 	=> $cmmts,
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
    public function create($status)
    {
		header('Access-Control-Allow-Origin: *');		
    }
    public function update($uid,$status)
    {
		header('Access-Control-Allow-Origin: *');
	}		
    public function delete($id)
    {
       
    }
}