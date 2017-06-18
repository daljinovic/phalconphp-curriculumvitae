<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
	public function indexAction()
	{
		if($this->session->get("auth")["id"])
		{
			$user = Users::findFirstById($this->session->get("auth")["id"]);
			
			if($user->role == "student") {
				$this->response->redirect("student/mycv/personal");
			}
			
			if($user->role == "employer") {
				$this->response->redirect("employer/students");
			}
			
			if($user->role == "admin") {
				$this->response->redirect("admin/home");
			}
		}		
	}
	
	
	public function loginAction()
	{
		
	}
	
	public function signupAction()
	{
		
	}
	
	public function route404Action()
	{
		
	}
	
	
	/**
    * This action authenticates login/signup data and logs user into application
    */
	public function authoriseAction()
	{
		if($this->request->isPost() != true) {
			return $this->response->redirect();
		}
		
		if($this->request->getPost("login"))
			$user = $this->_loginUser();
		elseif($this->request->getPost("signup"))
			$user = $this->_signupUser();
		
		$this->_registerSession($user);
		
		return $this->dispatcher->forward(
			[
                "action"     => "index",
            ]
		);
		
	}
	
	
	/**
    * This method returns user if login successful
    */
	private function _loginUser()
	{
		$email = $this->request->getPost("email", "email");
		$password = $this->request->getPost("password");
		
		$user = Users::findFirstByEmail($email);
		
		if($user) {
			if($this->security->checkHash($password, $user->password))
				return $user;
		}
		
		$this->flashSession->error("Wrong email/password");		
		return $this->response->redirect("login");
	}
	
	
	/**
    * This method return new user if signup successful
    */
	private function _signupUser()
	{
		// Get the data from the user
		$email = $this->request->getPost("email", "email");
		$password = $this->request->getPost("password");
		$password2 = $this->request->getPost("password_repeat");
		$role = $this->request->getPost("role");
		
		// Check if username/email is taken
		$user = Users::findFirstByEmail($email);
		
		if(!$user)
		{
			// Make new user
			$user = new Users([
				"email" => $email,
				"password" => $this->security->hash($password),
				"role" => $role,			
			]);
			
			// save() returns true or false
			if($user->save())
				return $user;
			else
				$this->flashSession->error("Error during saving your information!");
		}
		
		if($user)
			$this->flashSession->error("Given email/username is taken!");
		elseif($password != $password2)
			$this->flashSession->error("Repeated password does not match");
		
		return $this->response->redirect("signup");
	}
	
	
	
	/**
    * This method registers user session
    */
	private function _registerSession($user)
    {
        $this->session->set(
            "auth",
            [
                "id"   => $user->id,
                "email" => $user->email,
				"role" => $user->role,
            ]
        );
    }
	
	
	/**
    * This action logs user out
    */
	public function logoutAction()
	{
		if($this->session->has("auth")) {
			$this->session->remove("auth");
			$this->session->destroy();
		}
		
		return $this->response->redirect();
	}
	
}