<?php

class Country {

    public $name;
    public $radius;
    public $population;
    public $phoneCode;
    public $created;

    public function __construct($name,$radius,$population,$phoneCode){
        $this->name = $name;
        $this->radius = $radius;
        $this->population = $population;
        $this->phoneCode = $phoneCode;
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
    
    public function setPhoneCode($phoneCode){
        $this->phoneCode=$phoneCode;
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
    
    public function getPhoneCode(){
        return $this->phoneCode;
    }

    public function getCreated(){
        return $this->created;
    }
}
