<?php
class Mvc {

    function __construct() 
    {          
        $this->countryCntrl = new CountryController();
        $this->cityCntrl = new CityController();
    }

    public function mvcHandler() 
    {
        if(isset($_GET['countryId'])){
            $this->cityCntrl->mvcHandler($_GET['countryId']);
        }else{
            $this->countryCntrl->mvcHandler();
        }
    }
}