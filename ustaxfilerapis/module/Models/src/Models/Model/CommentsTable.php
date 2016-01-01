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
class CommentsTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function addComment($uid,$comment){        
        $data = array(        
               'cmt_user_id'  => $uid, 
               'comment'      => $comment, 
               'cmt_status'   => 1, 
               'cmt_created_at' => date('Y-m-d H:i:s')
       );   
	   $insertresult=$this->tableGateway->insert($data);        
       return $this->tableGateway->lastInsertValue;        
	}
	public function getComments($id){
		$select = $this->tableGateway->getSql()->select();
		$select->where('cmt_user_id= "'.$id.'"');
		$select->where('cmt_status= "1"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}	
}