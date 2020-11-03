<?php
    require '../../classes/country.class.php';
    session_start();
    $countryObj= isset($_SESSION['countryObj'])?unserialize($_SESSION['countryObj']):new Country();
    include('../../header.php');
    echo '<h2>Update '.$countryObj->getName().'</h2>';
?>

<?php
    if(isset($_GET['error'])){
        echo '<p class="alert alert-danger">';
        if($_GET["error"] == "emptyFields"){
            echo "Fill in all fields!";
        }else if($_GET["error"] == "invalidName"){
            echo "Invalid name!";
        }else if($_GET["error"] == "invalidRadius"){
            echo "Invalid radius!";
        }else if($_GET["error"] == "invalidPopulation"){
            echo "Invalid population!";
        }else if($_GET["error"] == "invalidPhoneCode"){
            echo "Invalid phone code!";
        }else if($_GET["error"] == "nameExists"){
            echo "Name already exists!";
        }
        echo '</p>';
    }
?>
    <form action="../../index.php?act=update&id=<?php echo $_GET['id'] ?>" method="post">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Country name</label>
            <div class="col-sm-5">
            <input type="text" name="name" class="form-control" value="<?php echo $countryObj->getName() ?>" placeholder="Country name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Radius</label>
            <div class="col-sm-5">
            <input type="number" name="radius" class="form-control" value="<?php echo $countryObj->getRadius() ?>" placeholder="Radius">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Population</label>
            <div class="col-sm-5">
            <input type="number" name="population" class="form-control" value="<?php echo $countryObj->getPopulation() ?>" placeholder="Population">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone code</label>
            <div class="col-sm-5">
            <input type="text" name="phoneCode" class="form-control" value="<?php echo $countryObj->getPhoneCode() ?>" placeholder="Phone code">
            </div>
        </div>
        <input type="submit" name="update" class="btn btn-primary" value="Submit">
    </form>

<?php include('../../footer.php'); ?>