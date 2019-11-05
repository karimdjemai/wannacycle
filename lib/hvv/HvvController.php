<?php
	namespace WannaCycle\API\HVV;
	
	use Unirest\Request;
	use WannaCycle\API\Coordinate;
	
	/**
	 * HvvController
	 * statically calls the Hvv api methods:
	 *  - checkName (outputs station)
	 *  - getRoute (finds Route)
	 *
	 * @version    1.0
	 * @date       2019-04-06
	 */
	class HvvController {
		//const URL = 'http://requestbin.fullcontact.com/so87zuso';
		const URL = 'http://api-test.geofox.de/gti/public';
		
		/**
		 * Calls hvv apis method checkname and returnes a HvvLocation or null if none is found.
		 *
		 * @param string $name
		 *
		 * @return array
		 */
		public static function checkName(string $name) {
			$body = [
				'theName'   =>  [
					'name'  =>  $name
				],
				'maxList'   =>  1
			];
			
			return (array) self::executeRESTCall('checkName', $body)->results[0];
		}
		
		public static function getRoute(string $startStationName, string $destinationStationName, $time) {
			$startStation =  self::checkName($startStationName);
			$destStation =   self::checkName($destinationStationName);
			
			$GTITime = [
				'date'  =>  'heute',
				'time'  =>  'jetzt'
			];
			
			$body = [
				'start'             =>  $startStation,
				'dest'              =>  $destStation,
				'time'              =>  $GTITime,
				'timeIsDeparture'   =>  true,
				'intermediateStops' =>  true,
				'numberOfSchedules' =>  1
			];
			
			$response = self::executeRESTCall('getRoute', $body);
			$assoc = json_decode($response, true);
			
			return $assoc;
		}
		
		protected  static function filterDoubles() {
		
		}
		
		/**
		 * Call a method in Geofox hvv api
		 *
		 * @param string $methode
		 * @param array  $body
		 *
		 * @return \Unirest\Response
		 */
		protected static function executeRESTCall(string $methode, array $body) {
			$bodyString = json_encode($body);
			
			$signatur = base64_encode(hash_hmac('sha1', $bodyString, 'Q(bxDB}?myFC', true));
			
			$headers = [
				'Accept'    =>  'application/json',
				'Content-Type'          =>  'application/json;charset=UTF-8',
				'geofox-auth-user'          =>  'uni_hh',
				'geofox-auth-signature'          =>  $signatur
			];
			
			$user = 'uni_hh';
			
			$resBody = Request::post(self::URL . '/' . $methode, $headers, $bodyString)->body;
			
			return $resBody;
		}
//
//		protected static function mkSignature($PASS, $requestBody) {
//			$hmac = hash_hmac('sha1', $requestBody, $PASS, true);
//			return base64_encode($hmac);
//		}
		
		// die anzahl der Stadträder zur aktuelle zeit soll mit der Anzahl der Stadträder zur ankunftszeit aus der Prognosen CSV gezogen werden
		// die differenz wird berechnetund dann als return wiedergegeben.
//		public static function makePrognose($time, $arrivalTime) {
//
//		    $csvFile = file(dirname(__FILE__) . '/PrognosenDummy.csv');
//

		public function toOutputArray(array $route) {
		
		}
		
//		public static function toAlgArray(array $route) {
//			//liste an namen
//			$list = [];
//
//			$list[] = [$route['schedules'][0]['scheduleElements'][0]['from']['name'], true];
//			foreach ($route['schedules'][0]['scheduleElements'] as $schedule) {
//				foreach ($schedule['intermediateStops'] as $stop) {
//					$list[] = [$stop['name'], false];
//				}
//				$list[] = [$schedule['to']['name'], true];
//			}
//
//			return $list;
//		}
		
//		public static function buildNewRoute(array $route, int $inStation, int $outStation) {
//			if ($inStation == -1) {
//				return $route;
//			}
//
//			$counter = 0;
//			foreach ($route['schedules'][0]['scheduleElements'] as $schedule) {
//				$blockLength = count($schedule['intermediateStops']) + 1;
//
//				if ($blockLength < $inStation) {
//					$counter += $blockLength;
//					break;
//				} else {
//					$schedule['dest'] =
//				}
//			}
//
//		}
 
	}
