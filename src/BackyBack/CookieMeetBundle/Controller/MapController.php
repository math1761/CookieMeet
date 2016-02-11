<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
use BackyBack\CookieMeetBundle\MapContent\GmapsGenerator;
use Ivory\GoogleMap\Places\Autocomplete;
use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;
use Ivory\GoogleMap\Places\AutocompleteType;
use Ivory\GoogleMap\Helper\Places\AutocompleteHelper;
use Ivory\GoogleMap\Services\Geocoding\Geocoder;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class MapController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @ApiDoc(
     *  resource=true,
     *  description="Configuration function for google maps"
     *
     * )
     */
    public function AddMapAction()
    {
        $marker = $this->showMarkerAction();

        $map = $this->get('ivory_google_map.map');

        $map->setPrefixJavascriptVariable('map_');
        $map->setHtmlContainerId('map_canvas');

        $map->setAsync(false);
        $map->setAutoZoom(false);

        $map->setCenter(48.856614, 2.352222, true);
        $map->setMapOption('zoom', 12);


        $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
        $map->setMapOption('mapTypeId', 'roadmap');

        $map->setMapOption('disableDefaultUI', true);
        $map->setMapOption('disableDoubleClickZoom', true);
        $map->setMapOptions(array(
            'disableDefaultUI' => true,
            'disableDoubleClickZoom' => true,
        ));

        $map->setStylesheetOptions(array(
            'width' => '1000px',
            'height' => '500px',
        ));

        $map->setLanguage('fr');
        $map->addMarker($marker);
        $places = $this->mapsPlacesAction();
        $geocoder = new Geocoder();
        $geocoder = $this->get('ivory_google_map.geocoder');
        $response = $geocoder->geocode('1600 Amphitheatre Parkway, Mountain View, CA');
        var_dump($response);
        return $this->render('BackyBackCookieMeetBundle:Map:map.html.twig', array(
            'map' => $map));
    }

    private function showMarkerAction()
    {
        $marker = new Marker();

        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition(48.856614, 2.352222, true);

        $marker->setAnimation(Animation::DROP);
        $marker->setOptions(array(
            'clickable' => true,
            'flat'      => true,
        ));

        return $marker;
    }

    private function AutoCompleteAction()
    {
        $autocomplete = new Autocomplete();

        $autocomplete->setPrefixJavascriptVariable('place_autocomplete_');
        $autocomplete->setInputId('place_input');

        $autocomplete->setInputAttributes(array('class' => 'my-class'));
        $autocomplete->setInputAttribute('class', 'my-class');

        $autocomplete->setTypes(array(AutocompleteType::ESTABLISHMENT));
        $autocomplete->setComponentRestrictions(array(AutocompleteComponentRestriction::COUNTRY => 'fr'));
        $autocomplete->setBound(-2.1, -3.9, 2.6, 1.4, true, true);

        $autocomplete->setAsync(false);
        $autocomplete->setLanguage('fr');

        return $autocomplete;
    }

    private function mapsPlacesAction()
    {
        $autocomplete = $this->AutoCompleteAction();
        $autocompleteHelper = new AutocompleteHelper();
        echo $autocompleteHelper->renderHtmlContainer($autocomplete);
        echo $autocompleteHelper->renderJavascripts($autocomplete);
    }
}