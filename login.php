<?php
session_start();

if (isset($_POST["iniciar"])) {
    $user = $_POST["mail"];
    $pass = md5($_POST["password"]);

    $conexión = mysqli_connect("localhost", "root", "","burger");
    if (!$conexión) {
        $mensaje = "Error de conexion";
        $estado = false;
    } else {
        $result = mysqli_query($conexión, "select * from usuarios where correo= '" . $user . "' and password='" . $pass . "'");
        if (mysqli_num_rows($result) == 1) {
            $mensaje = "Usuario y contraseña correcta";
            $_SESSION['mail'] = $user;
            $_SESSION['nombre'] = "Administrador";
            $estado = true;
        } else {
            $mensaje = "Usuario y contraseña incorrecta";
            $estado = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
    <style>
        html,
        body {
            height: 100%;
        }

        .global-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
        }

        form {
            padding-top: 10px;
            font-size: 14px;
            margin-top: 30px;
        }

        .card-title {
            font-weight: 300;
        }

        .btn {
            font-size: 14px;
            margin-top: 20px;
        }


        .login-form {
            width: 330px;
            margin: 20px;
        }

        .sign-up {
            text-align: center;
            padding: 20px 0 0;
        }

        .alert {
            margin-bottom: -30px;
            font-size: 13px;
            margin-top: 20px;
        }
    </style>
    <?php
    if (isset($estado) && $estado) {
    ?>
        <script>
            setTimeout(() => {
                window.location.href = "index.php";
            }, 5000);
        </script>
    <?php
    } ?>
</head>

<body>
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center">Log in to Codepen</h3>
                <?php
                if (isset($_POST["iniciar"])) {
                ?>
                    <p style="text-align: center;<?= $estado ? "color:green;" : "color:red;" ?>"><?= $mensaje ?></p>
                <?php
                } ?>
                <div class="card-text">
                    <!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                    <form action="" method="POST">
                        <!-- to error: add class "has-danger" -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="mail" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <a href="#" style="float:right;font-size:12px;">Forgot password?</a>
                            <input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="iniciar">Sign in</button>

                        <div class="sign-up">
                            Don't have an account? <a href="#">Create One</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>