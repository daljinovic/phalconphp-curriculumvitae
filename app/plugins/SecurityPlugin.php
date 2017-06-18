<?php
use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;
/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Plugin
{
	/**
	 * Returns an existing or new access control list
	 *
	 * @returns AclList
	 */
	public function getAcl()
	{
		$this->persistent->destroy();
		
		if (!isset($this->persistent->acl)) {
			$acl = new AclList();
			$acl->setDefaultAction(Acl::DENY);
			// Register roles
			$roles = [
				'students'  => new Role('Students'),
				'employers' => new Role('Employers'),
				'guests' => new Role('Guests')
			];
			foreach ($roles as $role) {
				$acl->addRole($role);
			}
			
			$publicResources = [
				"index"    => ['index', 'login', 'signup', 'authorise'],
			];
			foreach ($publicResources as $resourceName => $actions) {
				$acl->addResource(new Resource($resourceName),$actions);
			}
			
			//Student area resources
			$studentResources = array(
				'index' => array('index', 'login', 'signup', 'route404', 'authorise', 'logout'),
				'student_personal' => array('form_personal', 'savePersonal', 'publish'),
				'student_education' => array('form_education', 'saveEducation', 'editEducation', 'deleteEducation'),
				'student_experience' => array('form_experience', 'saveExperience', 'editExperience', 'deleteExperience'),
				'student_skills' => array('form_skills', 'saveSkills'),
				'account' => array('account', 'account_edit')
			);
			
			foreach ($studentResources as $resourceName => $actions) {
				$acl->addResource(new Resource($resourceName), $actions);
			}
			
			//Employer area resources
			$employerResources = array(
				'index' => array('index', 'login', 'signup', 'route404', 'authorise', 'logout'),
				'employer' => array('listStudents', 'paginate_students', 'searchStudents', 'student_cv', 'saveBookmark', 'deleteBookmark'),
				'account' => array('account', 'account_edit')
			);
			foreach ($employerResources as $resourceName => $actions) {
				$acl->addResource(new Resource($resourceName), $actions);
			}
	
			
			//Grant access to public areas to both users and guests
			foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					foreach ($actions as $action){
						$acl->allow($role->getName(), $resource, $action);
					}
				}
			}
			
			//Grant access to private area to role Students
			foreach ($studentResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('Students', $resource, $action);
				}
			}
			
			//Grant access to private area to role Employers
			foreach ($employerResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('Employers', $resource, $action);
				}
			}
			//The acl is stored in session, APC would be useful here too
			$this->persistent->acl = $acl;
		}
		return $this->persistent->acl;
	}
	/**
	 * This action is executed before execute any action in the application
	 *
	 * @param Event $event
	 * @param Dispatcher $dispatcher
	 * @return bool
	 */
	public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
	{
		$auth = $this->session->get('auth');
		
		if (!$auth) {
            $role = 'Guests';
        } else {
            switch ($auth['role']) {
                case 'student':
                    $role = "Students";
                    break;
                case 'employer':
                    $role = "Employers";
                    break;
                default:
                    $role = "Guests";
                    break;
            }
        }
		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();
		
		$acl = $this->getAcl();
		
		$allowed = $acl->isAllowed($role, $controller, $action);
		if (!$allowed) {
			$dispatcher->forward(array(
				'controller' => 'index',
				'action'     => 'route404'
			));
			return false;
		}
	}
}