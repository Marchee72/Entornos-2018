<?php
class contacto{

function init(){
echo $this->view->render("templates/contacto.html");	
}

function consulta(){
$consulta =  isset($_POST["contacto-help"]) ? $_POST["contacto-help"] : die;
$email =  isset($_POST["email"]) ? $_POST["email"] : die;
$headers = "From: Un usuario tiene una consulta <$email>\r\n";
//mail("Cerventum@contacto.com","CONSULTA",$consulta);	  echo ("<div class='alert alert-success' role='alert'>         Su consulta fue enviada correctamente    </div></div>");

}}
?>