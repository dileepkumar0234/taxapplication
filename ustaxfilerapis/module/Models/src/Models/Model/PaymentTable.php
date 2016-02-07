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
class PaymentTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function addPayment($payment)
    {		
		if(isset($payment['p_user_id']) && $payment['p_user_id']!=""){
			$p_user_id = $payment['p_user_id'];			
		}else{
			$p_user_id = 0;			
		}
		if(isset($payment['amount']) && $payment['amount']!=""){
			$amount = $payment['amount'];			
		}else{
			$amount = '';			
		}
		if(isset($payment['txnt_id']) && $payment['txnt_id']!=""){
			$txnt_id = $payment['txnt_id'];			
		}else{
			$txnt_id = '';			
		}
		if(isset($payment['payment_status']) && $payment['payment_status']!=""){
			$payment_status = $payment['payment_status'];			
		}else{
			$payment_status = 1;			
		}
		$data = array(
			'p_user_id' 	  	       => $p_user_id,				
			'amount' 		           => $amount,  		
			'txnt_id' 		           => $txnt_id,  		
			'payment_status' 		   => $payment_status,  		
			'created_at' 	           => date('Y-m-d H:i:s'),   
		);	
		$insertresult=$this->tableGateway->insert($data);	
		return $this->tableGateway->lastInsertValue;		
    }
	public function getPayment($uid){
		$select = $this->tableGateway->getSql()->select();
		$select->where('p_user_id= "'.$uid.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;			
	}
}