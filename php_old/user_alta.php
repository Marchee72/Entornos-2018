<html>
<head>
<title>Alta Usuario</title>
</head>
<header>
    <?php
        include("../templates/header.php");
    ?>
</header>
<body>
<?php
include("connection.php");
include("../templates/user_alta.html");
$con = connect();
//$nombre = $_POST['nombre'];
//$apellido = $_POST['apelido'];
$usuario = $_POST['usuario'];
//$email = $_POST['Email'];
$pass = $_POST['contraseña'];

$sql = "SELECT Count(nombre) as cantidad FROM usuarios WHERE nombre=$usuario";
$resultado = mysqli_query($con, $sql) or die (mysqli_error($con));
$vCantUsuarios = mysqli_fetch_assoc($resultado);

if ($vCantUsuarios !=0){
 echo ("El Usuario ya Existe<br>");
 echo ("<A href='home.html'>VOLVER AL MENU</A>");
}
else {
$sql = "INSERT INTO usuarios (nombre, pass) values ('$usuario','$pass')";
 mysqli_query($con, $sql) or die (mysqli_error($con));
 echo("El Usuario fue Registrado<br>");
 echo ("<A href='home.html'>VOLVER AL MENU</A>");
// Liberar conjunto de resultados
mysqli_free_result($resultado);
}
// Cerrar la conexion
mysqli_close($con);
?></body></html>