<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 14/02/2016
 * Time: 20:56
 */

namespace BackyBack\CookieMeetBundle\Map;

use Ivory\GoogleMap\Services\Geocoding\Geocoder;
use Ivory\GoogleMap\Services\Geocoding\Result\GeocoderResult;
use BackyBack\CookieMeetBundle\Controller\MapController as Mappy;

class GeocodeClass extends Mappy
{
    public function geocodeAdress()
    {
        // Requests the ivory google map geocoder service
        $geocoder = $this->get('ivory_google_map.geocoder');

        // Geocode an address
        $response = $geocoder->geocode('73 Boulevard Berthier');

        return $response;
    }
}