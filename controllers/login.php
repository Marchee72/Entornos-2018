

    <?php
        //include_once('../templates/header.php');
	//	include("connection.php");
        
		class login{
		
		function init(){
		include('templates/login.html');	
        }
        
        function setPermisos($tipoUsuario){
            $query = "SELECT p.titulo as 'titulo', p.url as 'url'
                        FROM  tipo_usuario tu
                        INNER JOIN permiso_tipousuario ptu
                        ON ptu.idtipousuario = tu.id
                        INNER JOIN permisos p
                        ON p.idpermiso = ptu.idpermiso
                        WHERE tu.id = '$tipoUsuario'";
            $c = connect();
            $result = mysqli_query($c, $query) or die (mysqli_error($c));            
            $_SESSION['permisos'] = [];
            $i = 0;
            while ($fila = mysqli_fetch_assoc($result)) {
                $_SESSION["permisos"][$i] = $fila;
                $i++;
            }

            mysqli_free_result($result);
            mysqli_close($c);
        }
			
        function ingresar(){
            include('connection.php');
            $con = connect();
			$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : die;
            $pass = isset($_POST["contraseña"]) ? $_POST["contraseña"] : die;
            $sql = "SELECT * FROM usuarios WHERE nombre='$usuario' and pass='$pass'";

			$resultado = mysqli_query($con, $sql) or die (mysqli_error($con));
            $vUsuario = mysqli_fetch_assoc($resultado);
            //sqli_free_result($resultado);
            mysqli_close($con);
            if(!is_null($vUsuario)){
                $_SESSION["usuario"] = $vUsuario["nombre"];
                $this->setPermisos($vUsuario["tipo"]);

                header("Location:home.php");            
            }
            else{
                echo("Usuario o contrasena incorrecta");
            }
        }

        
		// include_once('../templates/footer.php');
		}
	?>
