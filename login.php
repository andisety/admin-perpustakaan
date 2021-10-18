<?php
require "functions.php";
if (isset($_POST["login"])) {
    if (login() === true) {
        echo "<script>
        alert('hai GANTENG :)');
        document.location.href = 'index.php?page=beranda';
        </script>";
        session_start();
        $_SESSION['login'] = true;
    } else {
        echo "<script>
        alert('username/pasword salah');
        </script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <title>Login</title>
    <style type="text/css">
        body {
            background-image: url("asset/image/bg1.PNG");

        }

        #pp {
            background-color: rgba(77, 77, 77, 0.5);
        }

        label,
        h3,
        button {
            font-weight: bold;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container ">
        <div class="row vh-100 d-flex justify-content-center align-items-center ">
            <div class="col-md-7 col-lg-5 ">
                <div id="pp" class="card shadow-lg">
                    <div id="p" class="card-body">
                        <h3 class="mb-4 mt-2 text-center  text-light">LOG IN</h3>

                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username">Username</label>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-dark" name="login" type="submit">Log In</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>