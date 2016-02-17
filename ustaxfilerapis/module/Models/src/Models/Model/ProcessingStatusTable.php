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
class ProcessingStatusTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function saveProccessingStatus($uid)
    {		
		$data = array(
			'ps_user_id' 	  	       => $uid,				
			'ps_state' 		           => 0,  		
			'ps_added_at' 	           => date('Y-m-d H:i:s'),   
		);	
		$insertresult=$this->tableGateway->insert($data);	
		return $this->tableGateway->lastInsertValue;		
    }
	public function updateProcess($uid,$st)
    {	
		if(isset($st) && $st!=""){
			
			$st = $st;
		}else{
			$st = 0;
		}
		$data = array(
			'ps_state' 		           => $st,  		
			'ps_updated_at'	  	       => date('Y-m-d H:i:s'), 	
		);	
		$updateuserid=$this->tableGateway->update($data, array('ps_user_id' => $uid));		
		return $updateuserid;		
    }
	public function getcntOfeach($state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->where('processing_status.ps_state="'.$state.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet->count();		
	}
	public function getToassignedData($state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('user', new Expression('processing_status.ps_user_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('assign_user_list', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join(array('u' => 'user'), 'assign_user_list.unlists_u_id=u.user_id',array('unlist_id' =>new Expression('u.user_id'),'unlist_name' =>new Expression('u.user_name'),'unlist_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('unlist_phone' =>new Expression('ud.phone')),'left');		
		$select->where('processing_status.ps_state="'.$state.'"');
		$select->group('user.user_id');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getBaseInfoData($state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('user', new Expression('processing_status.ps_user_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('spouse', new Expression('spouse.s_user_id=user.user_id'),array('*'),'left');
		$select->join('dependent', new Expression('dependent.d_user_id=user.user_id'),array('*'),'left');
		$select->join('assign_user_list', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join(array('u' => 'user'), 'assign_user_list.unlists_u_id=u.user_id',array('unlist_id' =>new Expression('u.user_id'),'unlist_name' =>new Expression('u.user_name'),'unlist_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('unlist_phone' =>new Expression('ud.phone')),'left');		
		$select->where('processing_status.ps_state="'.$state.'"');
		$select->group('user.user_id');
		$select->order('processing_status.ps_updated_at DESC');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getScheduleData($state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('user', new Expression('processing_status.ps_user_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('schedules_timings', new Expression('schedules_timings.sc_user_id=user.user_id'),array('*'),'left');
		$select->join('assign_user_list', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join(array('u' => 'user'), 'assign_user_list.unlists_u_id=u.user_id',array('unlist_id' =>new Expression('u.user_id'),'unlist_name' =>new Expression('u.user_name'),'unlist_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('unlist_phone' =>new Expression('ud.phone')),'left');		
		$select->where('processing_status.ps_state="'.$state.'"');
		$select->group('user.user_id');
		$select->order('processing_status.ps_updated_at DESC');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getInterviewData($state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('user', new Expression('processing_status.ps_user_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('assign_user_list', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join(array('u' => 'user'), 'assign_user_list.unlists_u_id=u.user_id',array('unlist_id' =>new Expression('u.user_id'),'unlist_name' =>new Expression('u.user_name'),'unlist_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('unlist_phone' =>new Expression('ud.phone')),'left');		
		$select->where('processing_status.ps_state="'.$state.'"');
		$select->group('user.user_id');
		$select->order('processing_status.ps_updated_at DESC');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getDocsData($state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('user', new Expression('processing_status.ps_user_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('upload_pdfs', new Expression('upload_pdfs.up_user_id=user.user_id'),array('*'),'left');
		$select->join('assign_user_list', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join(array('u' => 'user'), 'assign_user_list.unlists_u_id=u.user_id',array('unlist_id' =>new Expression('u.user_id'),'unlist_name' =>new Expression('u.user_name'),'unlist_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('unlist_phone' =>new Expression('ud.phone')),'left');		
		$select->where('processing_status.ps_state="'.$state.'"');
		$select->group('user.user_id');
		$select->order('processing_status.ps_updated_at DESC');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getOtherDocsData($state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('user', new Expression('processing_status.ps_user_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('upload_pdfs', new Expression('upload_pdfs.up_user_id=user.user_id'),array('*'),'left');
		$select->join('assign_user_list', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join(array('u' => 'user'), 'assign_user_list.unlists_u_id=u.user_id',array('unlist_id' =>new Expression('u.user_id'),'unlist_name' =>new Expression('u.user_name'),'unlist_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('unlist_phone' =>new Expression('ud.phone')),'left');		
		$select->where('processing_status.ps_state="'.$state.'"');
		$select->group('user.user_id');
		$select->order('processing_status.ps_updated_at DESC');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getPreparationData($state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('user', new Expression('processing_status.ps_user_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('assign_user_list', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join(array('u' => 'user'), 'assign_user_list.unlists_u_id=u.user_id',array('unlist_id' =>new Expression('u.user_id'),'unlist_name' =>new Expression('u.user_name'),'unlist_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('unlist_phone' =>new Expression('ud.phone')),'left');		
		$select->where('processing_status.ps_state="'.$state.'"');
		$select->group('user.user_id');
		$select->order('processing_status.ps_updated_at DESC');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getSynopsisData($state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('user', new Expression('processing_status.ps_user_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('synopsys', new Expression('synopsys.synopsys_user_id=user.user_id'),array('*'),'left');
		$select->join('assign_user_list', new Expression('assign_user_list.client_id=processing_status.ps_user_id'),array('*'),'left');
		$select->join(array('u' => 'user'), 'assign_user_list.unlists_u_id=u.user_id',array('unlist_id' =>new Expression('u.user_id'),'unlist_name' =>new Expression('u.user_name'),'unlist_email' =>new Expression('u.email')),'left');
		$select->join(array('ud' => 'user_details'), new Expression('ud.u_user_id=u.user_id'),array('unlist_phone' =>new Expression('ud.phone')),'left');		
		$select->where('processing_status.ps_state="'.$state.'"');
		$select->group('user.user_id');
		$select->order('processing_status.ps_updated_at DESC');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
	public function getPaymentData($state)
    {	
		$select = $this->tableGateway->getSql()->select();
		$select->join('user', new Expression('processing_status.ps_user_id=user.user_id'),array('*'),'left');
		$select->join('user_details', new Expression('user_details.u_user_id=user.user_id'),array('*'),'left');
		$select->join('payments', new Expression('payments.p_user_id=user.user_id'),array('*'),'left');		
		$select->group('user.user_id');
		$select->order('processing_status.ps_updated_at DESC');
		$select->where('processing_status.ps_state="'.$state.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;		
	}
}