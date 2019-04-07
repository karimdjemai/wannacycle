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
		
		/**
		 * HvvRoute constructor.
		 *
		 * @param $scheduleElements
		 * @param $duration
		 */
		public function __construct(array $scheduleElements, int $duration) {
			$this->scheduleElements = $scheduleElements;
			$this->duration = $duration;
		}
		
	}