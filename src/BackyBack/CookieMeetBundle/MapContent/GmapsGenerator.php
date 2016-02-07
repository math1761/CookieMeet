<?php

/**
 * Created by PhpStorm.
 * User: math1761
 * Date: 01/02/2016
 * Time: 13:02
 */

namespace BackyBack\CookieMeetBundle\MapContent\Gmaps;

use BackyBack\CookieMeetBundle\Controller\MapController as Mappy;
use Ivory\GoogleMap\Places\Autocomplete;
use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;
use Ivory\GoogleMap\Places\AutocompleteType;
use Ivory\GoogleMap\Helper\Places\AutocompleteHelper;

class GmapsGenerator extends Mappy
{
    /**
     * @return Autocomplete
     * @throws \Ivory\GoogleMap\Exception\AssetException
     * @throws \Ivory\GoogleMap\Exception\PlaceException
     */
    protected function AutoCompleteAction()
    {
        $autocomplete = new Autocomplete();

        $autocomplete->setPrefixJavascriptVariable('place_autocomplete_');
        $autocomplete->setInputId('place_input');

        $autocomplete->setInputAttributes(array('class' => 'my-class'));
        $autocomplete->setInputAttribute('class', 'my-class');

        $autocomplete->setValue('foo');

        $autocomplete->setTypes(array(AutocompleteType::ESTABLISHMENT));
        $autocomplete->setComponentRestrictions(array(AutocompleteComponentRestriction::COUNTRY => 'fr'));
        $autocomplete->setBound(-2.1, -3.9, 2.6, 1.4, true, true);

        $autocomplete->setAsync(false);
        $autocomplete->setLanguage('en');

        return $autocomplete;
    }

    protected function mapsPlacesAction() {
        $autocomplete = $this->AutoCompleteAction();
        $autocompleteHelper = new AutocompleteHelper();
        echo $autocompleteHelper->renderHtmlContainer($autocomplete);
        echo $autocompleteHelper->renderJavascripts($autocomplete);
    }

    protected function getmygeolocationAction() {
        $geolocation = $this->get('jeroendesloovere.geolocation');

        $result = $geolocation::getAddress(51.0363935, 3.7121008);

        echo 'Coordinates = ' . $result['latitude'] . ', ' . $result['longitude'] . '<br/>';

        echo 'Address = ' . $result['label'] . '<br/>';
    }

}