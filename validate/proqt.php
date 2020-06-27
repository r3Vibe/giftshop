<?php include "../includes/db.php";?>
<?php
$id = $_POST['id'];
$qt = $_POST['qt'];

$id = mysqli_escape_string($conn,$id);
$qt = mysqli_escape_string($conn,$qt);

$query = "SELECT * FROM products WHERE id = '{$id}'";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result)){
    $db_qt = $row['quantity'];
}

$new_qt = (int)$db_qt + (int)$qt;

$query = "UPDATE products SET quantity = '{$new_qt}' WHERE id = '{$id}'";
$result = mysqli_query($conn,$query);
if(!$result){
    die();
}else{
    echo "Quantity Updated";
}
?>