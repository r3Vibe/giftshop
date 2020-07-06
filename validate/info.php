<?php include "../includes/db.php"; ?>
<?php
if(isset($_POST['info'])){
    $query = "SELECT * FROM products WHERE status = 'active' AND quantity <= 5";
    $result = mysqli_query($conn,$query);
    if(!$result){
      die("error");
    }else{
      while($row = mysqli_fetch_assoc($result)){
        $name = $row['name'];
        echo '<li class="redmsg">'.$name.' is low On Stock</li>';
      }
    }

    $query = "SELECT * FROM orderlistt WHERE status = 'processing'";
    $result = mysqli_query($conn,$query);
    if(!$result){
      die("error");
    }else{
      while($row = mysqli_fetch_assoc($result)){
        $name = $row['product'];
        echo '<li class="greenmsg">You Have New Order Of '.$name.'. Please Check Orders</li>';
      }
    }
}
?>