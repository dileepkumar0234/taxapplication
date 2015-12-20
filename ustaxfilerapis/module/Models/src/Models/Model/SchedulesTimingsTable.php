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
class SchedulesTimingsTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function addScheduleTime($timeD,$uid)
    {
		$data = array(
			'sc_user_id' 	  	    => $uid, 	
			'schedule_dt' 		=> $timeD['schedule_dt'],  		
			'schedule_period' 	=> $timeD['schedule_period'],  		
			'status'		    => 1, 
			'created_at' 		=> date('Y-m-d H:i:s'), 				
		);
		$this->tableGateway->insert($data);	
		return $this->tableGateway->lastInsertValue;
    }
	public function getData($id){
		$select = $this->tableGateway->getSql()->select();	
		$select->where('sc_user_id= "'.$id.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet->current();		
	}
}