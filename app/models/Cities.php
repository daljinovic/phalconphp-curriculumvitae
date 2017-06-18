<?php

use Phalcon\Mvc\Model;

class Cities extends Model
{
	public $id;
	public $name;
	public $zip_code;
	public $country;
	
	
	/**
	* By default, the model “Users” or "AppUsers" will refer to the table “users” or "app_users".
	* If you want to manually specify another name for the mapping table, use the setSource() method.
	*/
	public function initialize()
    {
        $this->setSource("cities");
		
		$this->hasMany(
			"id",
			"Users",
			"city_id"
		);
    }
	
	
	public function validation()
	{
		if(!$this->name OR !$this->zip_code OR !$this->country)
			return false;
	}
	
	
	
}