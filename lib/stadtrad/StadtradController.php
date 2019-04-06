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
            $table = fopen(".csv", "r");

            /* This will loop through all the rows until it reaches the end */
            while($row = fgetcsv($table)) {
                if (in_array($hvvstation, $row[0])) {
                    return $row[2];
                }
            }
            return '0';
        }

        /**
         * Transforms a list of Stadtrad ID's into their bike avaliability numbers
         * @param array $id A list of Stadtrad ID's
         * @return array A list of the numbers of bikes avaliable at those stations (in the same order)
         */
        public static function getAvaliability (array $ids) {
            $get_data = self::executeRESTCall('GET', 'https://geodienste.hamburg.de/HH_WFS_Stadtrad?service=WFS&request=GetFeature&VERSION=1.1.0&typename=stadtrad_stationen&outputFormat=application/geo%2bjson&srsName=EPSG:4326');

            $data = json_decode($get_data, true);

            $subarray = $data['features'];


            $properties = array_column($subarray, 'properties');
            $uid = array_column($properties, 'uid');


            $idssize = sizeof($ids);

//            for ($i = 0; $i < $idssize; $i++) {
//                $ids[$i] = $subarray[array_search($ids[$i], $uid)]['properties']['anzahl_raeder'];
//            }
	        $res = [];
            
            foreach ($ids as $id) {
	            $res[$id] = $subarray[array_search($id, $uid)]['properties']['anzahl_raeder'];
            }
            
            return $res;
        }
	
	    protected static function executeRESTCall($methode, $adresse, $daten = false)
	    {
		    $curl = curl_init();
		    curl_setopt($curl, CURLOPT_URL, $adresse);
		    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $methode);
		    if ($daten) {
			    $head = ['Content-Type: application/text',
				    'Content-Length: ' . strlen($daten)];
			    curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
			    curl_setopt($curl, CURLOPT_POSTFIELDS, $daten);
		    }
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    return curl_exec($curl);
	    }
    }