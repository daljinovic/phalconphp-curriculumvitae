<?php

use Phalcon\Mvc\Controller;

class StudentSkillsController extends Controller
{
	private $user;
	
	public function initialize()
	{
		$this->user = Users::findFirstById($this->session->get("auth")["id"]);		
	}
	
	public function form_skillsAction()
	{		
		$this->view->skills = $this->user->skills;
		$this->view->pick("student/form_skills");
	}
	
	
	public function saveSkillsAction()
	{
		$skills = $this->user->skills;
		
		if(!$skills) {
			$skills = new Skills();
			$skills->users = $this->user;
		}
		
		$success = $skills->save(
		[
			"language" => $this->request->getPost("language"),
			"language_other" => $this->request->getPost("language_other"),
			"communication" => $this->request->getPost("communication"),
			"organization" => $this->request->getPost("organization"),
			"business" => $this->request->getPost("business"),
			"skills_other" => $this->request->getPost("skills_other"),
			"drivers_licence" => $this->request->getPost("drivers_licence"),
		]);
		
		if(!$success)
			$this->flashSession->error('Error during saving data!');
		else
			$this->flashSession->success('Data saved successfuly');
		
		return $this->response->redirect("student/mycv/skills");
	}
}