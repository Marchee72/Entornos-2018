<?php
class contacto{

function init(){
echo $this->view->render("templates/contacto.html");	
}

function consulta(){
$consulta =  isset($_POST["contacto-help"]) ? $_POST["contacto-help"] : die;
$email =  isset($_POST["email"]) ? $_POST["email"] : die;
$headers = "From: Un usuario tiene una consulta <$email>\r\n";

#implementar mail de contacto cualquiera
//mail("Cerventum@contacto.com","CONSULTA",$consulta);	


}
?>