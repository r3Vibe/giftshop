<?php include "../includes/db.php"; ?>
<?php session_start();?>
<?php 
  $session_status = false;
  if(isset($_SESSION['user'])){
    $session_status = true;
    $role = $_SESSION['role'];
    if($role !== 'admin'){
      header("Location: ../client/");
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
  <title>Add Product</title>
</head>
<body>
  <div class="allmsgbg"></div>
  <div class="allmsg"></div>
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
      <button class="btn btn-success" id="product">Products</button>
      <button class="btn btn-success" id="category">Categories</button>
      <button class="btn btn-success" id="order">Orders</button>
      <button class="btn btn-success" id="orderl">Order List</button>
      <button class="btn btn-success" id="msg">Messages</button>
  </div>
  <div class="content" style="padding:25px;" id="form">
      <div class="row">
          <div class="col-md-4">
              <form action="some.php" method="post" id="imgfrm">
                <h2>Upload Image</h2>
                <div class="image"></div>
                <input type="file" name="imgae" id="imgae" class="form-control-file">
                <button class="btn btn-success" style="width: 75%;" id="upload">Upload</button>
              </form>
          </div>
          <div class="col-md-4">
              <form action="some.php" method="post" id="gend">
                <h2>General Details</h2>
                <input type="hidden" name="image" value="" id="hidimg">
                <input type="text" name="name" id="name" placeholder="Enter Product Name">
                <input type="text" name="pid" id="pid" placeholder="Enter Product ID">
                <select name="category" id="category">
                    <option value="" selected disabled>Choose Category</option>
                    <?php
                        $query = "SELECT * FROM category";
                        $result = mysqli_query($conn,$query);
                        while($row = mysqli_fetch_assoc($result)){
                            $name = $row['name'];
                            echo "<option value='".$name."'>".$name."</option>";
                        }
                    ?>
                </select>
              </form>
          </div>
          <div class="col-md-4">
              <form action="some.php" method="post" id="accd">
                <h2>Accounting Details</h2>
                <input type="number" name="price" id="price" placeholder="Enter Product Price">
                <input type="number" name="qt" id="qt" placeholder="Enter Quantity Available">
              </form>
          </div>
      </div>
      <div class="row">
          <button class="btn btn-success" style="width: 200px;" id="submit">Submit</button>
      </div>
  </div>
  <script>
      $("#home").click(function(){
        location.href = "index.php?location=home";
      });

      $("#product").click(function(){
        location.href = "index.php?location=product";
      });

      $("#category").click(function(){
        location.href = "index.php?location=category";
      });

      $("#order").click(function(){
        location.href = "index.php?location=order";
      });

      $("#msg").click(function(){
        location.href = "index.php?location=msg";
      });

      $("#orderl").click(function(){
        location.href = "index.php?location=list";
      });

      $("#upload").click(function(e){
          e.preventDefault();
        var form = $("#imgfrm")[0];
        var data = new FormData(form);
        $.ajax({
            url:"../validate/getimg.php",
            method: "POST",
            data: data,
            processData:false,
            cache:false,
            contentType:false,
            success: function(res){
                if(res == "Can Not Upload"){
                    alert("Error Uploading Image");
                }else{
                    $(".image").css("background-image","url("+res+")");
                    $("#hidimg").val(res);
                }
            }
        });
      });

      $("#submit").click(function(e){
          e.preventDefault();
          var form = $("#gend")[0];
          var price =$("#price").val();
          var qt    = $("#qt").val();
          var data = new FormData(form);
          data.append("price",price);
          data.append("qt",qt);
          $.ajax({
            url:"../validate/addproduct.php",
            method: "POST",
            data: data,
            processData:false,
            cache:false,
            contentType:false,
            success: function(res){
              if(res ==  "Error"){
                $(".allmsg").html("We have an Error. Try Again Later Or Contact Your Developer");
                $(".allmsgbg").fadeIn("fast");
                $(".allmsg").fadeIn("fast");
                setTimeout(function(){
                    location.href = "index.php?location=product";
                }, 1000);
              }else{
                $(".allmsg").html(res);
                $(".allmsgbg").fadeIn("fast");
                $(".allmsg").fadeIn("fast");
                setTimeout(function(){
                    location.href = "index.php?location=product";
                }, 1000);
              }
            }
        });
      })
  </script>
</body>
</html>