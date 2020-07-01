<?php
$imge_name      = $_FILES['imgae']['name'];
$imge_name_tmp  = $_FILES['imgae']['tmp_name'];

$location = "../images/category/";

$save = $location.$imge_name;

if(!move_uploaded_file($imge_name_tmp,$save)){
    echo "Can Not Upload";
}else{
    echo $save;
}
?>