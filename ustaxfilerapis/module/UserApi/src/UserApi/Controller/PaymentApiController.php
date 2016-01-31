<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
class PaymentApiController extends AbstractRestfulController
{
    public function getList()
    {			
			
    }
    public function get($user_id)
    {			
		
    }
    public function create($paymentinfo)
    {
		header('Access-Control-Allow-Origin: *');
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){	
			$uid = $_SESSION['user_id'];
			$paymentTable=$this->getServiceLocator()->get('Models\Model\PaymentFactory');
			$addPaymentStatus = $paymentTable->addPayment($uid,$passwords['oldPwd']);
			if($addPaymentStatus!=0){
				return new JsonModel(array(
					'output' 	=> 'success',
					'status' 	=> 'Payment Successfully.',
				));
			}else{
				return new JsonModel(array(
					'output' 	=> 'boom',
					'status' 	=> 'Payment Pending',
				));	
			}
		}else{
			return new JsonModel(array(
				'output' 	=> 'loginFail',
				'login' 	=> 'Requried',
			));	
		}
    }
    public function update($uid,$passwords)
    {
		
    }
    public function delete($id)
    {
       
    }
}