<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use WannaCycle\API\Coordinate;
	use WannaCycle\API\HVV\HvvController;
	use WannaCycle\API\HVV\HvvLocation;
	use WannaCycle\API\HVV\HvvRoute;
	use WannaCycle\API\Stadtrad\StadtradController;
	
	$loader = require '../vendor/autoload.php';
	$loader->addPsr4('WannaCycle\\API\\', '..');
	
	$app = new \Slim\App;
	
	$app->post('/route', function (Request $request, Response $response, array $args) {
		$body = $request->getParsedBody();
		$startStationName = $body['start'];
		$destinationStationName = $body['destinantion'];
		
		//HVV
		/** @var HvvRoute $route */
		$route = HvvController::getFullRoute($startStationName, $destinationStationName);
		
		
		//Stadtrad
			//for all stations out of the route check:
				// whats the nearest Stadtrad station
				// how many bikes are there
		  
		//algorithmus
			//whats the suggestion
		echo StadtradController::findStadtradForHvv(new HvvLocation('test','test', 'sdfjsdf', 'sdfs', new Coordinate(34,34)));
		
		//return
		return $response->getBody()->write(json_encode([
			'status'    =>  'ok'
		]));
	});
	
	
	$app->run();
