<?php
require 'model/countryModel.php';
require 'classes/country.class.php';

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

class CountryController {

    private $limit = 10;

    function __construct() 
    {          
        $this->objsm =  new countryModel();
    }

    public function mvcHandler() 
    {
        $act = isset($_GET['act']) ? $_GET['act'] : NULL;
        switch ($act) 
        {
            case 'details' :                    
                $this->details();
                break;
            case 'insert' :                    
                $this->insert();
                break;						
            case 'update':
                $this->update();
                break;				
            case 'delete' :					
                $this -> delete();
                break;
            case 'filter' :					
                if(isset($_GET['order'])){
                    if($_GET['order'] == 'asc'){
                        $this->filter($_GET['order']);
                    }else{
                        $this->filter($_GET['order']);
                    }
                }else{
                    $this->filter('none');
                }
                break;
            case 'search' :					
                if(isset($_GET['order'])){
                    if($_GET['order'] == 'asc'){
                        $this->search($_GET['order']);
                    }else{
                        $this->search($_GET['order']);
                    }
                }else{
                    $this->search('none');
                }
                break;								
            default:
            if(isset($_GET['order'])){
                if($_GET['order'] == 'asc'){
                    $this->getCountries($_GET['order']);
                }else{
                    $this->getCountries($_GET['order']);
                }
            }else{
                $this->getCountries('none');
            }
        }
    }

    public function currentPage(){
        return isset($_GET['page'])? (int)$_GET['page']:1;
    }

    public function totalPages(){
        $total = $this->objsm->totalRecords();
        $_SESSION['totalPages']=ceil($total / $this->limit);
    }

    public function totalSearch($search){
        $total = $this->objsm->totalSearch($search);
        $_SESSION['totalPages']=ceil($total / $this->limit);
    }

    public function totalFilter($startDate,$endDate){
        $total = $this->objsm->totalFilter($startDate,$endDate);
        $_SESSION['totalPages']=ceil($total / $this->limit);
    }

    public function getCountries($order){
        $this->totalPages();
        $res = $this->objsm->get($order,$this->currentPage(),$this->limit);
        include "view/country/index.php";  
    }

    public function validate($id,$name,$radius,$population,$phoneCode,$page){
        if($this->emptyInput($name,$radius,$population,$phoneCode) !== false){
            header("location: view/country/".$page.".php?error=emptyFields&id=".$id."");
        }
        if($this->invalidName($name) !== false){
            header("location: view/country/".$page.".php?error=invalidName&id=".$id."");
        }
        if($this->invalidInteger($radius) !== false){
            header("location: view/country/".$page.".php?error=invalidRadius&id=".$id."");
        }
        if($this->invalidInteger($population) !== false){
            header("location: view/country/".$page.".php?error=invalidPopulation&id=".$id."");
        }
        if($this->invalidInteger($phoneCode) !== false){
            header("location: view/country/".$page.".php?error=invalidPhoneCode&id=".$id."");
        }
    }

    public function insert(){
        if (isset($_POST['insert'])) 
        {
            $name = $_POST['name'];
            $radius = $_POST['radius'];
            $population = $_POST['population'];
            $phoneCode = $_POST['phoneCode'];
            $id= $_GET['id'];
            $this->validate($id,$name,$radius,$population,$phoneCode,'insert');
            if($this->objsm->nameExists($name) !== false){
                header("location: view/country/insert.php?error=nameExists&id=".$id."");
            }
            $country = new Country($name,$radius,$population,$phoneCode);
            // var_dump($country);
            // exit;
            $this->objsm->insert($country);
            header("location: index.php");
        }else{
            header("location: view/country/insert.php");
        }
    }

    public function delete(){
        if (isset($_GET['id'])) 
        {
            $id=$_GET['id'];
            $res=$this->objsm->delete($id);
        }
        header("location: index.php?msg=success");
    }

    public function update(){
        if (isset($_GET['id'])) 
        {
            $id=$_GET['id'];
            $res=$this->objsm->getIt($id);
            if(isset($_POST['update'])){
                $name = $_POST['name'];
                $radius = $_POST['radius'];
                $population = $_POST['population'];
                $phoneCode = $_POST['phoneCode'];
                $this->validate($id,$name,$radius,$population,$phoneCode,'update');
                $countryObj = unserialize($_SESSION['countryObj']);
                $countryObj->setName($name);
                $countryObj->setRadius($radius);
                $countryObj->setPopulation($population);
                $countryObj->setPhoneCode($phoneCode);
                if($this->objsm->nameExistsWithId($id,$name) !== false){
                    header("location: view/country/update.php?error=nameExists");
                }
                // var_dump($countryObj);
                // exit;
                $res = $this->objsm->update($countryObj,$id);
                if($res){
                    header("location: index.php?msg=success");
                }else{
                    header("location: index.php?msg=failed");
                }
            }else{
                $_SESSION['countryObj']=serialize($res); 
                header("location: view/country/update.php?id=".$id);
            }
        }
    }

    public function details(){
        if (isset($_GET['id'])) 
        {
            $id=$_GET['id'];
            $res=$this->objsm->getIt($id);
            $_SESSION['countryObj']=serialize($res); 
            header("location: index.php?countryId=".$id);
        }
    }

    public function search($order){
        if (isset($_POST['search'])) 
        {
            $_SESSION['search']=$_POST['search'];
            $this->totalSearch($_POST['search']);
            $res = $this->objsm->search($_POST['search'],$order,$this->currentPage(),$this->limit);
            include "view/country/index.php";
        }else{
            $res = $this->objsm->search($_SESSION['search'],$order,$this->currentPage(),$this->limit);
            include "view/country/index.php";
        }
    }

    public function filter($order){
        if (isset($_POST['filter'])) 
        {
            $startDate=date("Ymd", strtotime($_POST['startDate']));
            $endDate=date("Ymd", strtotime($_POST['endDate']));
            if((int)$startDate>(int)$endDate){
               header("location: index.php?error=baddates");
            }
            $_SESSION['startDate']=$startDate;
            $_SESSION['endDate']=$endDate;
            $this->totalFilter($startDate,$endDate);
            $res = $this->objsm->filter($startDate,$endDate,$order,$this->currentPage(),$this->limit);
            include "view/country/index.php";
        }else{
            $res = $this->objsm->filter($_SESSION['startDate'],$_SESSION['endDate'],$order,$this->currentPage(),$this->limit);
            include "view/country/index.php";
        }
    }

    function emptyInput($name,$radius,$population,$phoneCode){
        $result;
        if(empty($name) || empty($radius) || empty($population) || empty($phoneCode)){
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