<?php include "../includes/db.php";?>
<?php session_start();?>
<?php 
$redirect = false;
$where_to = "";

$username = $_POST['username'];
$password = $_POST['password'];

$username = mysqli_escape_string($conn,$username);
$password = mysqli_escape_string($conn,$password);

$query = "SELECt * FROM users WHERE uname = '{$username}'";
$result = mysqli_query($conn,$query);
if(!$result){
    die("Error Fetching Users!");
}else{
    while($row = mysqli_fetch_assoc($result)){
        $name = $row['uname'];
        $password_db = $row['password'];
        $role = $row['role'];
    }
    if($role == "admin"){
        $where_to = 1;
    }else if($role == "customer"){
        $where_to = 2;
    }
    $count = mysqli_num_rows($result);
    if($count == NULL){
        echo "<span class='redmsg'>User Not Found Please SignUp!</span>";
    }else{
        $pass = password_verify($password,$password_db);
        if(!$pass){
            echo "<span class='redmsg'>Password Did Not Match</span>";
        }else{
            echo "<span class='greenmsg'>LogIn Succesfull! Redirecting In... 2s</span>";
            $_SESSION['user'] = $username;
            $_SESSION['role'] = $role;
            $redirect = true;
        }
    }
}
?>
<script>
    var redirect = <?php echo $redirect; ?>;
    var where_to = <?php echo $where_to; ?>;
    if(redirect){
        if(where_to == 1){
            setTimeout(function(){
                location.href = "../admin/";
            }, 2000);
        }else if(where_to == 2){
            setTimeout(function(){
                location.href = "../client/";
            }, 2000);  
        }
    } 
</script>