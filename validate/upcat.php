<?php include "../includes/db.php"; ?>
<?php
$id = $_POST['id'];
$whichone = $_POST['which'];

if($whichone == "newvar"){
    $query = "SELECT * FROM category WHERE id = '{$id}'";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("Error");
    }else{
        while($row = mysqli_fetch_assoc($result)){
            $number = $row['number'];
            $variations = $row['variations'];
        }
        $newvarval = $_POST['newvarval'];
        $all_var = explode(",",$variations); 
        array_push($all_var,$newvarval);
        for($i = 0; $i < count($all_var);$i++){
            $variation .= $all_var[$i].',';
        }
        $variation = rtrim($variation, ',');
        $newnumber = (int)$number + 1;
        $query = "UPDATE category SET number = '{$newnumber}', variations = '{$variation}'  WHERE id = '{$id}'";
        $result = mysqli_query($conn,$query);
        if(!$result){
            die("Error");
        }else{
            echo "New Variation Added";
        }
    }
}else if ($whichone == "range"){
    $rangeval = $_POST['rangeval'];
    $query = "UPDATE category SET prange = '{$rangeval}' WHERE id = '{$id}'";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("Error");
    }else{
        echo "Price Range Updated";
    }
}
?>
