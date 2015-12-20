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
class UserdetailsTable
{
    protected $tableGateway;
	protected $select;
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
		$this->select = new Select();
    }
	public function saveUserDetails($users,$userId)
    {
		if(isset($users['inputFirstname']) && $users['inputFirstname']!=''){
			$firstName = $users['inputFirstname'];
		}else{
			$firstName = '';
		}
		if(isset($users['inputLastname']) && $users['inputLastname']!=''){
			$lastName = $users['inputLastname'];
		}else{
			$lastName ='';
		}
		if(isset($users['occupation']) && $users['occupation']!=''){
			$occupation = $users['occupation'];
		}else{
			$occupation ='';
		}
		if(isset($users['dob']) && $users['dob']!=''){
			$dob = $users['dob'];
		}else{
			$dob ='';
		}
		if(isset($users['city_name']) && $users['city_name']!=''){
			$city_name = $users['city_name'];
		}else{
			$city_name ='';
		}
		if(isset($users['state_name']) && $users['state_name']!=''){
			$state_name = $users['state_name'];
		}else{
			$state_name ='';
		}
		if(isset($users['addr']) && $users['addr']!=''){
			$addr = $users['addr'];
		}else{
			$addr ='';
		}
		if(isset($users['apt_no']) && $users['apt_no']!=''){
			$apt_no = $users['apt_no'];
		}else{
			$apt_no ='';
		}
		if(isset($users['inputTelephone']) && $users['inputTelephone']!=''){
			$inputTelephone = $users['inputTelephone'];
		}else{
			$inputTelephone ='';
		}
		$data = array(		
			'u_user_id'         => 	$userId,  		
			'first_name'        => 	$firstName,  		
			'last_name'         => 	$lastName,  		
			'occupation'        => 	$occupation,  		
			'dob'               => 	$dob,  		
			'city_name'         => 	$city_name,		
			'state_name'        => 	$state_name,	  	
			'address' 	       	=> 	$addr,	
			'apt_no' 	       	=> 	$apt_no,			
			'phone'	      	 	=> 	$inputTelephone,	  	
			'status'			=>	1,
			'date_added'		=>	date('Y-m-d H:i:s'), 
			'date_updated'		=>	date('Y-m-d H:i:s'), 	
		);	
		$insertresult=$this->tableGateway->insert($data);	
		return $this->tableGateway->lastInsertValue;		
    }
	public function updateDependent($users,$userId){
		if(isset($users['user_name']) && $users['user_name']!=''){
			$firstName = $users['user_name'];
		}else{
			$firstName = '';
		}
		if(isset($users['inputLastname']) && $users['inputLastname']!=''){
			$lastName = $users['inputLastname'];
		}else{
			$lastName ='';
		}
		if(isset($users['occupation']) && $users['occupation']!=''){
			$occupation = $users['occupation'];
		}else{
			$occupation ='';
		}
		if(isset($users['dob']) && $users['dob']!=''){
			$dob = $users['dob'];
		}else{
			$dob ='';
		}
		if(isset($users['addr']) && $users['addr']!=''){
			$addr = $users['addr'];
		}else{
			$addr ='';
		}
		if(isset($users['inputTelephone']) && $users['inputTelephone']!=''){
			$inputTelephone = $users['inputTelephone'];
		}else{
			$inputTelephone ='';
		}
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$userId = $_SESSION['user_id'];
		}else{
			$userId = $userId;
		}
		$data = array(		 		
			'user_id'          	=> 	$userId,  		
			'first_name'        => 	$firstName,  		
			'last_name'         => 	$lastName,  
			'dob'	      	 	=> 	$dob,
			'occupation' 	    => 	$occupation,
			'phone'	      	 	=> 	$inputTelephone,
			'address' 	       	=> 	$addr,	
			'status'			=>	1,
			'date_updated'		=>	date('Y-m-d H:i:s'),  	
		);	
		
		$updateorderid=$this->tableGateway->update($data, array('user_id' => $userId));
		return $updateorderid;
		
	}
	public function updateSpouse($users,$userId){
		if(isset($users['user_name']) && $users['user_name']!=''){
			$firstName = $users['user_name'];
		}else{
			$firstName = '';
		}
		if(isset($users['inputLastname']) && $users['inputLastname']!=''){
			$lastName = $users['inputLastname'];
		}else{
			$lastName ='';
		}
		if(isset($users['occupation']) && $users['occupation']!=''){
			$occupation = $users['occupation'];
		}else{
			$occupation ='';
		}
		if(isset($users['dob']) && $users['dob']!=''){
			$dob = $users['dob'];
		}else{
			$dob ='';
		}
		if(isset($users['inputTelephone']) && $users['inputTelephone']!=''){
			$inputTelephone = $users['inputTelephone'];
		}else{
			$inputTelephone ='';
		}
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$userId = $_SESSION['user_id'];
		}else{
			$userId = $userId;
		}
		$data = array(		 		
			'user_id'          	=> 	$userId,  		
			'first_name'        => 	$firstName,  		
			'last_name'         => 	$lastName,  
			'occupation' 	    => 	$occupation,			
			'dob'	      	 	=> 	$dob,
			'phone'	      	 	=> 	$inputTelephone,
			'status'			=>	1,
			'date_updated'		=>	date('Y-m-d H:i:s'),  	
		);	
		
		$updateorderid=$this->tableGateway->update($data, array('user_id' => $userId));
		return $updateorderid;
		
	}
	public function updateTaxPayer($users,$userId){
		if(isset($users['user_name']) && $users['user_name']!=''){
			$user_name = $users['user_name'];
		}else{
			$user_name = '';
		}
		if(isset($users['inputLastname']) && $users['inputLastname']!=''){
			$lastName = $users['inputLastname'];
		}else{
			$lastName ='';
		}
		if(isset($users['occupation']) && $users['occupation']!=''){
			$occupation = $users['occupation'];
		}else{
			$occupation ='';
		}
		if(isset($users['dob']) && $users['dob']!=''){
			$dob = $users['dob'];
		}else{
			$dob ='';
		}
		if(isset($users['filling_status']) && $users['filling_status']!=''){
			$filling_status = $users['filling_status'];
		}else{
			$filling_status ='';
		}
		if(isset($users['dependent']) && $users['dependent']!=''){
			$dependent = $users['dependent'];
		}else{
			$dependent ='';
		}
		if(isset($users['addr']) && $users['addr']!=''){
			$addr = $users['addr'];
		}else{
			$addr ='';
		}
		if(isset($users['apt_no']) && $users['apt_no']!=''){
			$apt_no = $users['apt_no'];
		}else{
			$apt_no ='';
		}
		if(isset($users['inputTelephone']) && $users['inputTelephone']!=''){
			$inputTelephone = $users['inputTelephone'];
		}else{
			$inputTelephone ='';
		}
		if(isset($users['city_name']) && $users['city_name']!=''){
			$city_name = $users['city_name'];
		}else{
			$city_name ='';
		}
		if(isset($users['state_name']) && $users['state_name']!=''){
			$state_name = $users['state_name'];
		}else{
			$state_name ='';
		}
		if(isset($users['zipcode']) && $users['zipcode']!=''){
			$zipcode = $users['zipcode'];
		}else{
			$zipcode ='';
		}
		if(isset($users['work_phone']) && $users['work_phone']!=''){
			$work_phone = $users['work_phone'];
		}else{
			$work_phone ='';
		}
		if(isset($users['c_e']) && $users['c_e']!=''){
			$c_e = $users['c_e'];
		}else{
			$c_e ='';
		}
		if(isset($users['tax_id']) && $users['tax_id']!=''){
			$tax_id = $users['tax_id'];
		}else{
			$tax_id ='';
		}
		if(isset($users['cLocation']) && $users['cLocation']!=''){
			$cLocation = $users['cLocation'];
		}else{
			$cLocation ='';
		}
		$data = array(		 		
			'u_user_id'         => 	$userId,  		
			'first_name'        => 	$user_name,  		
			'last_name'         => 	$lastName,
			'dob'	      	 	=> 	$dob,
			'occupation' 	    => 	$occupation,
			'filling_status' 	=> 	$filling_status,	
			'dependent'	      	=> 	$dependent,			
			'address' 	       	=> 	$addr,	
			'apt_no' 	       	=> 	$apt_no,	
			'city_name'         => 	$city_name,		
			'state_name'        => 	$state_name,	  	
			'zip' 	       	    => 	$zipcode,			
			'phone'	      	 	=> 	$inputTelephone,
			'alterphone'	    => 	$work_phone,				
			'current_emp'	    => 	$c_e,
			'tax_id_type'	    => 	$tax_id,
			'c_location' 	    => 	$cLocation,
			'status'			=>	1,
			'date_updated'		=>	date('Y-m-d H:i:s'),  	
		);	
		
		$updateorderid=$this->tableGateway->update($data, array('u_user_id' => $userId));
		return $updateorderid;
		
	}
	public function getuserdetailesData($user_id)
    {
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=""){
			$userId = $_SESSION['user_id'];
		}else{
			$userId = $user_id;
		}
	    $select = $this->tableGateway->getSql()->select();	
		$select->where('user_id= "'.$user_id.'"');
		$resultSet = $this->tableGateway->selectWith($select);	
		return $resultSet;
	}
}