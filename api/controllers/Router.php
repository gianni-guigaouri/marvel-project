<?php

class Router
{

	private $_ctrl;
	private $_view;
	

	public function routeRequests()
	{
		// AUTOMATIC LOAD OF CLASS
		spl_autoload_register(function($class)
		{	
			$class = str_replace('Marvel\Models\\', '', $class);
			require_once('models/'.$class.'.php');
		});

		$url = [];

		if($_SERVER['REQUEST_METHOD'] === 'GET') {
			header('Access-Control-Allow-Origin: *');
			// GET URI INFORMATION TO CALL THE GOOD CONTROLLER
			if (isset($_GET['url'])) {
				$url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
				$controller = ucfirst(strtolower($url[0]));
				$controllerClass = "Controller" . $controller;

				if ($controllerFile = "controllers/" . $controllerClass . ".php")
				{ 
					if (file_exists($controllerFile))
					{
						require_once ($controllerFile);
						$this->_ctrl = new $controllerClass($url);
					}
					else
					{
						$response['error'] = 'La syntaxe de la requête est erronée.';
						$code = 400;
					}
				}
			} else {
				$response['error'] = 'La syntaxe de la requête est erronée.';
				$code = 400;
			}
		} else {
			$response['error'] = 'Méthode de requête non autorisée.';
			$code = 405;
		}	

		if(!empty($response['error'])) {
			header("Content-type: application/json; charset=utf-8");
            http_response_code($code);
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		}
	}
}