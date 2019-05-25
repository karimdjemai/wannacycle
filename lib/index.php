<?php
	namespace WannaCycle\API;
	
	$loader = require '../vendor/autoload.php';
	$loader->addPsr4('WannaCycle\\API\\', '..');
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use WannaCycle\API\HVV\HvvController;
	use WannaCycle\API\HVV\HvvLocation;
	use WannaCycle\API\HVV\HvvRoute;
	use WannaCycle\API\Stadtrad\StadtradController;
	
	$app = new \Slim\App([
		'debug' =>  true
	]);
	
	$app->get('/route', function (Request $request, Response $response, array $args) {
		
		//HVV
		/** @var HvvRoute $route */
		$route = HvvRoute::__construct(HvvController::getRoute('Hagenbecks Tierpark', 'Barmbek', ['heute','jetzt']));
		
		
		//Stadtrad
			//for all stations out of the route check:
				// whats the nearest Stadtrad station
				// how many bikes are there
		  
		//algorithmus
			//whats the suggestion

		//echo StadtradController::findStadtradForHvv(new HvvLocation('U Baumwall','Hamburg', '12345', 'station', new Coordinate(34,34)));
		//HvvController::getRoute('fsdf', 'asdasd');
		
		
		//return
		return $response->getBody()->write(json_encode(
			HvvController::toAlgArray($route)
		));
	});
	
	$app->run();
