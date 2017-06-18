<?php

use Phalcon\Mvc\Model;

class Skills extends Model
{
	public $user_id;
	public $language;
	public $language_other;
	public $communication;
	public $organization;
	public $business;
	public $skills_other;
	public $drivers_licence;
	
	
	/**
	* By default, the model “Users” or "AppUsers" will refer to the table “users” or "app_users".
	* If you want to manually specify another name for the mapping table, use the setSource() method.
	*/
	public function initialize()
    {
        $this->setSource("skills");
		
		$this->belongsTo(
			"user_id",
			"Users",
			"id"
		);
    }
	
	
	
	public function beforeSave()
	{
		if(!$this->language)
			$this->language = null;
		if(!$this->language_other)
			$this->language_other = null;
		if(!$this->communication)
			$this->communication = null;
		if(!$this->organization)
			$this->organization = null;
		if(!$this->business)
			$this->business = null;
		if(!$this->skills_other)
			$this->skills_other = null;
		
		// Convert the array into a string
		if($this->drivers_licence)
			$this->drivers_licence = join(",", $this->drivers_licence);
	}	
	
	
	public function afterFetch()
	{
		// Convert the string to an array
		$this->drivers_licence = explode(",", $this->drivers_licence);
		
	}
	
	public function afterSave()
    {
        // Convert the string to an array
        $this->drivers_licence = explode(",", $this->drivers_licence);
    }
	
}