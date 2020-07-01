<?php include "../includes/db.php"; ?>
<?php
$id = $_POST['id'];

$query = "DELETE FROM category WHERE id = '{$id}'";
$result = mysqli_query($conn,$query);
if(!$result){
    die("Error");
}else{
    echo "Category Removed";
}
?>