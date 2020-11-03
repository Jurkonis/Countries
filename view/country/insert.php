<?php include('../../header.php'); ?>
<h2>Insert Country</h2>

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
    <form action="../../index.php?act=insert" method="post">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Country name</label>
            <div class="col-sm-5">
            <input type="text" name="name" class="form-control" placeholder="Country name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Radius</label>
            <div class="col-sm-5">
            <input type="number" name="radius" class="form-control" placeholder="Radius">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Population</label>
            <div class="col-sm-5">
            <input type="number" name="population" class="form-control" placeholder="Population">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone code</label>
            <div class="col-sm-5">
            <input type="text" name="phoneCode" class="form-control" placeholder="Phone code">
            </div>
        </div>
        <input type="submit" name="insert" class="btn btn-primary" value="Submit">
    </form>

<?php include('../../footer.php'); ?>