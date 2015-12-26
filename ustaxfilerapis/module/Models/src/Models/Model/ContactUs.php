<?php
namespace Models\Model;
class ContactUs
{
	
	// Add the following method:
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

}