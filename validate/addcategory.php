<?php include "../includes/db.php"; ?>
<?php 
$image = $_POST['image'];
$name = $_POST['name'];
$number = $_POST['number'];
$prange = $_POST['prange'];
$file_name = $_FILES['location']['name'];
$file_name_tmp = $_FILES['location']['tmp_name'];
$location = "../shop/";
$save = $location.$file_name;
$variations = [];
for($i =0;$i < $number; $i++){
    array_push($variations,$_POST['variation'.((int)$i+1)]);
}
for($j = 0; $j < count($variations);$j++){
    $all_var .= $variations[$j].',';
}
$all_var = rtrim($all_var,',');

//upload php file
if(!move_uploaded_file($file_name_tmp,$save)){
    die("Error");
}else{
    $query = "INSERT INTO category(name,number,variations,prange,image,link) VALUES('$name','$number','$all_var','$prange','$image','$save')";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("Error");
    }else{
        echo "New Category Added";
    }
}
?>