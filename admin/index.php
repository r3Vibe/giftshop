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
<?php
$show = 0;
if(isset($_GET['rem'])){
  $show = 1;
}
if(isset($_GET['qtup'])){
  $show = 1;
}
if(isset($_GET['stsc'])){
  $show = 1;
}
if(isset($_GET['cat'])){
  $show = 3;
}
if(isset($_GET['location'])){
  $to = $_GET['location'];
  if($to == "home"){
    $show = 2;
  }else if($to == "product"){
    $show = 1;
  }else if($to == "category"){
    $show =3;
  }else if($to == "order"){
    $show =4;
  }else if($to == "msg"){
    $show =5;
  }
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
  <div class="allmsgbg"></div>
  <div class="allmsg">
  </div>
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
  <div class="wrapper">
      <button class="btn btn-success" id="home">Home</button>
      <button class="btn btn-success" id="product">Products</button>
      <button class="btn btn-success" id="category">Categories</button>
      <button class="btn btn-success" id="order">Orders</button>
      <button class="btn btn-success" id="msg">Messages</button>
  </div>
  <div class="content">
    <div class="wrapperforitems homec">
      <h1 style="padding-top: 15px;">Admin Panel</h1>
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
    <div class="wrapperforitems productc" style="display: none;">
      <h1 style="padding-top: 15px;">Products</h1>
      <p class="btn-holder">
        <button class="btn btn-success" id="addproduct">Add</button>
        <button class="btn btn-success" id="remproduct">Remove</button>
        <button class="btn btn-success" id="changeproduct">Status</button>
        <button class="btn btn-success" id="updateproduct">Quantity</button>
      </p>
      <p class="table-holder">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Id</th>
                <th scope="col">Status</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = "SELECT * FROM products";
                $result = mysqli_query($conn,$query);
                if(!$result){
                  die("error");
                }else{
                  while($row= mysqli_fetch_assoc($result)){
                    $name = $row['name'];
                    $image = $row['image'];
                    $id = $row['id'];
                    $productid = $row['productid'];
                    $status = $row['status'];
                    $sell = $row['price'];
                    $quantity = $row['quantity'];
                    echo '<tr>';
                    echo '<th scope="row"><input type="radio" name="id" id="id" value="'.$id.'"></th>';
                    echo '<th><img src="'.$image.'" alt="" srcset="" style="width:40px;height:40px;"></th>';
                    echo '<th>'.$name.'</th>';
                    echo '<th>'.$productid.'</th>';
                    echo '<th>'.$status.'</th>';
                    echo '<th><i class="fas fa-rupee-sign"></i> '.$sell.'</th>';
                    echo '<th>'.$quantity.'</th>';
                    echo '</tr>';
                  }
                }
              ?>
              
            </tbody>
          </table>
      </p>
    </div>
    <div class="wrapperforitems categoryc" style="display: none;">
      <h1 style="padding-top: 15px;">Categories</h1>
      <p class="btn-holder">
        <button class="btn btn-success" id="addcat" style="margin-left: 70%;">Add</button>
        <button class="btn btn-success" id="remcat">Remove</button>
        <button class="btn btn-success" id="upcat">Update</button>
      </p>
      <p class="table-holder">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price Range</th>
                <th scope="col">Total Variations</th>
                <th scope="col">Variations</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = "SELECT * FROM category";
                $result = mysqli_query($conn,$query);
                if(!$result){
                  die("error");
                }else{
                  while($row= mysqli_fetch_assoc($result)){
                    $name = $row['name'];
                    $id = $row['id'];
                    $variationnumber = $row['number'];
                    $variations = $row['variations'];
                    $pricerange = $row['prange'];
                    $image = $row['image'];
                    echo '<tr>';
                    echo '<th scope="row"><input type="radio" name="cid" id="id" value="'.$id.'"></th>';
                    echo '<th><img src="'.$image.'" alt="" srcset="" style="width:40px;height:40px;"></th>';
                    echo '<th>'.$name.'</th>';
                    echo '<th><i class="fas fa-rupee-sign"></i> '.$pricerange.'</th>';
                    echo '<th>'.$variationnumber.'</th>';
                    echo '<th>'.$variations.'</th>';
                    echo '</tr>';
                  }
                }
              ?>
            </tbody>
          </table>
      </p>
    </div>
    <div class="wrapperforitems orderc" style="display: none;">
      <h1 style="padding-top: 15px;">Orders</h1>
      <p>
        <ul>
          <li>New Product Order</li>
        </ul>
      </p>
    </div>
    <div class="wrapperforitems msgc" style="display: none;">
      <h1 style="padding-top: 15px;">Messages</h1>
      <p>
        <ul>
          <li>New Product Order</li>
        </ul>
      </p>
    </div>
  </div>
  <script>
    //quantity update
    $("#updateproduct").on("click",function(){
      var id = $("input[name='id']:checked").val();
      if(typeof(id) == "undefined"){
        $(".allmsg").html("You Need To Select A Product First!");
        $(".allmsgbg").fadeIn("fast");
        $(".allmsg").fadeIn("slow");
        setTimeout(function(){
          $(".allmsgbg").fadeOut("fast");
          $(".allmsg").fadeOut("slow");
        },1800);
      }else{
        var quantity = prompt("Update Quantity:");
        $.post("../validate/proqt.php",{"id":id,"qt":quantity},function(res){
          $(".allmsg").html(res);
          $(".allmsgbg").fadeIn("fast");
          $(".allmsg").fadeIn("slow");
          if(res == "Quantity Updated"){
            setTimeout(function(){
                location.href = "index.php?qtup=true";
            }, 1000);
          }
        });
      }
    });
    //status chnage
    $("#changeproduct").on("click",function(){
      var id = $("input[name='id']:checked").val();
      if(typeof(id) == "undefined"){
        $(".allmsg").html("You Need To Select A Product First!");
        $(".allmsgbg").fadeIn("fast");
        $(".allmsg").fadeIn("slow");
        setTimeout(function(){
          $(".allmsgbg").fadeOut("fast");
          $(".allmsg").fadeOut("slow");
        },1800);
      }else{
        $.post("../validate/prostatus.php",{"id":id},function(res){
          $(".allmsg").html(res);
          $(".allmsgbg").fadeIn("fast");
          $(".allmsg").fadeIn("slow");
          if(res == "Status Changed"){
            setTimeout(function(){
                location.href = "index.php?stsc=true";
            }, 1000);
          }
        });
      }
    });

      //remove
      $("#remproduct").on("click",function(){
      var id = $("input[name='id']:checked").val();
      if(typeof(id) == "undefined"){
        $(".allmsg").html("You Need To Select A Product First!");
        $(".allmsgbg").fadeIn("fast");
        $(".allmsg").fadeIn("slow");
        setTimeout(function(){
          $(".allmsgbg").fadeOut("fast");
          $(".allmsg").fadeOut("slow");
        },1800);
      }else{
        $.post("../validate/prorem.php",{"id":id},function(res){
          $(".allmsg").html(res);
          $(".allmsgbg").fadeIn("fast");
          $(".allmsg").fadeIn("slow");
          if(res == "Product Removed"){
            setTimeout(function(){
                location.href = "index.php?rem=true";
            }, 1000);
          }
        });
      }
    });

    $("#addproduct").on("click",function(){
      location.href = "adpro.php";
    });


    $(".allmsgbg").on("click",function(){
      $(".allmsgbg").hide();
      $(".allmsg").hide();
    });
    $(".close").on("click",function(){
      $(".allmsgbg").hide();
      $(".allmsg").hide();
    });



    var show = <?php echo $show; ?>;
    if(show == 1){
      $(".homec").hide();
      $(".productc").fadeIn("fast");   
      $(".categoryc").hide();                                               
      $(".orderc").hide();                 
      $(".msgc").hide(); 
    }else if(show == 2){
      $(".homec").fadeIn("fast");
      $(".productc").hide();   
      $(".categoryc").hide();                                               
      $(".orderc").hide();                 
      $(".msgc").hide(); 
    }else if(show == 3){
      $(".homec").hide();
      $(".productc").hide();   
      $(".categoryc").fadeIn("fast");                                               
      $(".orderc").hide();                 
      $(".msgc").hide(); 
    }else if(show == 4){
      $(".homec").hide();
      $(".productc").hide();   
      $(".categoryc").hide();                                               
      $(".orderc").fadeIn("fast");                 
      $(".msgc").hide(); 
    }else if(show == 5){
      $(".homec").hide();
      $(".productc").hide();   
      $(".categoryc").hide();                                               
      $(".orderc").hide();                 
      $(".msgc").fadeIn("fast"); 
    }

    //category div
    $("#addcat").click(function(){
      location.href = "addcat.php";
    });
    //remove
    $("#remcat").click(function(){
      var id = $("input[name='cid']:checked").val();
      if(typeof(id) == "undefined"){
        $(".allmsg").html("You Need To Select A Category First!");
        $(".allmsgbg").fadeIn("fast");
        $(".allmsg").fadeIn("slow");
        setTimeout(function(){
          $(".allmsgbg").fadeOut("fast");
          $(".allmsg").fadeOut("slow");
        },1800);
      }else{
        $.post("../validate/catrem.php",{"id":id},function(res){
          $(".allmsg").html(res);
          $(".allmsgbg").fadeIn("fast");
          $(".allmsg").fadeIn("slow");
          if(res == "Category Removed"){
            setTimeout(function(){
                location.href = "index.php?cat=true";
            }, 1000);
          }
        });
      }
    });
    //update
    $("#upcat").click(function(){
      var id = $("input[name='cid']:checked").val();
      if(typeof(id) == "undefined"){
        $(".allmsg").html("You Need To Select A Category First!");
        $(".allmsgbg").fadeIn("fast");
        $(".allmsg").fadeIn("slow");
        setTimeout(function(){
          $(".allmsgbg").fadeOut("fast");
          $(".allmsg").fadeOut("slow");
        },1800);
      }else{
        $(".allmsg").html('<h1 style="margin-bottom:5px !important;">Update Category</h1><select name="whichone" id="whichone"><option value="" selected disabled>Choose Option</option><option value="range">Price Range</option><option value="nos">Increase Variations</option></select><button class="btn btn-success" id="catupsub">Submit</button>');
        $(".allmsgbg").fadeIn("fast");
        $(".allmsg").fadeIn("slow");
        $("#catupsub").click(function(){
          var whichone = $("#whichone").val();
          if(whichone == 'nos'){
            $(".allmsg").html('<input type="text" name="newvar" id="newvar" style="width:100%;border:none;outline:none;background:none;border-bottom:2px solid black;" placeholder="Enter New Variation Name"><button class="btn btn-success" id="newvarup">Submit</button>');
            $("#newvarup").click(function(){
              var newvariation = $("#newvar").val(); 
              $.post("../validate/upcat.php",{"id":id,"which":"newvar","newvarval":newvariation},function(res){
                $(".allmsg").html(res);
                $(".allmsgbg").fadeIn("fast");
                $(".allmsg").fadeIn("slow");
                if(res == "New Variation Added"){
                  setTimeout(function(){
                      location.href = "index.php?cat=true";
                  }, 1000);
                }
              });
            });
          }else if(whichone == 'range'){
            $(".allmsg").html('<input type="text" name="rangevar" id="rangevar" style="width:100%;border:none;outline:none;background:none;border-bottom:2px solid black;" placeholder="Enter New Price Range"><button class="btn btn-success" id="rangeup">Submit</button>');
            $("#rangeup").click(function(){
              var rangeval = $("#rangevar").val(); 
              $.post("../validate/upcat.php",{"id":id,"which":"range","rangeval":rangeval},function(res){
                $(".allmsg").html(res);
                $(".allmsgbg").fadeIn("fast");
                $(".allmsg").fadeIn("slow");
                if(res == "Price Range Updated"){
                  setTimeout(function(){
                      location.href = "index.php?cat=true";
                  }, 1000);
                }
              });
            });
          }else{
            $(".allmsg").html("Choose An option First");
            $(".allmsgbg").fadeIn("fast");
            $(".allmsg").fadeIn("slow");
            setTimeout(function(){
              $(".allmsgbg").fadeOut("fast");
              $(".allmsg").fadeOut("slow");
            },1800);
          }
        });
      }
    });
  </script>
</body>
</html>