

    <?php
        //include_once('../templates/header.php');
	//	include("connection.php");
        
		class login{
		
		function init(){
		include('templates/login.html');	
        }
        
        function setPermisos($tipoUsuario){
            echo("tipo: ".$tipoUsuario);
            $query = "SELECT p.titulo as 'titulo'
                        FROM  tipo_usuario tu
                        INNER JOIN permiso_tipousuario ptu
                        ON ptu.idtipousuario = tu.id
                        INNER JOIN permisos p
                        ON p.idpermiso = ptu.idpermiso
                        WHERE tu.id = '$tipoUsuario'";
            $c = connect();
            $result = mysqli_query($c, $query) or die (mysqli_error($c));
            $permisos = mysqli_fetch_array($result);
            //echo '<pre>' . print_r($permisos, TRUE) . '</pre>';
            mysqli_close($c);
            $_SESSION['permisos'] = [];
            $_SESSION['permisos'] = $permisos[0];
            $_SESSION['permisos'] = $permisos[1];
        }
			
        function ingresar(){
            include('connection.php');
            $con = connect();
			$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : die;
            $pass = isset($_POST["contraseña"]) ? $_POST["contraseña"] : die;
            $sql = "SELECT * FROM usuarios WHERE nombre='$usuario' and pass='$pass'";

			$resultado = mysqli_query($con, $sql) or die (mysqli_error($con));
            $vUsuario = mysqli_fetch_assoc($resultado);
            mysqli_close($con);
            if(!is_null($vUsuario)){
                $_SESSION["usuario"] = $vUsuario["nombre"];
                $this->setPermisos($vUsuario["tipo"]);

                header("Location:home.php");
             //   $loged = True;            
            }
            else{
               // $loged = false;
                echo("Usuario o contrasena incorrecta");
            }
        }

        
		// include_once('../templates/footer.php');
		}
	?>
