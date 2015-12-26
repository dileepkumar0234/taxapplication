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
class ContactUsTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function inserContact($contact){ 
		if(isset($contact['c_name']) && $contact['c_name']!=""){
			$contactBy = $contact['c_name'];
		}else{
			$contactBy = '';
		}
		if(isset($contact['c_email']) && $contact['c_email']!=""){
			$contactEmail = $contact['c_email'];
		}else{
			$contactEmail = '';
		}
		if(isset($contact['c_phone']) && $contact['c_phone']!=""){
			$contactPhone = $contact['c_phone'];
		}else{
			$contactPhone = '';
		}
		if(isset($contact['c_message']) && $contact['c_message']!=""){
			$contactMessage = $contact['c_message'];
		}else{
			$contactMessage = '';
		}
        $data = array(        
               'c_name'        => $contactBy, 
               'c_email'       => $contactEmail, 
               'c_phone'       => $contactPhone, 
               'c_message'     => $contactMessage,
               'c_created_at'  => date('Y-m-d H:i:s')
       );   
	   $insertresult=$this->tableGateway->insert($data);        
       return $this->tableGateway->lastInsertValue;        
	}
	public function allContacts(){        
        $select = $this->tableGateway->getSql()->select();	
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;    
	}
}