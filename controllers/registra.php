<?php
 //$action = $_GET["action"];
 
 class registra{
 //include('../templates/header.php');
 //if(isset($action)){
//	 if($action == "home") {
	
	function cerveceria(){
	echo "<h1 class='white'>Formulario registro cerveceria aca</h1>";
	//include('templates/registro_cerveceria.html');	
	}
	
	function usuario(){
		echo "<h1 class='white'>Formulario registro usuario</h1>";
		include('templates/user_alta.html');
		
	}
		
	function user_alta(){
		include("connection.php");
		include("login.php");
		$con = connect();
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$usuario = $_POST['usuario'];
		$email = $_POST['email'];
		$pass = $_POST['contraseña'];
		$tipo_usuario = 2;

		$sql = "SELECT Count(usuario) as cantidad FROM usuarios WHERE usuario='$usuario'";
		$resultado = mysqli_query($con, $sql) or die (mysqli_error($con));
		$vCantUsuarios = mysqli_fetch_assoc($resultado);

		if ($vCantUsuarios['cantidad'] !=0){
		$this->usuario();
		echo ("El Usuario ya Existe<br>");
		}
		else {
		$sql = "INSERT INTO usuarios (nombre, apellido,usuario,email, pass,tipo) 
				values ('$nombre','$apellido','$usuario','$email','$pass','$tipo_usuario')";
		mysqli_query($con, $sql) or die (mysqli_error($con));
		echo("El Usuario fue Registrado, valide su cuenta a traves del link que le enviamos al mail<br>");
		// Liberar conjunto de resultados
		mysqli_free_result($resultado);
		}
			// Cerrar la conexion
		mysqli_close($con);

	}

	/*function mail_validacion(){
	}*/
}
	?>