<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	require '../vendor/autoload.php';
	
	$app = new \Slim\App;
	
	$app->get('/route', function (Request $request, Response $response, array $args) {
		//HVV
		
		//Stadtrad
		
		//algorithmus
		
		
		//return
		return $response->getBody()->write(json_encode([
			'status'    =>  'ok'
		]));
	});
	
	$app->run();