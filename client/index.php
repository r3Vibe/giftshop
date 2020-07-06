<?php include "../includes/db.php"; ?>
<?php session_start();?>
<?php 
  $session_status = false;
  if(isset($_SESSION['user'])){
    $session_status = true;
    $role = $_SESSION['role'];
    if($role !== 'customer'){
      header("Location: ../admin/");
    }
  }else{
    header("Location: ../");
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
  <title>Client Area</title>
</head>
<body>
  <div class="allmsgbg"></div>
  <div class="allmsg">
  </div>
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
  <div class="wrapper">
      <button class="btn btn-success" id="home">Home</button>
      <button class="btn btn-success" id="shop">Shop</button>
      <button class="btn btn-success" id="orderlist">My Orders</button>
      <button class="btn btn-success" id="track">Track Order</button>
      <button class="btn btn-success" id="chat">Chat</button>
      <button class="btn btn-success" id="suggest">Suggestions</button>
  </div>
  <div class="content">
    <div class="wrapperforitems homec">
      <h1 style="padding-top: 15px;">Client Area</h1>
      <h2 style="padding-top: 15px; text-transform:Capitalize;">
        <?php
          $query = "SELECT * FROM users WHERE uname = '{$_SESSION["user"]}'";
          $result = mysqli_query($conn,$query);
          while($row= mysqli_fetch_assoc($result)){
            $fname = $row['fname'];
          }
          echo "Welcome $fname";
        ?>
      </h2>
      <p>
        <ul>
          <?php
            $query = "SELECT * FROM products WHERE status = 'active' AND quantity <= 5";
            $result = mysqli_query($conn,$query);
            if(!$result){
              die();
            }else{
              while($row = mysqli_fetch_assoc($result)){
                $name = $row['name'];
                echo '<li class="redmsg">'.$name.' is low On Stock</li>';
              }
            }
          ?>
        </ul>
      </p>
    </div>
    <div class="wrapperforitems orderlistc" style="display: none;">
      <h1 style="padding-top: 15px;">Order List</h1>
      <p class="table-holder">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Order ID</th>
                <th scope="col">Product</th>
                <th scope="col">ID</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $usser = $_SESSION["user"];
                $query = "SELECT * FROM users WHERE uname = '{$usser}'";
                $result = mysqli_query($conn,$query);
                if(!$result){
                  die("error");
                }else{
                  while($row = mysqli_fetch_assoc($result)){
                    $cont = $row['contact'];
                  }
                }
                $query = "SELECT * FROM orderlistt WHERE contact = '{$cont}' AND status = 'delivered'";
                $result = mysqli_query($conn,$query);
                if(!$result){
                  die("error");
                }else{
                  while($row= mysqli_fetch_assoc($result)){
                    $order_id = $row['order_id'];
                    $product = $row['product'];
                    $productid = $row['product_id'];
                    $id = $row['id'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $subtotal = $row['subtotal'];
                    $status = $row['status'];
                    $date = $row['date'];
                    echo '<tr>';
                    echo '<th scope="row"><input type="radio" name="id" id="id" value="'.$id.'"></th>';
                    echo '<th>'.$order_id.'</th>';
                    echo '<th>'.$product.'</th>';
                    echo '<th>'.$productid.'</th>';
                    echo '<th><i class="fas fa-rupee-sign"></i> '.$price.'</th>';
                    echo '<th>'.$quantity.'</th>';
                    echo '<th><i class="fas fa-rupee-sign"></i> '.$subtotal.'</th>';
                    echo '<th>'.$status.'</th>';
                    echo '<th>'.$date.'</th>';
                    echo '</tr>';
                  }
                }
              ?>
              
            </tbody>
          </table>
      </p>
    </div>
    <div class="wrapperforitems trackc" style="display: none;">
      <h1 style="padding-top: 15px;">Track Order</h1>
      <p class="table-holder">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Order ID</th>
                <th scope="col">Product</th>
                <th scope="col">Status</th>
                <th scope="col">Work In Progress</th>
                <th scope="col">Date</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $usser = $_SESSION["user"];
                $query = "SELECT * FROM users WHERE uname = '{$usser}'";
                $result = mysqli_query($conn,$query);
                if(!$result){
                  die("error");
                }else{
                  while($row = mysqli_fetch_assoc($result)){
                    $cont = $row['contact'];
                  }
                }
                $query = "SELECT * FROM orderlistt WHERE contact = '{$cont}' AND status = 'processing' OR status = 'confirmed' OR status = 'complete' OR status = 'shipped'";
                $result = mysqli_query($conn,$query);
                if(!$result){
                  die("error");
                }else{
                  while($row= mysqli_fetch_assoc($result)){
                    $order_id = $row['order_id'];
                    $product = $row['product'];
                    $id = $row['id'];
                    $status = $row['status'];
                    $date = $row['date'];
                    echo '<tr>';
                    echo '<th scope="row"><input type="radio" name="id" id="id" value="'.$id.'"></th>';
                    echo '<th>'.$order_id.'</th>';
                    echo '<th>'.$product.'</th>';
                    echo '<th>'.$status.'</th>';
                    if($status == "processing"){
                      echo '<th>Order Received</th>';
                    }
                    echo '<th>'.$date.'</th>';
                    echo '</tr>';
                  }
                }
              ?>
              
            </tbody>
          </table>
      </p>
    </div>
    <div class="wrapperforitems chatc" style="display: none;">
      <h1 style="padding-top: 15px;">Chat</h1>
    </div>
    <div class="wrapperforitems suggestc" style="display: none;">
      <h1 style="padding-top: 15px;">Suggestions</h1>
    </div>
  </div>
<script>
</script>
</body>
</html>