<?php include "../includes/db.php"; ?>
<?php
$product        =   $_POST['pname'];
$productid      =   $_POST['pid'];
$price          =   $_POST['pp'];
$quantity       =   $_POST['pq'];
$subtotal       =   $_POST['ps'];
$customer       =   $_POST['cn'];
$contact        =   $_POST['cc'];
$address        =   $_POST['ca'];
$mail        =   $_POST['cm'];

$day = date("d-M-Y");
$query = "INSERT INTO orderlistt(product,product_id,price,quantity,subtotal,customer,contact,email,address,status,date) VALUES('$product','$productid','$price','$quantity','$subtotal','$customer','$contact','$mail','$address','processing','$day')";
$result = mysqli_query($conn,$query);
if(!$result){
    die(mysqli_error($conn));
}else{
    echo "Order List Updated";
}
?>