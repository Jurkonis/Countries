<?php

class City{

    public $name;
    public $radius;
    public $population;
    public $postalCode;
    public $created;

    public function __construct($name,$radius,$population,$postalCode){
        $this->name = $name;
        $this->radius = $radius;
        $this->population = $population;
        $this->postalCode = $postalCode;
    }

    public function setName($name){
        $this->name=$name;
    }

    public function setRadius($radius){
        $this->radius=$radius;
    }

    public function setPopulation($population){
        $this->population=$population;
    }
    
    public function setPostalCode($postalCode){
        $this->postalCode=$postalCode;
    }

    public function getName(){
        return $this->name;
    }

    public function getRadius(){
        return $this->radius;
    }

    public function getPopulation(){
        return $this->population;
    }
    
    public function getPostalCode(){
        return $this->postalCode;
    }

    public function getCreated(){
        return $this->created;
    }
}