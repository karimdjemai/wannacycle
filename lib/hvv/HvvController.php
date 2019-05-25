<?php
	namespace WannaCycle\API\HVV;
	
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
		const URL = 'http://api-hack.geofox.de/gti/public/';
		
		/**
		 * Calls hvv apis method checkname and returnes a HvvLocation or null if none is found.
		 * @param string $name
		 * @return array response
		 */
		public static function checkName(string $name) {
			$body = [
				'theName'   =>  [
					'name'  =>  $name
				],
				'maxList'   =>  1
			];
			
			$response = self::executeRESTCall('POST', self::URL . 'checkName',  $test = json_encode($body));
			return $assoc = json_decode($response, true);
		}
		
		public static function getRoute(string $startStationName, string $destinationStationName, $GTITime) {
			$startStation = self::checkName($startStationName);
			$destStation =   self::checkName($destinationStationName);
			
			$body = [
				'start'             =>  $startStation['results'][0],
				'dest'              =>  $destStation['results'][0],
				'time'              =>  $GTITime,
				'timeIsDeparture'   =>  true,
				'intermediateStops' =>  true,
				'numberOfSchedules' =>  1
			];
			
			$response = self::executeRESTCall('POST', self::URL . 'getRoute',  $test = json_encode($body));
			$assoc = json_decode($response, true);
			
			return $assoc;
		}
		
		protected  static function filterDoubles() {
		
		}
		
		protected static function executeRESTCall($methode, $adresse, string $body) {
			$curl = curl_init();
			
			$USER = 'uni-hack';
			$PASS = '';
			
			$signature = self::mkSignature($PASS, $body);
			
			curl_setopt_array($curl, [
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_URL => $adresse,
				CURLOPT_USERAGENT => 'curl.7.61.0',
				CURLOPT_POST => 1,
				CURLOPT_HTTPHEADER => [
					'Accept: application/json',
					'Content-Type: application/json;charset=UTF-8',
					'Geofox-Auth-Type: ' . $USER,
					'Geofox-Auth-User: uni-hack',
					'Geofox-Auth-Signature: ' . $signature
				],
				CURLOPT_POSTFIELDS => $body
			]);
			
			return curl_exec($curl);
		}
		
		protected static function mkSignature($PASS, $requestBody) {
			$hmac = hash_hmac('sha1', $requestBody, $PASS, true);
			return base64_encode($hmac);
		}
		
		// die anzahl der Stadträder zur aktuelle zeit soll mit der Anzahl der Stadträder zur ankunftszeit aus der Prognosen CSV gezogen werden
		// die differenz wird berechnetund dann als return wiedergegeben.
		public static function makePrognose($time, $arrivalTime) {
		    
		    $csvFile = file(dirname(__FILE__) . '/PrognosenDummy.csv');
		    
		    
		}
 	
	}