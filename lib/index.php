<?php
	namespace WannaCycle\API;
	
	$loader = require '../vendor/autoload.php';
	$loader->addPsr4('WannaCycle\\API\\', '..');
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use WannaCycle\API\HVV\HvvController;
	use WannaCycle\API\HVV\HvvRoute;
	use WannaCycle\API\Stadtrad\StadtradController;
	
	$app = new \Slim\App([
		'debug' =>  true
	]);
	
	$app->post('/route', function (Request $request, Response $response, array $args) {
		$body = $request->getParsedBody();
		$startStationName = $body['start'];
		$destinationStationName = $body['destinantion'];
		
		//HVV
		/** @var HvvRoute $route */
//		$route = HvvController::getFullRoute('Barmbek', 'S Stellingen');
		
		HvvController::getRoute('Barmbek', 'Hagenbecks Tierpark', 'jetzt');
		
		//Stadtrad
			//for all stations out of the route check:
				// whats the nearest Stadtrad station -> StadtradController internal
				// how many bikes are there -> StadtradController internal
		
		//algorithmus
			//whats the suggestion
//
//		echo StadtradController::findStadtradForHvv(new HvvLocation('U Baumwall','Hamburg', '12345', 'station', new Coordinate(34,34)));
//
		//return
		return $response->getBody()->write(json_encode(
			HvvRoute::toAlgArray($route)
		));
	});
	
	$app->run();
