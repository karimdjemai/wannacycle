<?php
	
	/**
	 * Coordinate
	 * Represenation of a Coordinate
	 *
	 * @author     karimdjemai
	 * @version    1.0
	 * @date       2019-04-06
	 */
	class Coordinate {
		protected $x;
		protected $y;
		
		public function __construct(float $x, float $y) {
			$this->x = $x;
			$this->y = $y;
		}
		
		/**
		 * @return float
		 */
		public function getX(): float {
			return $this->x;
		}
		
		/**
		 * @param float $x
		 */
		public function setX(float $x) {
			$this->x = $x;
		}
		
		/**
		 * @return float
		 */
		public function getY(): float {
			return $this->y;
		}
		
		/**
		 * @param float $y
		 */
		public function setY(float $y) {
			$this->y = $y;
		}
	}