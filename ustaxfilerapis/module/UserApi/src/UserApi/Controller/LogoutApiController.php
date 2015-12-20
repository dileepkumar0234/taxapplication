<?php
namespace UserApi\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;
class LogoutApiController extends AbstractRestfulController
{
    public function getList()
    {
		
    }
    public function get($logout)
    {
		header('Access-Control-Allow-Origin: *');
		unset($_SESSION);
		return new JsonModel(array(
			'output' 	=> 'Session Expried',
		));
    }
    public function create($data)
    {
		header('Access-Control-Allow-Origin: *');	
	
    }
    public function update($id, $data)
    {
        
    }
    public function delete($id)
    {
       
    }
}