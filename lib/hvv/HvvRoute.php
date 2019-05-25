<?php
	namespace WannaCycle\API\HVV;
	
	/**
	 * HvvRoute
	 * Representation of a Route (from start to departure) 
	 *
	 * @author     karimdjemai
	 * @version    1.0
	 * @date       2019-04-06
	 */
	class HvvRoute {
		protected $scheduleElements;
		protected $duration;
        protected $routeID;
        protected $start;
        protected $dest;
        
		/**
		 * HvvRoute constructor.
		 *
		 * @param HvvRoute 'Schedule'-JSON (GTI-API-doc 2.3.7) als Array
		 */
		public function __construct(array $HvvRoute) {
			$this->scheduleElements = $HvvRoute[scheduleElements];
			$this->routeID = $HvvRoute[routeID];
			$this->duration = $HvvRoute[time];
			$this->start = $HvvRoute[start];
			$this->dest = $HvvRoute[dest];
		}
        
        
        public function toOutputArray(array $route) {
            
        }
		
		public static function toAlgArray(array $route) {
			//liste an namen
			$list = [];

			foreach ($route['scheduleElements'] as $schedule) {
	
				foreach ($schedule['intermediateStops'] as $stop) {
	
					$list[] = $stop['name'];

				}
			return $list;
		}
		
	}