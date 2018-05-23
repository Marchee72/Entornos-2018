<?php
 
 class registra{
	function init(){
		include('templates/registra.html');	
        }
	
	function cerveceria(){
	echo "<h1 class='white'>Formulario registro cerveceria aca</h1>";
	//include('templates/registro_cerveceria.html');	
	}
	
	function usuario(){
	include('templates/registra.html');	
	$this->registrarNuevoUsuario();
	}
	
	function registrarNuevoUsuario(){
		include('connection.php');
		$con = connect();
		$nombre =  isset($_POST["nombre"]) ? $_POST["nombre"] : die;
		$apellido =  isset($_POST["apellido"]) ? $_POST["apellido"] : die;
		$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : die;
		$email =  isset($_POST["email"]) ? $_POST["email"] : die;
		$pass = isset($_POST["contraseña"]) ? $_POST["contraseña"] : die;
		$tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 2; //USUARIO TIPO 2 ES UN USUARIO COMUN
		$valido = 0; //NO ES VALIDO HASTA QUE SE VERIFIQUE POR MAIL

		$sql = "SELECT Count(nombre) as cantidad FROM usuarios WHERE nombre='$usuario'";
		$resultado = mysqli_query($con, $sql) or die (mysqli_error($con));
		$vCantUsuarios = mysqli_fetch_assoc($resultado);

		if ($vCantUsuarios["cantidad"] !=0){
			echo ("El Usuario ya Existe<br>");
			echo ("<A href='home.html'>VOLVER AL MENU</A>");
		}
		else {
			$sql = "INSERT INTO usuarios (nombre, pass, tipo, valido, nombre, apellido, email) 
					values ('$usuario','$pass', '$tipo', '$valido', '$nombre', '$apellido', '$email')";
			mysqli_query($con, $sql) or die (mysqli_error($con));
			echo("El Usuario fue Registrado<br>");
			echo ("<A href='home.html'>VOLVER AL MENU</A>");
			// Liberar conjunto de resultados
			mysqli_free_result($resultado);
		}
		// Cerrar la conexion
		mysqli_close($con);
	}

 }
?>