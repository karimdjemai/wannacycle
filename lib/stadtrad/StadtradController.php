<?php
	namespace WannaCycle\API\Stadtrad;
	
    use WannaCycle\API\HVV\HvvLocation;

    /**
     * Created by PhpStorm.
     * User: korbinian
     * Date: 4/6/19
     * Time: 6:44 AM
     */
    class StadtradController
    {

        /**
         * This function takes in any HVV station name, checks if there is a Stadtrad station close to it and returns its ID.
         * @param string $hvvstation The name of the HVV station
         * @return string The ID of the Stadtrad station next to it. If there is none, the return value is 0.
         */
        public static function findStadtradForHvv (HvvLocation $hvvstation) {
	        $csvFile = file(dirname(__FILE__) . '/hvv-stadtrad.csv');
	        $data = [];
	        
	        foreach ($csvFile as $line) {
		        $data[] = str_getcsv($line);
		        if (strpos($line, $hvvstation->getName()) !== false) {
		        	return str_getcsv($line)[1];
		        }
	        }
	        
	        return 0;
        }

        /**
         * Transforms a list of Stadtrad ID's into their bike avaliability numbers
         * @param array $id A list of Stadtrad ID's
         * @return int A list of the numbers of bikes avaliable at those stations (in the same order)
         */
        public static function getAvaliability (array $ids) {
            // TODO: This method is a dummy method and returns random avaliabilities. Please fix!
            for($x = 0; $x < count($ids); $x++) {
                $ids[$x] = rand(0, 40);
            }
            return $ids;
        }
    }