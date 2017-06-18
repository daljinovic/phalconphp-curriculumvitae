<?php

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class EmployerController extends Controller
{

	private $employer;
	
	public function initialize()
	{
		$this->employer = Users::findFirstById($this->session->get("auth")["id"]);
	}

	/**
    * This action paginates student list(all, search,...)
    */
	public function paginate_studentsAction($page, $students, $form)
	{		
		$currentPage = $page;		
		$paginator = new PaginatorModel([
			"data"  => $students,
			"limit" => 2,
			"page"  => $currentPage,
		]);

		$students = $paginator->getPaginate();		
		
		$this->view->setVars([
			'students' => $students,
			'cities' => Cities::find(),
			'student_list' => $form,
			'bookmarks' => $this->employer->bookmarks,
			'science_fields' => ScienceFields::find(),
			'science_domains' => ScienceDomains::find(),
		]);		
	}
	
	
	
	/**
	*	This action shows all students
	*/
	public function listStudentsAction()
	{	
		$page = $this->dispatcher->getParam('page');
		$students = Users::getStudents();

		return $this->dispatcher->forward([
			"action" => "paginate_students",
			"params" => array($page, $students, "list_students"),
		]);		
	}
	
	
	/**
    * This action queries users by search criteria
    */
	public function searchStudentsAction()
	{
		if(!$this->persistent->students and !$this->request->getPost())
			return $this->response->redirect($this->request->getHTTPReferer());
		
		if(!$this->persistent->page or $this->persistent->page != $this->dispatcher->getParam('page'))
			$this->persistent->page = $this->dispatcher->getParam('page');		
		
		$fname = $this->request->getPost("fname");
		$lname = $this->request->getPost("lname");
		$city = Cities::findFirstById($this->request->getPost("city"));
		$science_field = ScienceFields::findFirstById($this->request->getPost('science_field'));
		
		if($city){
			$students = $this->modelsManager->createBuilder()
				->from("Users")
				->join("Cities", "Users.city_id = Cities.id")
				->where("Cities.name = :city:", ["city" => $city->name])
				->orderBy("Users.fname")
				->getQuery()
				->execute();
		}
		
		if($science_field){
			$students = $this->modelsManager->createBuilder()
				->from("Users")
				->join("Education", "Users.id = Education.user_id")
				->where("Education.science_field_id = :sf:", ["sf" => $science_field->id])
				->orderBy("Users.fname")
				->getQuery()
				->execute();
		}		
		
		if(!$this->persistent->students)
			$this->persistent->students = $students;
		
		return $this->dispatcher->forward([
			"action" => "paginate_students",
			"params" => array($this->persistent->page, $this->persistent->students, "search_students"),
		]);
		
	}
	
	
	/**
    * This action displays specific CV
    */	
	public function student_cvAction($sid)
	{
		$student = Users::findFirstById($sid);		
		if(!$student)
		{
			$this->flashSession->error('Data does not exist!');
			return $this->response->redirect("employer/students");
		}		
		$this->view->student = $student;			
	}
	
	
	
	/**
    * This action saves a bookmark
    */
	public function saveBookmarkAction($sid)
	{
		$employer = $this->employer;
		$student = Users::findFirstById($sid);
		
		$bookmark = Bookmarks::getOneBookmark($employer->id, $student->id);		
		
		if($bookmark) {
			$this->flashSession->notice('Bookmark already exists');
		}elseif($student and $employer and $student->status=='published') {
			$bookmark = new Bookmarks();
			$bookmark->employer = $employer;
			$bookmark->student = $student;
			$bookmark->save();
		}
	
		return $this->response->redirect($this->request->getHTTPReferer());
	}
	
	
	/**
    * This action deletes a bookmark
    */
	public function deleteBookmarkAction($bid)
	{
		$bookmark = Bookmarks::getOneBookmark($this->employer->id, $bid);
		
		if($bookmark)
			$bookmark->delete();
		
		return $this->response->redirect($this->request->getHTTPReferer());	
	}
	
	
}