<?php
require 'model/cityModel.php';
require 'classes/city.class.php';

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

class CityController {

    private $limit = 10;

    function __construct() 
    {          
        $this->objsm =  new CityModel();
    }

    public function mvcHandler($id) 
    {
        $act = isset($_GET['act']) ? $_GET['act'] : NULL;
        switch ($act) 
        {
            case 'details' :                    
                $this->details();
                break;
            case 'insert' :                    
                $this->insert($id);
                break;						
            case 'update':
                $this->update($id);
                break;				
            case 'delete' :					
                $this -> delete($id);
                break;
            case 'filter' :					
                if(isset($_GET['order'])){
                    if($_GET['order'] == 'asc'){
                        $this->filter($id,$_GET['order']);
                    }else{
                        $this->filter($id,$_GET['order']);
                    }
                }else{
                    $this->filter($id,'none');
                }
                break;
            case 'search' :					
                if(isset($_GET['order'])){
                    if($_GET['order'] == 'asc'){
                        $this->search($id,$_GET['order']);
                    }else{
                        $this->search($id,$_GET['order']);
                    }
                }else{
                    $this->search($id,'none');
                }
                break;								
            default:
            if(isset($_GET['order'])){
                if($_GET['order'] == 'asc'){
                    $this->getCities($id,$_GET['order']);
                }else{
                    $this->getCities($id,$_GET['order']);
                }
            }else{
                $this->getCities($id,'none');
            }
        }
    }

    public function currentPage(){
        return isset($_GET['page'])? (int)$_GET['page']:1;
    }

    public function totalPages($id){
        $total = $this->objsm->totalRecords($id);
        $_SESSION['totalPages']=ceil($total / $this->limit);
    }

    public function totalSearch($id,$search){
        $total = $this->objsm->totalSearch($id,$search);
        $_SESSION['totalPages']=ceil($total / $this->limit);
    }

    public function getCities($id,$order){
        $this->totalPages($id);
        $res = $this->objsm->get($id,$order,$this->currentPage(),$this->limit);
        include "view/city/index.php";  
    }

    public function totalFilter($id,$startDate,$endDate){
        $total = $this->objsm->totalFilter($id,$startDate,$endDate);
        $_SESSION['totalPages']=ceil($total / $this->limit);
    }

    public function validate($id,$ids,$name,$radius,$population,$postalCode,$page){
        if($this->emptyInput($name,$radius,$population,$postalCode) !== false){
            header("location: view/city/".$page.".php?countryId=".$ids."&id=".$id."&error=emptyFields");
        }
        if($this->invalidName($name) !== false){
            header("location: view/city/".$page.".php?countryId=".$ids."&id=".$id."&error=invalidName");
        }
        if($this->invalidInteger($radius) !== false){
            header("location: view/city/".$page.".php?countryId=".$ids."&id=".$id."&error=invalidRadius");
        }
        if($this->invalidInteger($population) !== false){
            header("location: view/city/".$page.".php?countryId=".$ids."&id=".$id."&error=invalidPopulation");
        }
        if($this->invalidInteger($postalCode) !== false){
            header("location: view/city/".$page.".php?countryId=".$ids."&id=".$id."&error=invalidPostalCode");
        }
    }

    public function insert($ids){
        if (isset($_POST['insertCity'])) 
        {
            $name = $_POST['name'];
            $radius = $_POST['radius'];
            $population = $_POST['population'];
            $postalCode = $_POST['postalCode'];
            $id=$_GET['id'];
            $this->validate($id,$ids,$name,$radius,$population,$postalCode,'insert');
            if($this->objsm->nameExists($name,$ids) !== false){
                header("location: view/city/insert.php?countryId=".$ids."&id=".$id."&error=nameExists");
            }
            $city = new City($name,$radius,$population,$postalCode);
            // var_dump($city);
            // exit;
            $this->objsm->insert($city,$ids);
            header("location: index.php?countryId=".$ids);
        }else{
            header("location: view/city/insert.php?countryId=".$ids);
        }
    }

    public function delete($cId){
        if (isset($_GET['id'])) 
        {
            $id=$_GET['id'];
            $res=$this->objsm->delete($id);
        }
        header("location: index.php?countryId=".$cId."&msg=success");
    }

    public function update($ids){
        if (isset($_GET['id'])) 
        {
            $id=$_GET['id'];
            $res=$this->objsm->getIt($id);
            if(isset($_POST['updateC'])){
                $name = $_POST['name'];
                $radius = $_POST['radius'];
                $population = $_POST['population'];
                $postalCode = $_POST['postalCode'];
                $this->validate($id,$ids,$name,$radius,$population,$postalCode,'update');
                if($this->objsm->nameExistsWithId($id,$name,$ids) !== false){
                    header("location: view/city/update.php?countryId=".$ids."&id=".$id."&error=nameExists");
                }
                $cityObj = unserialize($_SESSION['cityObj']);
                $cityObj->setName($name);
                $cityObj->setRadius($radius);
                $cityObj->setPopulation($population);
                $cityObj->setPostalCode($postalCode);
                var_dump($cityObj);
                exit;
                $res = $this->objsm->update($cityObj,$id);
                if($res){
                    header("location: index.php?countryId=".$ids."&msg=success");
                }else{
                    header("location: index.php?countryId=".$ids."&msg=failed");
                }
            }else{
                $_SESSION['cityObj']=serialize($res); 
                header("location: view/city/update.php?countryId=".$ids."&id=".$id);
            }
        }
    }

    public function details(){
        if (isset($_GET['id'])) 
        {
            $id=$_GET['id'];
            $res=$this->objsm->getIt($id);
            $_SESSION['cityObj']=serialize($res); 
            header("location: view/city/details.php");
        }
    }

    public function search($id,$order){
        if (isset($_POST['search'])) 
        {
            $_SESSION['search']=$_POST['search'];
            $this->totalSearch($id,$_POST['search']);
            $res = $this->objsm->search($id,$_POST['search'],$order,$this->currentPage(),$this->limit);
            include "view/city/index.php";
        }else{
            $res = $this->objsm->search($id,$_SESSION['search'],$order,$this->currentPage(),$this->limit);
            include "view/city/index.php";
        }
    }

    public function filter($id,$order){
        if (isset($_POST['filter'])) 
        {
            $startDate=date("Ymd", strtotime($_POST['startDate']));
            $endDate=date("Ymd", strtotime($_POST['endDate']));
            if((int)$startDate>(int)$endDate){
               header("location: index.php?error=baddates");
            }
            $_SESSION['startDate']=$startDate;
            $_SESSION['endDate']=$endDate;
            $this->totalFilter($id,$startDate,$endDate);
            $res = $this->objsm->filter($id,$startDate,$endDate,$order,$this->currentPage(),$this->limit);
            include "view/city/index.php";
        }else{
            $res = $this->objsm->filter($id,$_SESSION['startDate'],$_SESSION['endDate'],$order,$this->currentPage(),$this->limit);
            include "view/city/index.php";
        }
    }

    function emptyInput($name,$radius,$population,$postalCode){
        $result;
        if(empty($name) || empty($radius) || empty($population) || empty($postalCode)){
            $result = true;
        }else{
            $result = false;
        }
    
        return $result;
    }
    
    function invalidName($name){
        $result;
        if(!preg_match("/^[a-zA-z]*$/", $name)){
            $result = true;
        }else{
            $result = false;
        }
    
        return $result;
    }

    function invalidInteger($var){
        $result;
        if(!preg_match("/^[0-9]*$/", $var)){
            $result = true;
        }else{
            $result = false;
        }
    
        return $result;
    }
}