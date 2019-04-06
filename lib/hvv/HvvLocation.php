<?php
	namespace WannaCycle\API\HVV;
	
	use WannaCycle\API\Coordinate;
	
	/**
	 * HvvLocation
	 *
	 * Representation of a location in Hamburg (mostly HVVstations)
	 *
	 * @author     karimdjemai
	 * @version    1.0
	 * @date       2019-04-06
	 */
	class HvvLocation {
		const STATION = 'station';
		const COORDINATE = 'coordinate';
		const ADDRESS = 'address';
		const POI = 'poi';
		const UNKNOWN = 'unknown';
		
		protected $name;
		protected $city;
		protected $id;
		protected $type;
		protected $coordinate;
		
		public function __construct(string $name, string $city, string $id, string $type, Coordinate $coordinate) {
			$this->name = $name;
			$this->city = $city;
			$this->id = $id;
			$this->type = $type;
			$this->coordinate = $coordinate;
		}
		
		/**
		 * @return string
		 */
		public function getName(): string {
			return $this->name;
		}
		
		/**
		 * @param string $name
		 */
		public function setName(string $name) {
			$this->name = $name;
		}
		
		/**
		 * @return string
		 */
		public function getCity(): string {
			return $this->city;
		}
		
		/**
		 * @param string $city
		 */
		public function setCity(string $city) {
			$this->city = $city;
		}
		
		/**
		 * @return string
		 */
		public function getId(): string {
			return $this->id;
		}
		
		/**
		 * @param string $id
		 */
		public function setId(string $id) {
			$this->id = $id;
		}
		
		/**
		 * @return string
		 */
		public function getType(): string {
			return $this->type;
		}
		
		/**
		 * @param string $type
		 */
		public function setType(string $type) {
			$this->type = $type;
		}
		
		/**
		 * @return Coordinate
		 */
		public function getCoordinate(): Coordinate {
			return $this->coordinate;
		}
		
		/**
		 * @param Coordinate $coordinate
		 */
		public function setCoordinate(Coordinate $coordinate) {
			$this->coordinate = $coordinate;
		}
	}