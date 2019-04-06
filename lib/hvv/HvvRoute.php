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
		protected $start;
		protected $destination;
		
		/**
		 * HvvRoute constructor.
		 *
		 * @param $start
		 * @param $destination
		 */
		public function __construct(HvvLocation $start, HvvLocation $destination) {
			$this->start = $start;
			$this->destination = $destination;
		}
		
		public function full() {
		
		}
		
		
		
		
	}