<?php

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\Application;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Flash\Direct as Flash;


// Register an autoloader (only classes can be here, no views)
$loader = new Loader();
$loader->registerDirs(
	[
		"../app/controllers/",
		"../app/models/",
		"../app/plugins/",
		"../app/routes/",
	]
);
$loader->register();


// The FactoryDefault Dependency Injector automatically registers the
// right services providing a full-stack framework
$di = new FactoryDefault();


// Change CSS classes if needed for flash messages service
$di->set('flashSession', function () {
    return new FlashSession(array(
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ));
});


// Register Volt as a service for reusing
$di->set(
    "voltService",
    function ($view, $di) {
        $volt = new Volt($view, $di);
		$volt->setOptions(array(
			'compiledPath' => '../app/compiled/',
			'compileAlways' => true,
		));
			
        return $volt;
    }
);

// Setup the view component
$di->set(
	"view",
	function() {
		$view = new View();
		$view->setViewsDir("../app/views/");		
		$view->registerEngines(
            [
                ".volt" => "voltService",
				".phtml" => "voltService",
				".html" => "Phalcon\\Mvc\\View\\Engine\\Php",
				".php" => "Phalcon\\Mvc\\View\\Engine\\Php",
            ]
        );		
		return $view;
	}
);


// Setup a base URI so that all generated URIs include the "PhalconCV" folder
// If DocumentRoot in httpd.conf is PhalconCV then base URI is "/"
$di->set(
	"url",
	function() {
		$url = new UrlProvider();
		$url->setBaseUri("/PhalconCV/");
		return $url;
	}
);


// Database service
$di->set(
	"db",
	function() {
		return new DbAdapter(
			[
				"host" => "localhost",
				"username" => "root",
				"password" => "",
				"dbname" => "phalconcv",
			]
		);
	}
);


// Start the session the first time a component requests the session service
$di->set(
    "session",
    function () {
        $session = new Session();
        $session->start();
        return $session;
    }
);


// Create routes
$di->set(
	"router",
	function() {
		$router = new Router(false);

		$router->notFound(
			[
				"controller" => "index",
				"action"     => "route404",
			]
		);
		
		$router->mount(new IndexRoutes());
		$router->mount(new StudentRoutes());
		$router->mount(new EmployerRoutes());
		$router->mount(new AccountRoutes());
		
		return $router;
	}
);


// MVC dispatcher
$di->set(
    "dispatcher",
    function () {
		
        $eventsManager = new EventsManager();

        $eventsManager->attach(
            "dispatch:beforeExecuteRoute",
            new SecurityPlugin()
        );
        $eventsManager->attach(
            "dispatch:beforeException",
            new NotFoundPlugin()
        );

        $dispatcher = new Dispatcher();
        $dispatcher->setEventsManager($eventsManager);		
        return $dispatcher;
    }
);


// Handling application request
// Everything must be defined above this section
$application = new Application($di);

try {
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage();
}
