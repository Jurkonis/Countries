<?php
    require '../../classes/city.class.php';
    session_start();
    $cityObj= isset($_SESSION['cityObj'])?unserialize($_SESSION['cityObj']):newCcity();
    include('../../header.php');
    echo '<h2>Update '.$cityObj->getName().'</h2>';
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
        }else if($_GET["error"] == "invalidPostalCode"){
            echo "Invalid postal code!";
        }else if($_GET["error"] == "nameExists"){
            echo "Name already exists!";
        }
        echo '</p>';
    }
    echo '<form action="../../index.php?countryId='.$_GET['countryId'].'&act=update&id='.$_GET['id'].'" method="post">';
?>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">City name</label>
            <div class="col-sm-5">
            <input type="text" name="name" class="form-control" value="<?php echo $cityObj->getName() ?>" placeholder="Country name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Radius</label>
            <div class="col-sm-5">
            <input type="number" name="radius" class="form-control" value="<?php echo $cityObj->getRadius() ?>" placeholder="Radius">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Population</label>
            <div class="col-sm-5">
            <input type="number" name="population" class="form-control" value="<?php echo $cityObj->getPopulation() ?>" placeholder="Population">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Postal code</label>
            <div class="col-sm-5">
            <input type="text" name="postalCode" class="form-control" value="<?php echo $cityObj->getPostalCode() ?>" placeholder="Postal code">
            </div>
        </div>
        <input type="submit" name="updateC" class="btn btn-primary" value="Submit">
    </form>

<?php include('../../footer.php'); ?>