<?php
namespace AdminApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class BasicInfoApiController extends AbstractRestfulController
{
    public function getList()
    {

		header('Access-Control-Allow-Origin: *');
		$processStatusTable = $this->getServiceLocator()->get('Models\Model\ProcessingStatusFactory');
		$toBeAssignedCnt  = $processStatusTable->getcntOfeach('0');
		$basisinfoCnt  = $processStatusTable->getcntOfeach('1');
		$Schedulingcnt = $processStatusTable->getcntOfeach('2');
		$interviewCnt = $processStatusTable->getcntOfeach('3');
		$docsCnt = $processStatusTable->getcntOfeach('4');
		$otherDocsCnt = $processStatusTable->getcntOfeach('5');
		$preparationCnt = $processStatusTable->getcntOfeach('6');
		$synopsisCnt = $processStatusTable->getcntOfeach('7');
		$paymentCnt = $processStatusTable->getcntOfeach('8');
		$reviewCnt = $processStatusTable->getcntOfeach('9');
		$confirmationCnt = $processStatusTable->getcntOfeach('10');
		$filing = $processStatusTable->getcntOfeach('11');
		$eFiling = $processStatusTable->getcntOfeach('12');
		$peFiling = $processStatusTable->getcntOfeach('13');
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
			'value'  => 1,
			'output'   => 'success',
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
    public function get($id)
    {	
		header('Access-Control-Allow-Origin: *');
		$processStatusTable = $this->getServiceLocator()->get('Models\Model\ProcessingStatusFactory');
		$getData =array();
		if($id=='0'){
			$getData = $processStatusTable->getToassignedData($id);
		}else if($id=='1'){
			$getData = $processStatusTable->getBaseInfoData($id);
		}else if($id=='2'){
			$getData = $processStatusTable->getScheduleData($id);
		}else if($id=='3'){
			$getData = $processStatusTable->getInterviewData($id);
		}else if($id=='4'){
			$getData = $processStatusTable->getDocsData($id);
		}else if($id=='5'){
			$getData = $processStatusTable->getOtherDocsData($id);
		}else if($id=='6'){
			$getData = $processStatusTable->getPreparationData($id);
		}
		// else if($id=='7'){
			// $getData = $processStatusTable->getSynopsisData($id);
		// }else if($id=='8'){
			// $getData = $processStatusTable->getPaymentData($id);
		// }
		$list =array();
		if(count($getData)>0){
			foreach($getData as $users){
				$list[]=$users;				
			}
			return new JsonModel(array(
				'value'  => 1,
				'output'   => 'success',
				'list' 	 => $list
			));
		}else{
			return new JsonModel(array(
				'value' 	=> 0,
				'output' 	=> 'boom',
				'list' 	   => '',
			));
		}
    }
    public function create($status)
    {
		header('Access-Control-Allow-Origin: *');		
    }
    public function update($uid,$status)
    {
		header('Access-Control-Allow-Origin: *');
		$processStatusTable = $this->getServiceLocator()->get('Models\Model\ProcessingStatusFactory');
		$st = $status['ps_state'];
		$updateProcessStatus = $processStatusTable->updateProcess($uid,$st);
		if($updateProcessStatus>0){
			return new JsonModel(array(
				'output'   => 'success',
				'success'  => true
			));
		}else{
			return new JsonModel(array(
				'output'   => 'not success',
				'success'  => false
			));
		}
	}
		
    public function delete($id)
    {
       
    }
}