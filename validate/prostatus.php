<?php include "../includes/db.php";?>
<?php
$new_st = "";
$id = $_POST['id'];

$id = mysqli_escape_string($conn,$id);

$query = "SELECT * FROM products WHERE id = '{$id}'";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result)){
    $db_st = $row['status'];
}

if($db_st == "active"){
    $new_st = "closed";
}else if($db_st == "closed"){
    $new_st = "active";
}

$query = "UPDATE products SET status = '{$new_st}' WHERE id = '{$id}'";
$result = mysqli_query($conn,$query);
if(!$result){
    die();
}else{
    echo "Status Changed";
}
?>