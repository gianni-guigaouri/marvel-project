<?php

require_once('views/View.php');

class Router
{

	private $_ctrl;
	private $_view;
	

	public function routeRequests()
	{
		try
		{	// automatic load of class
			spl_autoload_register(function($class)
			{	
				$class = str_replace('Marvel\Models\\', '', $class);
				require_once('models/'.$class.'.php');
			});

			$url = [];

		 	if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller" . $controller;

                if ($controllerFile = "controllers/" . $controllerClass . ".php")
                { // method to verify if the controller is on backend or frontend folder
                    if (file_exists($controllerFile))
                    {
                        require_once ($controllerFile);
                        $this->_ctrl = new $controllerClass($url);
                    }
                    else
                    {
                        throw new Exception('La page que vous recherchez semble introuvable.');
                    }
                }
            } else {
				require_once('controllers/ControllerHome.php');
				$this->_ctrl = new ControllerHome($url);
			}
		}

		// errors manage
		catch(\Exception $e)
		{
			$errorMsg = $e->getMessage();
			$this->_view = new View('Error');
			$this->_view->generate(array('errorMsg' => $errorMsg));
		}
	}
}