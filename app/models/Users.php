<?php

use Phalcon\Mvc\Model;

class Users extends Model
{
	public $id;
	public $email;
	public $password;
	public $fname;
	public $lname;
	public $birth;
	public $address;
	public $city_id;
	public $phone;
	public $web;
	public $role;
	public $status;
	public $photo;
	
	/**
	* By default, the model “Users” or "AppUsers" will refer to the table “users” or "app_users".
	* If you want to manually specify another name for the mapping table, use the setSource() method.
	*/
	public function initialize()
    {
        $this->setSource("users");
		
		
		// Just the fields that changed are used in SQL statement, otherwise all of them.
		//$this->useDynamicUpdate(true);
		
		// Defines a 1-n relationship
		$this->hasMany(
			"id",
			"Education",
			"user_id"
		);
		
		$this->hasMany(
			"id",
			"Experience",
			"user_id"
		);
		
		// Defines a 1-1 relationship
		$this->hasOne(
			"id",
			"Skills",
			"user_id"
		);
		
		// Defines a n-1 relationship
		$this->belongsTo(
			"city_id",
			"Cities",
			"id"
		);
		
		$this->hasMany(
			"id",
			"Bookmarks",
			"employer_id"
		);
		
    }
	
	
	// First & last name must be set in order to publish CV
	public function beforeValidation()
	{
		if($this->status == "published")
			if(!$this->fname OR !$this->lname) {
				return false;
			}
	}
	
	// Triggers before insert or update operation
	public function validation()
	{		
		$this->fname = $this->fname ? ucfirst($this->fname) : null;
		$this->lname = $this->lname ? ucfirst($this->lname): null;
		$this->address = $this->address ? ucfirst($this->address) : null;
		$this->phone = $this->phone ? $this->phone : null;
		$this->web = $this->web ? $this->web : null;
		
		if($this->birth == "" or $this->birth == "0000-00-00") {
			$this->birth = null;
		} else {
			$date = new DateTime($this->birth);
			$this->birth = $date->format("Y-m-d");
		}
	}

	public function afterFetch()
    {
		if($this->birth) {
			$date = new DateTime($this->birth);
			$this->birth = $date->format("m/d/Y");
		}
		
    }
	
	
	
	
	// Get all student CVs that are published
	public function getStudents()
	{
		return Users::find(
			[
				"role = 'student' AND status = 'published'",
				"order" => "fname",
			]
		);
	}
}