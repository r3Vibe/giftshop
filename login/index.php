<?php include "../includes/db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.min.css"> 
    <script src="../jq/jq.js"></script>
    <script src="../jq/bootstrap.js"></script>
    <script src="../jq/style.js"></script>
    <title>Login</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../">Rever Design</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a class="nav-link" href="../login/" tabindex="-1"><i class="fas fa-sign-in-alt"></i> Login</a>
            </li>
          </ul>
        </div>
    </nav>
    <div class="container" style="padding-top:25px;height:100%">
      <div class="row align-items-center h-100">
        <div class="col-sm-12 align-self-center">
            <form action="index.php" method="post" id="login">
                <div class="form-group">
                    <h1 style="text-align: center;">Login</h1>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Your Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password">
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" id="submit">
                </div>
                <div class="form-group">
                    <a href="signup.php">SignUp</a>
                    <a href="forget.php" style="float: right;">Forget Password</a>
                </div>
                <div class="form-group">
                    <p class="msg" style="text-align: center;font-size: 20px;"></p>
                </div>
            </form>
        </div>
      </div>
      <script>
          $("#submit").on("click",function(e){
            e.preventDefault();
            var user = $("#username").val();
            var pass = $("#password").val();
            if(user == ""){
                $("#username").addClass("redborder");
                $(".msg").html("Username Can Not Be Empty");
                $(".msg").addClass("redmsg");
            }else if(pass == ""){
                $("#password").addClass("redborder");
                $(".msg").html("Password Can Not Be Empty");
                $(".msg").addClass("redmsg");
            }else{
                $("#username").removeClass("redborder");
                $("#password").removeClass("redborder");
                $(".msg").html("");
                $(".msg").removeClass("redmsg");
                var form = $("#login")[0];
                var data = new FormData(form);
                $.ajax({
                    url: "../validate/login.php",
                    method: "POST",
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    success: function(responce){
                        $(".msg").html(responce);
                    }
                });
            }
          });
      </script>
</body>
</html>