<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class EmployerRoutes extends RouterGroup
{
	public function initialize()
	{
		
		$this->setPrefix("/employer");		
		
		
		// Get all students
		$this->add(
			"/students",
			"Employer::listStudents"
		);

		$this->addGet(
			"/students/{page}",
			"Employer::listStudents"
		);

		// Search students
		$this->add(
			"/search",
			"Employer::searchStudents"
		);
		
		$this->addGet(
			"/search/{page}",
			"Employer::searchStudents"
		);	
		
		// Show specific student CV
		$this->addGet(
			"/student-cv/{sid}",
			"Employer::student_cv"
		);	
		
		// Bookmarks
		$this->addGet(
			"/bookmark/{sid}",
			"Employer::saveBookmark"
		);
		
		$this->addGet(
			"/bookmark/delete/{sid}",
			"Employer::deleteBookmark"
		);
		
		
		// Make CV pdf
		$this->addGet(
			"/student-cv/pdf/{sid}",
			"Employer::make_pdf"
		);
		
		
	}
	
}