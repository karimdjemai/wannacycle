<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	
	require '../vendor/autoload.php';
	
	$app = new \Slim\App;
	
	$app->get('/route', function (Request $request, Response $response, array $args) {
		$body = $request->getParsedBody();
		
		//HVV
		/** @var HvvRoute $route */
		$route = HvvController::getFullRoute($startStationName, $destinationStationName);
		
		
		//Stadtrad
			//for all stations out of the route check:
				// whats the nearest Stadtrad station
				// how many bikes are there
		  
		//algorithmus
			//whats the suggestion
		
		//return
		return $response->getBody()->write(json_encode([
			'status'    =>  'ok'
		]));
	});

	StadtradController::findStadtradForHvv('U Barmbek')
	
	$app->run();
