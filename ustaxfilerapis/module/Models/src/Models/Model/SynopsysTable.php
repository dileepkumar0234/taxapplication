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
class SynopsysTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function assignSynopsys($uid,$synopsys_file,$synopsys_title){        
        $data = array(        
               'synopsys_user_id'    => $uid, 
               'synopsys_file'       => $synopsys_file, 
               'synopsys_title'       => $synopsys_title, 
               'synopsys_status'     => 1, 
               'synopsys_created_at' => date('Y-m-d H:i:s')
       );   
	   $insertresult=$this->tableGateway->insert($data);        
       return $this->tableGateway->lastInsertValue;        
	}
	public function getSynopsys($uid){
		$select = $this->tableGateway->getSql()->select();
		$select->where('synopsys_user_id= "'.$uid.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;			
	}
}