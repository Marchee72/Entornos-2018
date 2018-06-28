</div>
<footer class="footer">
<div class="container"><h4>
<a href="<?php echo ROOT_PATH . '/contacto'?>"><strong> Contacto </strong> </a></h4>
<ul class="footer-line">
 <?php                    
if(!isset($_SESSION["tipo_usuario"])){
           include("templates/footer/defaultMenu.html");
        }else{
           
                $tipo_u = $_SESSION["tipo_usuario"];
                include("templates/footer/$tipo_u/menu.html");
            
        }
?>
			</ul>
</div>
</footer>
</body>
</html>