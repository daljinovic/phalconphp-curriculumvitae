<?php

use Phalcon\Mvc\Model;

class ScienceDomains extends Model
{
	public $id;
	public $name;
	
	
	/**
	* By default, the model “Users” or "AppUsers" will refer to the table “users” or "app_users".
	* If you want to manually specify another name for the mapping table, use the setSource() method.
	*/
	public function initialize()
    {
        $this->setSource("science_domains");
		
		$this->hasMany(
			"id",
			"ScienceFields",
			"science_domain_id"
		);
    }
	
	
	
}