<?php

use Phalcon\Mvc\Model;

class Bookmarks extends Model
{
	public $id;
	public $employer_id;
	public $student_id;
	
	
	public function initialize()
    {
        $this->setSource("employer_bookmarks");
		
		// Both related records are Users therefore we need aliasing
		// Get those records by calling bookmark->employer or bookmark->student
		$this->belongsTo(
			"employer_id",
			"Users",
			"id",
			[
                "alias" => "Employer",
            ]
		);
		
		$this->belongsTo(
			"student_id",
			"Users",
			"id",
			[
                "alias" => "Student",
            ]
		);
	}
	
	
	
	
	/**
    * This method returns specific bookmark
    */
	public function getOneBookmark($eid, $sid)
	{		
		$bookmark = Bookmarks::findFirst([
			"employer_id = :eid: AND student_id = :sid:",
			"bind" => [
				"eid" => $eid,
				"sid" => $sid,
			]
		]);
		
		return $bookmark;				
	}
	
}