<?php

use Phalcon\Mvc\Controller;

class StudentEducationController extends Controller
{
	private $user;
	
	public function initialize()
	{
		$this->user = Users::findFirstById($this->session->get("auth")["id"]);		
	}
	
	
	public function form_educationAction()
	{		
		$this->view->educations = $this->user->education;
		$this->view->science_fields = ScienceFields::find();
		$this->view->science_domains = ScienceDomains::find();

		$this->view->pick("student/form_education");
	}
	
	
	/**
    * This action saves education data
    */
	public function saveEducationAction()
	{
		$education = new Education();	
		$science_field = ScienceFields::findFirstById($this->request->getPost("science_field"));
		
		$education->users = $this->user;
		$education->scienceFields = $science_field;
		
		$success = $education->save(
		[
			"institution_name" => $this->request->getPost("institution_name", "striptags"),
			"study" => $this->request->getPost("study", "striptags"),
			"city" => $this->request->getPost("city", "striptags"),
			"country" => $this->request->getPost("country", "striptags"),
			"title" => $this->request->getPost("title", "striptags"),
			"duration_from" => $this->request->getPost("duration_from", "striptags"),
			"duration_to" => $this->request->getPost("duration_to", "striptags"),
		]);		
		
		if(!$success)
			$this->flashSession->error('Error during saving data!');
		else
			$this->flashSession->success('Data saved successfuly');
		
		return $this->response->redirect("student/mycv/education");		
	}
	
	
	/**
    * This action edits education data
    */
	public function editEducationAction($id)
	{
		$education = Education::findFirstById($id);
		if(!$education)
		{
			$this->flashSession->error('Data does not exist!');
			return $this->response->redirect($this->request->getHTTPReferer());
		}
		
		$science_field = ScienceFields::findFirstById($this->request->getPost("science_field"));		
		$education->scienceFields = $science_field;
		
		$success = $education->update(
		[
			"institution_name" => $this->request->getPost("institution_name", "striptags"),
			"study" => $this->request->getPost("study", "striptags"),
			"city" => $this->request->getPost("city", "striptags"),
			"country" => $this->request->getPost("country", "striptags"),
			"title" => $this->request->getPost("title", "striptags"),
			"duration_from" => $this->request->getPost("duration_from".$id, "striptags"),
			"duration_to"=> $this->request->getPost("duration_to".$id, "striptags"),
		]);	
		
		if(!$success)
			$this->flashSession->error('Error during updating data!');
		else
			$this->flashSession->success('Data updated successfuly');
		
		return $this->response->redirect('student/mycv/education');		
	}
	
	
	/**
    * This action deletes education data
    */
	public function deleteEducationAction($id)
	{
		$education = Education::findFirstById($id);		
		$education->delete();		
		return $this->response->redirect("student/mycv/education");		
	}
	
	
}