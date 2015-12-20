<?php
namespace Models\Model;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Db\Sql\Predicate;
use Zend\Db\Sql\Expression;
class SpouseTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function saveSpouseData($users)
    {
		if(isset($users['first_name']) && $users['first_name']!=''){
			$firstName = $users['first_name'];
		}else{
			$firstName = '';
		}
		if(isset($users['last_name']) && $users['last_name']!=''){
			$lastName = $users['last_name'];
		}else{
			$lastName ='';
		}
		if(isset($users['occupation']) && $users['occupation']!=''){
			$occupation = $users['occupation'];
		}else{
			$occupation ='';
		}
		if(isset($users['dob']) && $users['dob']!=''){
			$dob = $users['dob'];
		}else{
			$dob ='';
		}
		if(isset($users['phone']) && $users['phone']!=''){
			$inputTelephone = $users['phone'];
		}else{
			$inputTelephone ='';
		}
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$userId = $_SESSION['user_id'];
		}else{
			$userId = $userId;
		}
		$data = array(		 		
			's_user_id'          	=> 	$userId,  		
			'first_name'        => 	$firstName,  		
			'last_name'         => 	$lastName,  
			'occupation' 	    => 	$occupation,			
			'dob'	      	 	=> 	$dob,
			'phone'	      	 	=> 	$inputTelephone,
			'status'			=>	1,			  	
		);
		if(isset($users['spouse_id']) && $users['spouse_id']!=""){
			$data['updated_at']  =	date('Y-m-d H:i:s');
			$updateorderid=$this->tableGateway->update($data, array('s_user_id' => $userId));
			return $updateorderid;
		}else{
			$data['added_at']  =	date('Y-m-d H:i:s');
			$insertresult=$this->tableGateway->insert($data);	
			return $this->tableGateway->lastInsertValue;
		}		
	}
	public function getData($id){
		$select = $this->tableGateway->getSql()->select();	
		$select->where('s_user_id= "'.$id.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet->current();		
	}
}