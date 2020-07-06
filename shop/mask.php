<?php include "../includes/db.php"; ?>
<?php session_start();?>
<?php 
  $session_status = false;
  if(isset($_SESSION['user'])){
    $session_status = true;
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
  <title>Admin Panel</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
  <div class="container-fluid" style="padding-top:25px;">
      <div class="row" style="text-align: center;">
        <?php
          $query = "SELECT * FROM products WHERE status = 'active' AND category = 'mask'";
          $result = mysqli_query($conn,$query);
          if(!$result){
            die("Error Getting Category...");
          }else{
            while($row = mysqli_fetch_assoc($result)){
              $name = $row['name'];
              $id = $row['id'];
              $price_range = $row['price'];
              $image = $row['image'];
              $pid = $row['productid'];
              $qt = $row['quantity'];
              echo '<input type="hidden" name="id" value="'.$id.'">';
              echo '<div class="col-md-3 col-sm-12">';
              echo '<div class="card" style="width: 18rem;">';
              echo '<img src="'.$image.'" class="card-img-top" alt="..." style="width: 18rem; height:12rem;">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">'.$name.'</h5>';
              echo '<p class="card-text" style="text-align:left">
              ID: '.$pid.'<br>
              Price: <i class="fas fa-rupee-sign"></i> '.$price_range.'<br>
              Available: '.$qt.'</p>';
              echo '<a href="purchase.php?productid='.$id.'" class="btn btn-success">Buy</a>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          }
        ?>
      </div>
</body>
</html>