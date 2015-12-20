<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class UploadPdfsApiController extends AbstractRestfulController
{
    public function getList()
    {			
    }
    public function get($id)
    {	
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			header('Access-Control-Allow-Origin: *');
			$uploadPdfsTable =$this->getServiceLocator()->get('Models\Model\UploadPdfsFactory');
			$getUploads = $uploadPdfsTable->getUploadsData($id);
			if($getUploads!=""){
				$uid = $_SESSION['user_id'];
				$curYear = date("Y");
				$filePath = "/uploads/".$uid."/".$curYear;
				return new JsonModel(array(
					'file_path' 	=> $filePath,
					'data' 	  => $getUploads,
				));
			}else{
				return new JsonModel(array(
					'file_path' 	=> '',
					'data' 	=> 'No Data Found',
				));
			}
		}else{
			return new JsonModel(array(
				'file_name' 	=> '',
				'required' 	=> 'Login Is Required',
			));
		}
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$uid = $_SESSION['user_id'];
			$curYear = date("Y");
			$path = "./uploads/".$uid."/".$curYear;
			if(isset($_FILES)){
				if(!is_dir($path)) mkdir($path,0777, true);
				if( 0 < $_FILES['file']['error'] ) {
					$fileName = '';
					$error = '0';
				}else {
					move_uploaded_file($_FILES['file']['tmp_name'], $path.'/'. $_FILES['file']['name']);
					$fileName = $_FILES['file']['name'];
					$error = '1';
				}
				return new JsonModel(array(
					'file_name' 	=> $fileName,
					'error' 	=> $error,
				));
			}else{
				return new JsonModel(array(
					'file_name' 	=> '',
					'error' 	=> '0',
				));
			}
		}else{
			return new JsonModel(array(
				'file_name' 	=> '',
				'error' 	=> '0',
				'status' 	=> 'Logged Required',
			));
			
		}			
    }
    public function update($uid,$data)
    {
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$uid = $_SESSION['user_id'];
			$uploadPdfsTable =$this->getServiceLocator()->get('Models\Model\UploadPdfsFactory');
			$addedStatus = $uploadPdfsTable->addUploadPdf($uid,$data);
			if($addedStatus!=0){
				return new JsonModel(array(
					'status' 	=> 'Uploaded successfully',
					'error' 	=> '1',
				));
			}else{
				return new JsonModel(array(
					'status' 	=> 'Not yet',
					'error' 	=> '0',
				));
			}			
		}else{
			return new JsonModel(array(
				'error' 	=> '0',
				'status' 	=> 'Logged Required',
			));
			
		}
		
    }
    public function delete($id)
    {
       
    }
}