<?php
	namespace WannaCycle\API\HVV;

	
	
	/**
	 * HvvController
	 * statically calls the Hvv api methods:
	 *  - checkName (outputs station)
	 *  - getRoute (finds Route)
	 *  - departureCourese (gives all stations of the route)
	 *
	 * @version    1.0
	 * @date       2019-04-06
	 */
	class HvvController {
		/**
		 * Calls hvv apis method checkname and returnes a HvvLocation or null if none is found.
		 * @param string $name
		 * @return HvvLocation|null
		 */
		public static function checkName(string $name) {
			return new HvvLocation('Test', 'Hamburg', 'jkasdhfkf', HvvLocation::STATION, new Coordinate(6, 8));
		}
		
		public static function getRoute(string $startStationName, string $destinationStationName) {
			return new HvvRoute(self::checkName($startStationName), self::checkName($destinationStationName));
		}
		
		public static function getFullRoute(string $startStationName, string $destinationStationName) {
			$route = self::getRoute($startStationName, $destinationStationName);
			$route->full();
			
			return $route;
		}
	}