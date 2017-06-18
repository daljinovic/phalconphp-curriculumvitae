<?php

use Phalcon\Mvc\Controller;

class AccountController extends Controller
{
	private $user;
	
	public function initialize()
	{
		$this->user = Users::findFirstById($this->session->get("auth")["id"]);		
	}
	
	
	public function accountAction()
	{		
		$this->view->user = $this->user;
		$this->view->pick('index/account');
	}
	
	
	/**
    * This action edits user email and password data
    */
	public function account_editAction()
	{
		$user = $this->user;
		
		if (!$this->security->checkHash($this->request->getPost('password_current'), $user->password))
		{
			$this->flashSession->error("Your current password is not correct!");
			return $this->response->redirect($user->role.'/account');
		}
		if ($this->request->getPost('password_new') != $this->request->getPost('password_new_repeat'))
		{
			$this->flashSession->error("New passwords don't match!");
			return $this->response->redirect($user->role.'/account');
		}
		
		$user->update([
			"email" => $this->request->getPost("email", "email"),
			"password" => $this->security->hash($this->request->getPost("password_new")),
		]);
		
		return $this->response->redirect($user->role.'/account');
	}
	
}