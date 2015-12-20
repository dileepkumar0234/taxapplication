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
class ForgetpasswordTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function addForgetpwd($userid,$email,$token)
    {
		$data = array(
			'user_id' 	  	=> $userid, 	
			'email' 		=> $email,  		
			'token_id'		=> $token, 
			'status' 		=> 1, 				
		);
		$this->tableGateway->insert($data);	
		return $this->tableGateway->lastInsertValue;
    }
	public function getmailfromfgtpwd($email){
		$select = $this->tableGateway->getSql()->select()			
				->where('email= "'.$email.'"');					 
		$resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
	}
	public function gettoken($token){
		$select = $this->tableGateway->getSql()->select()			
				->where('token_id= "'.$token.'"');					 
		$resultSet = $this->tableGateway->selectWith($select);				
        return $resultSet;		
	}
	public function deletetoken($forget_id){
		$this->tableGateway->delete(array('forget_pwd_id' => $forget_id));			
        return $this->tableGateway->lastInsertValue;	
	}
}