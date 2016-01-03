<?php
namespace AdminApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class SynopsysApiController extends AbstractRestfulController
{
    public function getList()
    {
		header('Access-Control-Allow-Origin: *');
	}
    public function get($id)
    {	
		header('Access-Control-Allow-Origin: *');
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$synopsysTable =$this->getServiceLocator()->get('Models\Model\SynopsysFactory');
			$getUploads = $synopsysTable->getSynopsys($id);
			if($getUploads!=""){
				$curYear = date("Y");
				$filePath = "/synopsys/".$id."/".$curYear;
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
		// if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$u_id = $_POST['uid'];
			$synopsys_title ="";
			if(isset($_POST['synopsys_title']) && $_POST['synopsys_title']!=""){
				$synopsys_title = $_POST['synopsys_title'];
			}
			$curYear = date("Y");
			$path = "./synopsys/".$u_id."/".$curYear;	
			if(isset($_FILES) && $_FILES['file']!=""){
				$pathN = '/synopsys/'.$u_id.'/'.$curYear.'/'.$_FILES['file']['name'];				
				if(!is_dir($path)) mkdir($path,0777, true);
				if(file_exists($pathN)) unlink($pathN);					
				 if( 0 < $_FILES['file']['error'] ) {
					$synopsys_file = '';
					$error = '0';
				}else {
					move_uploaded_file($_FILES['file']['tmp_name'], $path.'/'. $_FILES['file']['name']);
					$synopsys_file = $_FILES['file']['name'];
					$error = '1';
					$synopsysTable =$this->getServiceLocator()->get('Models\Model\SynopsysFactory');
					$getUploads = $synopsysTable->assignSynopsys($u_id,$synopsys_file,$synopsys_title);
				}
				return new JsonModel(array(
					'file_name' 	=> $synopsys_file,
					'error' 	=> $error,
				));
			}else{
				return new JsonModel(array(
					'file_name' 	=> '',
					'error' 	=> '0',
				));
			}
		// }else{
			// return new JsonModel(array(
				// 'file_name' 	=> '',
				// 'error' 	=> '0',
				// 'status' 	=> 'Logged Required',
			// ));
			
		// }			
    }
    public function update($u_id,$data)
    {
		
	}		
    public function delete($id)
    {
       
    }
}