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
class DependentTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function saveDependent($users){        
       if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
               $userId = $_SESSION['user_id'];
       }else{
               $userId = $userId;
       }	   
       $data = array(        
               'd_user_id' => $userId, 
               'first_name' => $users['first_name'], 
               'last_name' => $users['last_name'], 
               'dob'        => $users['dob'],
               'occupation' => $users['occupation'],
               'phone'        => $users['phone'],
               'address' => $users['address'],        
               'mail_id' => $users['mail_id'],
               'status'        =>        1,
       );        
       $data['added_at'] =        date('Y-m-d H:i:s');
       $data['updated_at'] =        date('Y-m-d H:i:s');
       $insertresult=$this->tableGateway->insert($data);        
       return $this->tableGateway->lastInsertValue;        
	}
	public function getData($id){
		$select = $this->tableGateway->getSql()->select();	
		$select->where('d_user_id= "'.$id.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function deleteDependent($dependentId){
		$row=$this->tableGateway->delete(array('(dependent_id IN ('.$dependentId.'))'));
		return $row;		
	}
	public function usersDelDependent($userId){
		$row=$this->tableGateway->delete(array('(d_user_id IN ('.$userId.'))'));
		return $row;		
	}
	public function requiredDependents(){
		$select = $this->tableGateway->getSql()->select();	
		$select->where('first_name= ""');
		$select->where('last_name= ""');
		$select->where('dob= ""');
		$select->where('occupation= ""');
		$select->where('phone= ""');
		$select->where('address= ""');
		$select->where('mail_id= ""');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet->count();		
	}
}