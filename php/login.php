<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>

    <?php
        include("connection.php");
        include('header.php');
        include('../html/login.html');

        function logIn(){
            $con = connect();
            $usuario = strtolower($_POST['usuario']);
            $pass = strtolower($_POST['contraseña']);
            $sql = "SELECT * FROM usuarios WHERE nombre='$usuario' and pass='$pass'";
            $resultado = mysqli_query($con, $sql) or die (mysqli_error($con));
            $vUsuario = mysqli_fetch_assoc($resultado);
            mysqli_close($con);
            if(!is_null($vUsuario)){
                $_SESSION["usuario"] = $vUsuario["nombre"];
                setPermisos($vUsuario["tipo"]);
                header("Location: '../user_alta.php'");            
            }
        }

        function setPermisos($tipoUsuario){
            $query = "SELECT p.titulo
                        FROM  tipo_usuario tu
                        INNER JOIN permiso_tipousuario ptu
                        ON ptu.idtipousuario = tu.id
                        INNER JOIN permisos p
                        ON p.idpermiso = ptu.idpermiso
                        WHERE tu.id = $tipoUsuario";
            $c = connect();
            $result = mysqli_query($c, $query) or die (mysqli_error($c));
            $permisos = mysqli_fetch_assoc($result);
            mysqli_close($c);
            $_SESSION["permisos"] = $permisos;
        }
    ?>

</html>