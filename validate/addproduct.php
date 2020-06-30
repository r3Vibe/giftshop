<?php include "../includes/db.php"; ?>
<?php
$image = $_POST['image'];
$name = $_POST['name'];
$pid = $_POST['pid'];
$category = $_POST['category'];
$price = $_POST['price'];
$qt = $_POST['qt'];


$query = "INSERT INTO products(name,category,productid,status,price,quantity,image) VALUES('$name','$category','$pid','active','$price','$qt','$image')";
$result = mysqli_query($conn,$query);
if(!$result){
    die("Error");
}else{
    echo "New Product Added!";
}
?>