<?php include "../includes/db.php"; ?>
<?php 
$status = $_POST['status'];
$id = $_POST['id'];
$query = "UPDATE orderlistt SET status = '{$status}' WHERE id = '{$id}'";
if(!mysqli_query($conn,$query)){
    die("Error");
}else{
    echo "Status Updated";
}
?>