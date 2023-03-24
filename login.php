<?php

session_start();
if (isset($_SESSION['admin'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    }
    body{
        background: whitesmoke
    }
    .row{
        background: white;
        border-radius: 30px;
        box-shadow: 12px 12px 22px grey;
    }
    img{
        border-top-left-radius: 50px;
        border-bottom-left-radius: 50px;
    }
    .btn1{
        border: none;
        outline: none;
        height: 50px;
        width: 100%;
        background-color: black;
        color: white;
        border-radius: 4px;
        font-weight: bold;
    }
    .btn1:hover{
        background: white;
        border: 1px solid;
        color: black;
    }
    </style>
</head>
<body>
    <section class="form my-5 mx-8">
        <div class="container" style="width:50%;">
        <div class="row no-gutters">
            <div class="col-lg-12 px-5 pt-5">
                    <h1 class="font-weight-bold py-3">Admin Login</h1>
                    <h4>Sign into your account</h4>

                    <form method="post" action="login_data.php">
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="text" placeholder="username" name="username" class="form-control my-3">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="password" placeholder="*******"  name="password" class="form-control my-3">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                               <button type="submit" name="submit" id="submit" class="btn1 mt-3 mb-5">Login</button>
                            </div>
                        </div>
                        <p>Don't have an account?<a href="#">Register</a></p>
                    </form>
            </div>
        </div>
        </div>
    </section>
</body>
</html>
