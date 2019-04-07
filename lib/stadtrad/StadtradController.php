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
         * Transforms a list of Stadtrad ID's into their bike avaliability numbers. ID's that are 0 shall be ignored.
         * @param array $id A list of Stadtrad ID's
         * @return array A array of the IDs and numbers of bikes avaliable at those stations (in the same order). The ID's that are 0 get avaliability -1.
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
            $count = -1;

            foreach ($ids as $id) {
                if($id !== 0) {
                    $res[$id] = $subarray[array_search($id, $uid)]['properties']['anzahl_raeder'];
                }
                else {
                    $res[$count] = -1;
                    $count = $count - 1;
                }
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

        /**
         * Transforms a HvvRoute object into a list of avaliabilities
         * @param $route The HvvRoute object we want to analyze
         * @return array A list of avaliabilities. If there is no Stadtrad station on the current route stop, -1 is returned for that stop.
         */
        protected static function routeToAvaliabilities ($route) {
            array(int)
            $stadtradIDs = [];
            foreach ($route as $location) {
                $stadtradID = self::findStadtradForHvv($location->getName());
                array_push($stadtradIDs, $stadtradID);
            }
            $idlist = self::getAvaliability($stadtradIDs);
            $reslist = [];
            foreach($idlist as $listitem) {
                array_push($reslist, $listitem[1]);
            }
            return $reslist;
        }
    }