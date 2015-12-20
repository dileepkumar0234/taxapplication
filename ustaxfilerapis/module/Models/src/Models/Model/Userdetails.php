<?php
namespace Models\Model;
class Userdetails
{
	
	// Add the following method:
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

}