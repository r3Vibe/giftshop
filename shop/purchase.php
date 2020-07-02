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
        $category = $row['category'];
        $productid = $row['productid'];
        $price = $row['price'];
    }
}
?>
<?php
$user = $_SESSION['user'];
$query = "SELECT * FROM users WHERE uname = '{$user}'";
$result = mysqli_query($conn,$query);
if(!$result){
    die("error");
}
while($row = mysqli_fetch_assoc($result)){
    $cname = $row['fname'];
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
  <div class="mycontainer">
    <div class="myrow">
      <div class="mycol">
        <h1>Product Details</h1>
        <div class="proimg" style="background-image: url(<?php echo $image; ?>);"></div>
        <p class="details" style="margin-top: 15px;">Product: <?php echo $name; ?></p>
        <p class="details">Category: <?php echo $category; ?></p>
        <p class="details">ID: <?php echo $productid; ?></p>
      </div>
      <div class="mycol">
        <h1>Pricing Details</h1>
        <p class="details"><input type="number" name="qt" id="qt" placeholder="Enter Required Quantity"></p>
        <p class="details">Price: <i class="fas fa-rupee-sign"></i><?php echo $price; ?></p>
        <p class="details">Total: <span class="total"><i class="fas fa-rupee-sign"></i>0</span></p>
      </div>
      <div class="mycol">
        <h1>Existing Address</h1>
        <p class="details">
          <label for="deladdr" style="margin-right: 5px;" >Use Existing</label>
          <span><input type="radio" name="deladdr" id="deladdr" style="width: auto;" value="exists"></span>
        </p>
        <p class="details">Customer: <?php echo $cname ; ?></p>
        <p class="details">Contact: <?php echo $contact ; ?></p>
        <p class="details">Address: <?php echo $address ; ?></p>
      </div>
      <div class="mycol">
        <h1>New Address</h1>
        <p class="details">
          <label for="deladdr" style="margin-right: 5px;" >Use New</label>
          <span><input type="radio" name="deladdr" id="deladdr" style="width: auto;" value="new"></span>
        </p>
        <p class="details">Customer: <?php echo $cname ; ?></p>
        <p class="details"><input type="tel" name="newno" id="newno" placeholder="Enter Contact Number" disabled></p>
        <p class="details"><textarea name="newaddress" id="newaddress" cols="30" rows="10" disabled placeholder="Enter Delivery Address"></textarea></p>
      </div>
    </div>
    <div class="myrow">
      <button class="btn btn-success" id="cnfbtn">Confirm Details</button>
    </div>
  </div>
  <script>
    $("#qt").keyup(function(){
      var qt = $("#qt").val();
      var price = '<?php echo $price; ?>';
      var subtotal = qt * price;
      $(".total").html('<i class="fas fa-rupee-sign"></i>'+subtotal);
    });
    $(document).ready(function(){
      $("input[type='radio']").click(function(){
        var values = $("input[type='radio']:checked").val();
        if(values == "new"){
          $("#newno").removeAttr("disabled");
          $("#newaddress").removeAttr("disabled");
        }else if(values == "exists"){
          $("#newno").attr("disabled","true");
          $("#newaddress").attr("disabled","true");
        }
      });
    });
    $("#cnfbtn").click(function(){
      var product = '<?php echo $name;?>';
      var productid = '<?php echo $productid;?>';
      var price = '<?php echo $price;?>';
      var qt = $("#qt").val();
      var subtotal = qt * price;
      if(qt == ""){
        $("#qt").css("border-bottom","2px solid red");
        alert("Please Enter Required Quantity");
      }else{
        $("#qt").css("border-bottom","2px solid black");
        var values = $("input[type='radio']:checked").val();
        if(values == "new"){
          var customer = '<?php echo $cname;?>';
          var contact = $("#newno").val();
          var address = $("#newaddress").val();
        }else if(values == "exists"){
          var customer = '<?php echo $cname;?>';
          var contact = '<?php echo $contact;?>';
          var address = '<?php echo $address;?>';
        }
      }
    });
  </script>
</body>
</html>