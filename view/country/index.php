<h2>Countries list</h2>
<?php
$pages = $_SESSION['totalPages'];
if(isset($_GET['msg'])){
  if($_GET['msg'] == "success"){
    echo '<p class="alert alert-success">Success!</p>';
  }
}
if(isset($_GET['error'])){
  if($_GET['error'] == "baddates"){
    echo '<p class="alert alert-danger">Bad selected dates!</p>';
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
              echo '<a href="index.php?order=asc&act='.$_GET['act'].'">';
            }else{
             echo '<a href="index.php?order=asc">';
            }?>
              <i class="arrow up"></i>
            </a>
            </div>
            <div>
            <?php 
            if(isset($_GET['act'])){
              echo '<a href="index.php?order=desc&act='.$_GET['act'].'">';
            }else{echo '<a href="index.php?order=desc">';}?>
              <i class="arrow down">
              </i>
            </a>
            </div>
          </div>
        </div>
      </th>
      <th scope="col">Radius</th>
      <th scope="col">Population</th>
      <th scope="col">Phone code</th>
      <th scope="col">Created</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
    <form action="index.php?act=filter" method="post">
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
            echo '<td>'.$row['phoneCode'].'</td>';
            echo '<td>'.$row['created'].'</td>';
            echo '<td> <a href="index.php?act=details&id='.$row['id'].'">Details</a> <a href="index.php?act=update&id='.$row['id'].'">Edit</a> <a href="index.php?act=delete&id='.$row['id'].'">Remove</a></td>';
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
                  echo '<a class="page" href="index.php?page='.$i.'&act='.$_GET['act'].'&order='.$_GET['order'].'">'.$i.'</a>';
                }else{
                  echo '<a class="page" href="index.php?page='.$i.'&act='.$_GET['act'].'">'.$i.'</a>';
                }
              }
            }else{
              for($i=1; $i<=$pages; $i++){
                echo '<a class="page" href="index.php?page='.$i.'">'.$i.'</a>';
              }
            }
          }
        ?>
      </td>
        <td colspan="5">
        <div class="float-right">
           <a class="btn btn-primary" href="index.php?act=insert">Add Country</a>
        </div>
        </td>
    </tr>
  </tbody>
</table>

<?php include('footer.php'); ?>