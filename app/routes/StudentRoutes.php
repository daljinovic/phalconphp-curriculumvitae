<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class StudentRoutes extends RouterGroup
{
    public function initialize()
    {
		$this->setPrefix("/student");
		
		$this->add(
			"/mycv/publish",
			"StudentPersonal::publish"
		);
		
		
		// Personal form routes
		$this->add(
			"/mycv/personal",
			"StudentPersonal::form_personal"
		);		
		$this->addPost(
			"/mycv/personal/save",
			"StudentPersonal::savePersonal"
		);
		
		
		// Education form routes
		$this->add(
			"/mycv/education",
			"StudentEducation::form_education"
		);
		$this->addPost(
			"/mycv/education/save",
			"StudentEducation::saveEducation"
		);
		$this->addPost(
			"/mycv/education/edit/{eduid}",
			"StudentEducation::editEducation"
		);
		$this->addGet(
			"/mycv/education/delete/{eduid}",
			"StudentEducation::deleteEducation"
		);
		
		
		// Experience form routes
		$this->add(
			"/mycv/experience",
			"StudentExperience::form_experience"
		);
		$this->addPost(
			"/mycv/experience/save",
			"StudentExperience::saveExperience"
		);
		$this->addPost(
			"/mycv/experience/edit/{expid}",
			"StudentExperience::editExperience"
		);
		$this->addGet(
			"/mycv/experience/delete/{expid}",
			"StudentExperience::deleteExperience"
		);
		
		
		// Skills form routes
		$this->add(
			"/mycv/skills",
			"StudentSkills::form_skills"
		);		
		$this->addPost(
			"/mycv/skills/save",
			"StudentSkills::saveSkills"
		);
		
		
	}
}