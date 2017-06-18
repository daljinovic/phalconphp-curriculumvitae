<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class IndexRoutes extends RouterGroup
{
    public function initialize()
    {

		$this->add(
			"/",
			"Index::index"
		);
		
		
		// Authorisation
		$this->add(
			"/login",
			"Index::login"
		);
		
		$this->addPost(
			"/login/authorise",
			"Index::authorise"
		);
		
		$this->add(
			"/signup",
			"Index::signup"
		);
		
		$this->add(
			"/signup/authorise",
			"Index::authorise"
		);
		
		
		// Logout
		$this->add(
			"/student/logout",
			"Index::logout"
		);
		$this->add(
			"/employer/logout",
			"Index::logout"
		);
		
	}
	
}