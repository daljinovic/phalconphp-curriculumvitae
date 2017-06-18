<?php

use Phalcon\Mvc\Model;

class Education extends Model
{
	public $id;
	public $institution_name;
	public $study;
	public $city;
	public $country;
	public $title;
	public $science_field_id;
	public $duration_from;
	public $duration_to;
	public $user_id;
	
	/**
	* By default, the model “Users” or "AppUsers" will refer to the table “users” or "app_users".
	* If you want to manually specify another name for the mapping table, use the setSource() method.
	*/
	public function initialize()
    {
        $this->setSource("Education");
		$this->useDynamicUpdate(true);
		
		$this->belongsTo(
			"science_field_id",
			"ScienceFields",
			"id"
		);
		
		$this->belongsTo(
			"user_id",
			"Users",
			"id"
		);
    }
	
	
	
	// Do some manipulation before saving
	public function beforeSave()
	{
		$this->institution_name = ucfirst($this->institution_name);		
		$this->study = ucfirst($this->study);
		$this->city = ucfirst($this->city);
		$this->country = ucfirst($this->country);
		$this->title = $this->title ? ucfirst($this->title) : null;
	}
	
	// Triggers before insert or update operation
	public function validation()
	{
		// Only year is entered by user; make a suitable format(Y-M-D) for database storage 
		if (DateTime::createFromFormat('Y', $this->duration_from)) {
			$this->duration_from = $this->duration_from . '-01-01';
		} else {
			$date = new DateTime($this->duration_from);
			$this->duration_from = $date->format("Y-m-d");
		}
		
		if($this->duration_to == "" or $this->duration_to == "0000-00-00")
			$this->duration_to = null;
		else {
			if (DateTime::createFromFormat('Y', $this->duration_to)) {
				$this->duration_to = $this->duration_to . '-01-01';
			} else {
				$date = new DateTime($this->duration_to);
				$this->duration_to = $date->format("Y-m-d");
			}
		}
	}

	public function afterFetch()
    {
        $date = new DateTime($this->duration_from);
		$this->duration_from = $date->format("m/d/Y");
		
		if($this->duration_to)
		{
			$date = new DateTime($this->duration_to);
			$this->duration_to = $date->format("m/d/Y");
		}
    }	
	
}