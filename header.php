<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(strpos($url, 'view') !== false){
            echo '<link rel="stylesheet" href="../../style.css">';
        }else{
            echo '<link rel="stylesheet" href="style.css">';
        }
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/4.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
<?php
$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(strpos($url, 'view') !== false){
    echo '<a class="navbar-brand" href="../../index.php">Home</a>';
}else{
    echo '<a class="navbar-brand" href="index.php">Home</a>';
}
if(isset($_GET['countryId'])){
    ?>
    <div class="search-container">
    <form action="index.php?act=search&countryId=<?php echo $_GET['countryId'] ?>" method="post">
        <div class="searchbar">
          <input class="search_input" type="text" name="search" placeholder="Search...">
          <a class="search_icon"><i class="fas fa-search"></i></a>
        </div>
    </form>
  </div>
  <?php
}else{
    ?>
    <div class="search-container">
    <form action="index.php?act=search" method="post">
        <div class="searchbar">
          <input class="search_input" type="text" name="search" placeholder="Search...">
          <a class="search_icon"><i class="fas fa-search"></i></a>
        </div>
    </form>
  </div>
  <?php
}
?>

</nav>
<div class="wrapper">