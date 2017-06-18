<?php

use Phalcon\Mvc\Controller;

class StudentPersonalController extends Controller
{
	private $user;
	
	public function initialize()
	{
		$this->user = Users::findFirstById($this->session->get("auth")["id"]);		
	}
	
	public function form_personalAction()
	{		
		$this->view->user = $this->user;		
		$this->view->pick("student/form_personal");
	}
	
	
	/**
    * This action edits users personal data
    */
	public function savePersonalAction()
	{
		$user = $this->user;
		
		if(!$this->request->getPost("city", "striptags"))
			$user->city_id = null;
		else
		{			
			$city = Cities::findFirstByName($this->request->getPost("city"));
			
			if(!$city) {
				$city = new Cities();
				$city->name = $this->request->getPost("city", "upper");
				$city->zip_code = $this->request->getPost("zip_code");
				$city->country = $this->request->getPost("country", "upper");				
			}
			$user->cities = $city;
		}
		
		$success = $user->update(
		[
			"fname" => $this->request->getPost("fname", "striptags"),
			"lname" => $this->request->getPost("lname", "striptags"),
			"birth" => $this->request->getPost("birth", "striptags"),
			"phone" => $this->request->getPost("phone", "striptags"),
			"web" => $this->request->getPost("web", "striptags"),
			"address" => $this->request->getPost("address", "striptags"),
		]);
		
		if(!$success)
			$this->flashSession->error('Error during updating information!');
		
		return $this->response->redirect("student/mycv/personal");
	}
	
	
	/**
    * This action makes user CV published
    */
	public function publishAction()
	{
		if($this->user->status == "unpublished")
			$this->user->update(["status" => "published"]);
		else
			$this->user->update(["status" => "unpublished"]);
		
		return $this->response->redirect("student/mycv/personal");			
	}
	
	
}