<?php

use Phalcon\Mvc\Model;

class ScienceFields extends Model
{
	public $id;
	public $name;
	public $science_domain_id;
	
	/**
	* By default, the model “Users” or "AppUsers" will refer to the table “users” or "app_users".
	* If you want to manually specify another name for the mapping table, use the setSource() method.
	*/
	public function initialize()
    {
        $this->setSource("science_fields");
		
		#$this->hasOne(
		$this->hasMany(
			"id",
			"Education",
			"science_fields_id"
		);
		
		$this->belongsTo(
			"science_domain_id",
			"ScienceDomains",
			"id"
		);
    }
	
	
	
}