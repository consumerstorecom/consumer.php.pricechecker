<?php

/**
 * Pricechecker
 */
class pricechecker
{
    public $apikey = '';
    public $countries = array("de", "es", "fr", "it", "uk");

    /**
     * Default construct
     *
     * @param string $apikey
     */
    function __construct($apikey)
    {
        $this->apikey = $apikey;
    }

    /**
     * Check the price for a product in a country, using the EAN as ID
     *
     * @param int $ean
     * @param string $countryIso
     * @return void
     */
    function checkPrice($ean, $countryIso)
    {
        if(!in_array($countryIso, $this->countries))
        {
            return "INCORRECT_COUNTRY";
        } else if(!preg_match("/^[0-9]{13}$/", $ean)) {
            return "INCORRECT_EAN";
        } else {
            $result = file_get_contents("https://www.consumerstore.com/api/?apikey=".$this->apikey."&method=product.getprice&market=".$countryIso."&ean=".$ean);
            return $result;
        }
    }
}

?>