<?php
    require '../../classes/country.class.php';
    session_start();
    $countryObj= isset($_SESSION['countryObj'])?unserialize($_SESSION['countryObj']):new Country();
    include('../../header.php');
    echo '<h2>'.$countryObj->getName().'</h2>';