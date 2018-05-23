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
		include("login.php");
		$con = connect();
		$nombre =  isset($_POST["nombre"]) ? $_POST["nombre"] : die;
		$apellido =  isset($_POST["apellido"]) ? $_POST["apellido"] : die;
		$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : die;
		$email =  isset($_POST["email"]) ? $_POST["email"] : die;
		$pass = isset($_POST["contraseña"]) ? $_POST["contraseña"] : die;
		$tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : 2; //USUARIO TIPO 2 ES UN USUARIO COMUN
		$valido = 0; //NO ES VALIDO HASTA QUE SE VERIFIQUE POR MAIL

		$sql = "SELECT Count(nombre) as cantidad FROM usuarios WHERE usuario='$usuario'";
		$resultado = mysqli_query($con, $sql) or die (mysqli_error($con));
		$vCantUsuarios = mysqli_fetch_assoc($resultado);

		if ($vCantUsuarios["cantidad"] !=0){
			//$this->usuario();
			echo ("El Usuario ya Existe<br>");
		}
		else {
			$sql = "INSERT INTO usuarios (usuario, pass, tipo, valido, nombre, apellido, email) 
					values ('$usuario','$pass', '$tipo', '$valido', '$nombre', '$apellido', '$email')";
			mysqli_query($con, $sql) or die (mysqli_error($con));
			echo("El Usuario fue Registrado, valide su cuenta a traves del link que le enviamos al mail<br>");
			//$this->enviarMailValidacion($email);
			mysqli_free_result($resultado);
		}
		// Cerrar la conexion
		mysqli_close($con);
	}

	
	function enviarMailValidacion($email){
		$fecha=date("d-m-Y");
		$hora= date("H :i:s");
		$destino="$email"; 
		$asunto="Validar mail cervecium";
		$desde='From: no-contestar@cervecium.com';
		$comentario= "
		url valida mail
		http://localhost/Entornos-2018/registra/validacion
		
		";
		$a = mail($destino,$asunto,$comentario,$desde);
		if($a)
		echo "Se envio el mail";
		else 
		echo "No se ha podido enviar el mail";
	}

	function validacion($email){
		$sql = "UPDATE usuarios SET valido='True' WHERE email = $email";
		$resultado = mysqli_query($con, $sql) or die (mysqli_error($con));
		mysqli_free_result($resultado);

		header("Location: ../home/dashboard");
	}
 }
 include_once('templates/footer.php');
?>