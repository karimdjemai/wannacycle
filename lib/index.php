<?php
	namespace WannaCycle\API;
	
	$loader = require '../vendor/autoload.php';
	$loader->addPsr4('WannaCycle\\API\\', '..');
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use WannaCycle\API\HVV\HvvController;
	use WannaCycle\API\HVV\HvvRoute;
	
	$app = new \Slim\App([
		'debug' =>  true
	]);
	
	$app->get('/route', function (Request $request, Response $response, array $args) {
		//$body = $request->getParsedBody();
		//$startStationName = $body['start'];
		//$destinationStationName = $body['destinantion'];
		
		//HVV
		/** @var HvvRoute $route */
		$route = HvvController::getFullRoute('sd', 'sdsd');
		
		
		//Stadtrad
			//for all stations out of the route check:
				// whats the nearest Stadtrad station
				// how many bikes are there
		  
		//algorithmus
			//whats the suggestion
<<<<<<< HEAD
		echo StadtradController::findStadtradForHvv(new HvvLocation('U Baumwall','Hamburg', '12345', 'station', new Coordinate(34,34)));
=======
		//echo StadtradController::findStadtradForHvv(new HvvLocation('test','test', 'sdfjsdf', 'sdfs', new Coordinate(34,34)));
>>>>>>> sdlkfasdkjfoasdfj
		
		//return
		return $response->getBody()->write(json_encode([
			'status'    =>  'ok'
		]));
	});
	
	$app->run();
