<?php
$countryObj= isset($_SESSION['countryObj'])?unserialize($_SESSION['countryObj']):new Country();
echo '<h2>List of cities in '.$countryObj->getName().'</h2>';
$pages = $_SESSION['totalPages'];
if(isset($_GET['msg'])){
  if($_GET['msg'] == "success"){
    echo '<p class="alert alert-success">Success!</p>';
  }
}
?>
<table class="table">
  <thead class="thead-dark">
    <tr>
    <th scope="col">
        <div class="flex">
          Name 
          <div class="to-right">
            <div>
            <?php
            if(isset($_GET['act'])){
              echo '<a href="index.php?countryId='.$_GET['countryId'].'&order=asc&act='.$_GET['act'].'">';
            }else{
             echo '<a href="index.php?countryId='.$_GET['countryId'].'&order=asc">';
            }?>
              <i class="arrow up"></i>
            </a>
            </div>
            <div>
            <?php 
            if(isset($_GET['act'])){
              echo '<a href="index.php?countryId='.$_GET['countryId'].'&order=desc&act='.$_GET['act'].'">';
            }else{echo '<a href="index.php?countryId='.$_GET['countryId'].'&order=desc">';}?>
              <i class="arrow down">
              </i>
            </a>
            </div>
          </div>
        </div>
      </th>
     <th scope="col">Radius</th>
      <th class="th-sm" scope="col">Population</th>
      <th scope="col">Postal code</th>
      <th scope="col">Created</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <?php echo '<form action="index.php?countryId='.$_GET['countryId'].'&act=filter" method="post">';?>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <span class="input-group-text" id="">Start and end dates</span>
        </div>
        <input type="date" name="startDate" class="form-control">
        <input type="date" name="endDate" class="form-control" >
      </div>
      <input type="submit" name="filter" class="btn btn-primary  mb-3" value="Filter">
    </form>
  <tbody>
  <?php
    while($row = $res->fetch()){
        echo '<tr>';
            echo '<td>'.$row['name'].'</td>';
            echo '<td>'.$row['radius'].'</td>';
            echo '<td>'.$row['population'].'</td>';
            echo '<td>'.$row['postalCode'].'</td>';
            echo '<td>'.$row['created'].'</td>';
            echo '<td> <a href="index.php?countryId='.$_GET['countryId'].'&act=update&id='.$row['id'].'">Edit</a> <a href="index.php?countryId='.$_GET['countryId'].'&act=delete&id='.$row['id'].'">Remove</a></td>';
        echo '</tr>';
    }
    ?>
    <tr>
      <td>
        <?php 
        if($pages>1){
          if(isset($_GET['act'])){
            for($i=1; $i<=$pages; $i++){
              if(isset($_GET['order'])){
                echo '<a class="page" href="index.php?countryId='.$_GET['countryId'].'&page='.$i.'&act='.$_GET['act'].'&order='.$_GET['order'].'">'.$i.'</a>';
              }else{
                echo '<a class="page" href="index.php?countryId='.$_GET['countryId'].'&page='.$i.'&act='.$_GET['act'].'">'.$i.'</a>';
              }
            }
          }else{
            for($i=1; $i<=$pages; $i++){
            echo '<a class="page" href="index.php?countryId='.$_GET['countryId'].'&page='.$i.'">'.$i.'</a>';
            }
          }
        }
        ?>
      </td>
      <td colspan="5">
      <div class="float-right">
      <?php
          echo '<a class="btn btn-primary" href="index.php?countryId='.$_GET['countryId'].'&act=insert">Add City</a>';
          ?>
      </div>
      </td>
    </tr>
  </tbody>
</table>

<?php include('footer.php'); ?>