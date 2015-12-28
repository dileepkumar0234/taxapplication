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
class AssignUserListTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function assignUser($users){        
        $data = array(        
               'unlists_u_id' => $users['unlists_u_id'], 
               'client_id'    => $users['client_id'], 
               'as_status'    => 1, 
               'as_crated_at' => date('Y-m-d H:i:s')
       );   
	   $insertresult=$this->tableGateway->insert($data);        
       return $this->tableGateway->lastInsertValue;        
	}
	public function userAssignedAlready($uid){
		$select = $this->tableGateway->getSql()->select();
		$select->where('client_id= "'.$uid.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet->count();			
	}
	public function getData($id){
		$select = $this->tableGateway->getSql()->select();
		$select->join('user', new Expression('assign_user_list.client_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		// $select->join(array('s' => 'assign_user_list','u' => 'user'), 's.client_id=u.user_id',array('client_id' =>new Expression('u.user_id'),'client_name' =>new Expression('u.user_name'),'client_email' =>new Expression('u.email')),'left');
		// $select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('client_phone' =>new Expression('ud.phone')),'left');		
		$select->where('assign_user_list.unlists_u_id= "'.$id.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getUnlistUserCount($id){
		$select = $this->tableGateway->getSql()->select();
		$select->where('assign_user_list.unlists_u_id= "'.$id.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet->count();		
	}
	public function getcntOfeach($state,$id)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('processing_status', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->where('assign_user_list.unlists_u_id= "'.$id.'"');
		$select->where('processing_status.ps_state="'.$state.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet->count();		
	}
	public function getToassignedData($uid,$state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('processing_status', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join('user', new Expression('assign_user_list.client_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join(array('s' => 'assign_user_list'), 's.unlists_u_id=user.user_id',array('client_id' =>new Expression('user.user_id'),'client_name' =>new Expression('user.user_name'),'client_email' =>new Expression('user.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=user.user_id'),array('client_phone' =>new Expression('ud.phone')),'left');		
		$select->where('assign_user_list.unlists_u_id= "'.$uid.'"');
		$select->where('processing_status.ps_state="'.$state.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		echo "<pre>";print_r($resultSet);exit;
		return $resultSet;		
	}
	public function getBaseInfoData($uid,$state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('processing_status', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join('user', new Expression('assign_user_list.client_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('spouse', new Expression('spouse.s_user_id=user.user_id'),array('*'),'left');
		$select->join('dependent', new Expression('dependent.d_user_id=user.user_id'),array('*'),'left');
		$select->join(array('s' => 'assign_user_list','u' => 'user'), 's.client_id=u.user_id',array('client_id' =>new Expression('u.user_id'),'client_name' =>new Expression('u.user_name'),'client_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('client_phone' =>new Expression('ud.phone')),'left');		
		$select->where('assign_user_list.unlists_u_id= "'.$uid.'"');
		$select->where('processing_status.ps_state="'.$state.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getScheduleData($uid,$state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('processing_status', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join('user', new Expression('assign_user_list.client_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('schedules_timings', new Expression('schedules_timings.sc_user_id=user.user_id'),array('*'),'left');
		$select->join(array('s' => 'assign_user_list','u' => 'user'), 's.client_id=u.user_id',array('client_id' =>new Expression('u.user_id'),'client_name' =>new Expression('u.user_name'),'client_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('client_phone' =>new Expression('ud.phone')),'left');		
		$select->where('assign_user_list.unlists_u_id= "'.$uid.'"');
		$select->where('processing_status.ps_state="'.$state.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getDocsData($uid,$state)
	{	
		$select = $this->tableGateway->getSql()->select();
		$select->join('processing_status', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join('user', new Expression('assign_user_list.client_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('upload_pdfs', new Expression('upload_pdfs.up_user_id=user.user_id'),array('*'),'left');
		$select->join(array('s' => 'assign_user_list','u' => 'user'), 's.client_id=u.user_id',array('client_id' =>new Expression('u.user_id'),'client_name' =>new Expression('u.user_name'),'client_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('client_phone' =>new Expression('ud.phone')),'left');		
		$select->where('assign_user_list.unlists_u_id= "'.$uid.'"');
		$select->where('processing_status.ps_state="'.$state.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getOtherDocsData($uid,$state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('processing_status', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join('user', new Expression('assign_user_list.client_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('upload_pdfs', new Expression('upload_pdfs.up_user_id=user.user_id'),array('*'),'left');
		$select->join(array('s' => 'assign_user_list','u' => 'user'), 's.client_id=u.user_id',array('client_id' =>new Expression('u.user_id'),'client_name' =>new Expression('u.user_name'),'client_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('client_phone' =>new Expression('ud.phone')),'left');		
		$select->where('assign_user_list.unlists_u_id= "'.$uid.'"');
		$select->where('processing_status.ps_state="'.$state.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getInterviewData($uid,$state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('processing_status', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join('user', new Expression('assign_user_list.client_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join(array('s' => 'assign_user_list','u' => 'user'), 's.client_id=u.user_id',array('client_id' =>new Expression('u.user_id'),'client_name' =>new Expression('u.user_name'),'client_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('client_phone' =>new Expression('ud.phone')),'left');		
		$select->where('assign_user_list.unlists_u_id= "'.$uid.'"');
		$select->where('processing_status.ps_state="'.$state.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getPreparationData($uid,$state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('processing_status', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join('user', new Expression('assign_user_list.client_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join(array('s' => 'assign_user_list','u' => 'user'), 's.client_id=u.user_id',array('client_id' =>new Expression('u.user_id'),'client_name' =>new Expression('u.user_name'),'client_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('client_phone' =>new Expression('ud.phone')),'left');		
		$select->where('assign_user_list.unlists_u_id= "'.$uid.'"');
		$select->where('processing_status.ps_state="'.$state.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
}