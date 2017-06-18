<?php

use Phalcon\Mvc\Model;

class experience extends Model
{
	public $id;
	public $institution_name;
	public $city;
	public $country;
	public $position;
	public $functions;
	public $duration_from;
	public $duration_to;
	public $user_id;
	
	
	/**
	* By default, the model “Users” or "AppUsers" will refer to the table “users” or "app_users".
	* If you want to manually specify another name for the mapping table, use the setSource() method.
	*/
	public function initialize()
    {
        $this->setSource("experience");
		
		$this->useDynamicUpdate(true);
		
		$this->belongsTo(
			"user_id",
			"Users",
			"id"
		);
    }
	
	
		
	// Triggers before insert or update operation
	public function validation()
	{	
		$this->institution_name = ucfirst($this->institution_name);		
		$this->city = ucfirst($this->city);
		$this->country = ucfirst($this->country);
		$this->position = ucfirst($this->position);
		$this->functions = $this->functions ? $this->functions : null;
		
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