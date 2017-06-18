<?php

use Phalcon\Mvc\Controller;

class StudentExperienceController extends Controller
{
	private $user;
	
	public function initialize()
	{
		$this->user = Users::findFirstById($this->session->get("auth")["id"]);		
	}
	
	public function form_experienceAction()
	{		
		$this->view->experiences = $this->user->experience;		
		$this->view->pick("student/form_experience");
	}
	
	
	/**
    * This action saves experience data
    */
	public function saveExperienceAction()
	{
		$experience = new Experience();			
		$experience->users = $this->user;
		
		$success = $experience->save(
		[
			"institution_name" => $this->request->getPost("institution_name", "striptags"),
			"city" => $this->request->getPost("city", "striptags"),
			"country" => $this->request->getPost("country", "striptags"),
			"position" => $this->request->getPost("position", "striptags"),
			"functions" => $this->request->getPost("functions", "striptags"),
			"duration_from" => $this->request->getPost("duration_from", "striptags"),
			"duration_to" => $this->request->getPost("duration_to", "striptags"),
		]);		
		
		if(!$success)
			$this->flashSession->error('Error during saving data!');
		else
			$this->flashSession->success('Data saved successfuly');
		
		return $this->response->redirect("student/mycv/experience");
	}
	
	
	/**
    * This action edits experience data
    */
	public function editExperienceAction($id)
	{
		$experience = Experience::findFirstById($id);
		if(!$experience)
		{
			$this->flashSession->error('Data does not exist!');
			return $this->response->redirect($this->request->getHTTPReferer());
		}
		
		$success = $experience->update(
		[
			"institution_name" => $this->request->getPost("institution_name", "striptags"),
			"city" => $this->request->getPost("city", "striptags"),
			"country" => $this->request->getPost("country", "striptags"),
			"position" => $this->request->getPost("position", "striptags"),
			"functions" => $this->request->getPost("functions", "striptags"),
			"duration_from" => $this->request->getPost("duration_from".$id, "striptags"),
			"duration_to" => $this->request->getPost("duration_to".$id, "striptags"),
		]);	
		
		if(!$success)
			$this->flashSession->error('Error during updating data!');
		else
			$this->flashSession->success('Data updated successfuly');
		
		return $this->response->redirect("student/mycv/experience");
	}
	
	
	/**
    * This action deletes experience data
    */
	public function deleteExperienceAction($id)
	{
		$experience = Experience::findFirstById($id);	
		$experience->delete();		
		return $this->response->redirect("student/mycv/experience");		
	}
}