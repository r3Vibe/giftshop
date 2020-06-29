<?php include "../includes/db.php"; ?>
<?php session_start();?>
<?php 
  $session_status = false;
  if(isset($_SESSION['user'])){
    $session_status = true;
  }else{
      header("Location: ../login/");
  }
?>
<?php
if(isset($_GET['productid'])){
    $pid = $_GET['productid'];
    $query = "SELECT * FROM products WHERE id = '$pid'";
    $result = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($result)){
        $image = $row['image'];
        $name = $row['name'];
        $productid = $row['productid'];
        $price = $row['price'];
    }
}
?>
<?php
$user = $_SESSION['user'];
$query = "SELECT * FROM users WHERE name = '{$user}'";
$result = mysqli_query($conn,$query);
if(!$result){
    die("error");
}
while($row = mysqli_fetch_assoc($result)){
    $name = $row['fname'];
    $address = $row['address'];
    $contact = $row['contact'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/all.min.css"> 
  <script src="../jq/jq.js"></script>
  <script src="../jq/bootstrap.js"></script>
  <script src="../jq/style.js"></script>
  <title>Purchase</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg dark">
        <a class="navbar-brand" href="../">Rever Design</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <?php 
              if(!$session_status){
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="../login/" tabindex="-1"><i class="fas fa-sign-in-alt"></i> Login</a>';
                echo '</li>';
              }else if($session_status){
                echo '<li class="nav-item dropdown">';
                echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                echo $_SESSION['user'];
                echo '</a>';
                echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                echo '<a class="dropdown-item" href="../logout/">Logout</a>';
                echo '<div class="dropdown-divider"></div>';
                if($_SESSION['role'] == 'admin'){
                  echo '<a class="dropdown-item" href="../admin/">Admin panel</a>';
                }else if($_SESSION['role'] == 'customer'){
                  echo '<a class="dropdown-item" href="../client/">Client Area</a>';
                }
                echo '<div class="dropdown-divider"></div>';
                echo '<a class="dropdown-item" href="../sett/">Settings</a>';
                echo '</div>';
                echo '</li>';
              }
            ?>

          </ul>
        </div>
  </nav>
  <div class="container">
      <div class="col-md-6" style="padding: 50px;">
          <div class="proimg" style="background-image: url('<?php echo $image; ?>');"></div>
          <p class="productdetails" style="margin-top: 10px;">Name: <?php echo $name; ?></p>
          <p class="productdetails">ID: <?php echo $productid; ?></p>
          <p class="productdetails">Price: <i class="fas fa-rupee-sign"></i><?php echo $price; ?></p>
      </div>
      <div class="col-md-6">
            <p>test</p>
      </div>
  </div>
</body>
</html>