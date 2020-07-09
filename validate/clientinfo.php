<?php include "../includes/db.php"; ?>
<?php 
$usr = $_POST['getinfo'];
$query = "SELECT * FROM users WHERE uname = '{$usr}'";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result)){
    $cont = $row['contact'];
}

$query = "SELECT * FROM orderlistt WHERE contact = '{$cont}' AND status = 'processing'";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result)){
    $name = $row['product'];
    $orderid = $row['order_id'];
    echo "<li class='greenmsg'>Your Order ".$name." With Order ID ".$orderid." Is Awaiting Confirmation...</li>";
}

$query = "SELECT * FROM orderlistt WHERE contact = '{$cont}' AND status = 'confirmed'";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result)){
    $name = $row['product'];
    $orderid = $row['order_id'];
    echo "<li class='greenmsg'>Your Order ".$name." With Order ID ".$orderid." Has Been Confirmed By Seller</li>";
}

$query = "SELECT * FROM orderlistt WHERE contact = '{$cont}' AND status = 'complete'";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result)){
    $name = $row['product'];
    $orderid = $row['order_id'];
    echo "<li class='greenmsg'>Your Order ".$name." With Order ID ".$orderid." Is Ready To Ship</li>";
}

$query = "SELECT * FROM orderlistt WHERE contact = '{$cont}' AND status = 'shipped'";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result)){
    $name = $row['product'];
    $orderid = $row['order_id'];
    echo "<li class='greenmsg'>Your Order ".$name." With Order ID ".$orderid." Is Shipped. Tracking Id Available In Track Order</li>";
}
?>