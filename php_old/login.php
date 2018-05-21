

    <?php
        include_once('../templates/header.php');
		include("connection.php");
        include('../templates/login.html');

        function logIn(){
		
            $con = connect();
            $usuario = $_POST["usuario"];
            $pass = $_POST["contraseña"];
            $sql = "SELECT * FROM usuarios WHERE nombre='$usuario' and pass=md5('$pass')";
			$resultado = mysqli_query($con, $sql) or die (mysqli_error($con));
            $vUsuario = mysqli_fetch_assoc($resultado);
            mysqli_close($con);
            if(!is_null($vUsuario)){
                $_SESSION["usuario"] = $vUsuario["nombre"];
                //setPermisos($vUsuario["tipo"]);
                echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
                header("Location:home.php");
             //   $loged = True;            
            }
            else{
               // $loged = false;
                echo("Usuario o contrasena incorrecta");
            }
			//*/
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
            mysqli_close($c);
            $i = 0;
            while($p = mysqli_fetch_assoc($result)){
                $_SESSION["permisos"][$i] = $p;
                //print_r($p[$i]);
                $i++;
            }
			
            //$_SESSION["permisos"] = $permisos;
            // foreach($permisos as $per){
            //     echo $per;
            // }
        }
		 include_once('../templates/footer.php');
    ?>
