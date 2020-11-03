<?php 
    include 'header.php';
    include 'includes/autoloader.inc.php';
    $mvc = new Mvc();
    $cityCntrl = new CityController();
    $mvc->mvcHandler();
    
?>
<?php include('footer.php'); ?>