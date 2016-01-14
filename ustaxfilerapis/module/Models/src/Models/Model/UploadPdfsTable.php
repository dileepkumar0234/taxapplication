<?php
namespace Models\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Expression;
class UploadPdfsTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function addUploadPdf($uid,$fileName)
    {
		if(isset($fileName['hid_w_2']) && $fileName['hid_w_2']!=""){
			$hid_w_2 = $fileName['hid_w_2'];
			
		}else{
			$hid_w_2 ='';
		}
		if(isset($fileName['hid_p1099_int']) && $fileName['hid_p1099_int']!=""){
			$hid_p1099_int = $fileName['hid_p1099_int'];
			
		}else{
			$hid_p1099_int ='';
		}
		if(isset($fileName['hid_Hsa']) && $fileName['hid_Hsa']!=""){
			$hid_Hsa = $fileName['hid_Hsa'];
			
		}else{
			$hid_Hsa ='';
		}
		if(isset($fileName['hid_Ira']) && $fileName['hid_Ira']!=""){
			$hid_Ira = $fileName['hid_Ira'];
			
		}else{
			$hid_Ira ='';
		}
		if(isset($fileName['hid_health_card']) && $fileName['hid_health_card']!=""){
			$hid_health_card = $fileName['hid_health_card'];
			
		}else{
			$hid_health_card ='';
		}
		$curYear = date("Y");
		$data = array(
			'up_user_id' 	  	    => $uid, 	
			'w2pdf' 		    => $hid_w_2,  		
			'p1099Int' 		    => $hid_p1099_int,  		
			'hsa' 		        => $hid_Hsa,  		
			'ira' 		        => $hid_Ira,  		
			'healthcard' 		=> $hid_health_card,  		
			'current_year' 		=> $curYear,  		
			'status'		    => 1, 
			'created_at' 		=> date('Y-m-d H:i:s')				
		);
		$this->tableGateway->insert($data);	
		return $this->tableGateway->lastInsertValue;
    }
	public function requiredUploads(){
		$select = $this->tableGateway->getSql()->select();	
		$select->where('w2pdf= ""');
		$select->where('p1099Int= ""');
		$select->where('hsa= ""');
		$select->where('healthcard= ""');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet->current();		
	}
	public function getUploadsData($id){
		$select = $this->tableGateway->getSql()->select();	
		$select->where('up_user_id= "'.$id.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet->current();			
	}
	public function deleteUploads($up_user_id){
		$row=$this->tableGateway->delete(array('(up_user_id IN ('.$up_user_id.'))'));
		return $row;		
	}
}