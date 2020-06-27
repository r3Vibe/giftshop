<?php include "../includes/db.php"; ?>
<?php
$id = $_POST['id'];

$id = mysqli_escape_string($conn,$id);

$query = "DELETE FROM products WHERE id = '{$id}'";
$result = mysqli_query($conn,$query);
if(!$result){
    die("Error");
}else{
    echo "Product Removed";
}
?>