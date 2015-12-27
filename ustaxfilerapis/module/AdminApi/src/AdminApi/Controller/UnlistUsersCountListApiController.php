<?php
namespace AdminApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class UnlistUsersCountListApiController extends AbstractRestfulController
{
    public function getList()
    {	
		
	}
    public function get($id)
    {	
		header('Access-Control-Allow-Origin: *');
		$assignUserListTable =$this->getServiceLocator()->get('Models\Model\AssignUserListFactory');
		$toBeAssignedCnt  = $assignUserListTable->getcntOfeach('0',$id);
		$basisinfoCnt  = $assignUserListTable->getcntOfeach('1',$id);
		$Schedulingcnt = $assignUserListTable->getcntOfeach('2',$id);
		$interviewCnt = $assignUserListTable->getcntOfeach('3',$id);
		$docsCnt = $assignUserListTable->getcntOfeach('4',$id);
		$otherDocsCnt = $assignUserListTable->getcntOfeach('5',$id);
		$preparationCnt = $assignUserListTable->getcntOfeach('6',$id);
		$synopsisCnt = $assignUserListTable->getcntOfeach('7',$id);
		$paymentCnt = $assignUserListTable->getcntOfeach('8',$id);
		$reviewCnt = $assignUserListTable->getcntOfeach('9',$id);
		$confirmationCnt = $assignUserListTable->getcntOfeach('10',$id);
		$filing = $assignUserListTable->getcntOfeach('11',$id);
		$eFiling = $assignUserListTable->getcntOfeach('12',$id);
		$peFiling = $assignUserListTable->getcntOfeach('13',$id);
		if(isset($toBeAssignedCnt) && $toBeAssignedCnt>0){
			$toBeAssignedCnt = $toBeAssignedCnt;
		}else{
			$toBeAssignedCnt = 0;
		}
		if(isset($basisinfoCnt) && $basisinfoCnt>0){
			$basisinfoCnt = $basisinfoCnt;
		}else{
			$basisinfoCnt = 0;
		}
		if(isset($Schedulingcnt) && $Schedulingcnt>0){
			$Schedulingcnt = $Schedulingcnt;
		}else{
			$Schedulingcnt = 0;
		}
		if(isset($interviewCnt) && $interviewCnt>0){
			$interviewCnt = $interviewCnt;
		}else{
			$interviewCnt = 0;
		}
		if(isset($docsCnt) && $docsCnt>0){
			$docsCnt = $docsCnt;
		}else{
			$docsCnt = 0;
		}
		if(isset($otherDocsCnt) && $otherDocsCnt>0){
			$otherDocsCnt = $otherDocsCnt;
		}else{
			$otherDocsCnt = 0;
		}
		if(isset($preparationCnt) && $preparationCnt>0){
			$preparationCnt = $preparationCnt;
		}else{
			$preparationCnt = 0;
		}
		if(isset($synopsisCnt) && $synopsisCnt>0){
			$synopsisCnt = $synopsisCnt;
		}else{
			$synopsisCnt = 0;
		}
		if(isset($paymentCnt) && $paymentCnt>0){
			$paymentCnt = $paymentCnt;
		}else{
			$paymentCnt = 0;
		}
		if(isset($reviewCnt) && $reviewCnt>0){
			$reviewCnt = $reviewCnt;
		}else{
			$reviewCnt = 0;
		}
		if(isset($filing) && $confirmationCnt>0){
			$confirmationCnt = $confirmationCnt;
		}else{
			$confirmationCnt = 0;
		}
		if(isset($filing) && $filing>0){
			$filing = $filing;
		}else{
			$filing = 0;
		}
		if(isset($efiling) && $efiling>0){
			$efiling = $efiling;
		}else{
			$efiling = 0;
		}if(isset($peFiling) && $peFiling>0){
			$peFiling = $peFiling;
		}else{
			$peFiling = 0;
		}
		return new JsonModel(array(
			'toBeAssignedCnt' 	 => $toBeAssignedCnt,
			'basisinfoCnt' 	 => $basisinfoCnt,
			'Schedulingcnt' 	 => $Schedulingcnt,
			'interviewCnt' 	 => $interviewCnt,
			'docsCnt' 	 => $docsCnt,
			'otherDocsCnt' 	 => $otherDocsCnt,
			'preparationCnt' 	 => $preparationCnt,
			'synopsisCnt' 	 => $synopsisCnt,
			'paymentCnt' 	 => $paymentCnt,
			'reviewCnt' 	 => $reviewCnt,
			'confirmationCnt' 	 => $confirmationCnt,
			'filing' 	 => $filing,
			'efiling' 	 => $efiling,
			'peFiling' 	 => $peFiling
		));
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');
			
    }
    public function update($uid,$data)
    {
				
    }
    public function delete($id)
    {
       
    }
}