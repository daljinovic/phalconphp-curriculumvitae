<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class AccountRoutes extends RouterGroup
{
    public function initialize()
    {
		
		$this->add(
			"/student/account",
			"Account::account"
		);
		$this->add(
			"/employer/account",
			"Account::account"
		);
		
		$this->addPost(
			"/student/account/edit",
			"Account::account_edit"
		);		
		$this->addPost(
			"/employer/account/edit",
			"Account::account_edit"
		);
			
		
	}
}