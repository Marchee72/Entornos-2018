<?php 
class utils{
	
	static function enviarMailValidacion($email,$hash){
		$destino="$email"; 
		$asunto="Validar tu cuenta de cervecium";
		$desde='From: no-contestar@cervecium.com';
		

		$cuerpo = "
			<html>
				<head>
 				
				</head>
			<body>
		<h1>Bienvenido a cervesium</h1>
<p>
Para finalizar tu registracion sigue el siguiente vinculo. <a style='background-color:#f64347;color:#ffffff;font-family:Helvetica,Arial,sans-serif;font-size:16px;line-height:22px;border-radius:32px;text-align:center;text-decoration:none;display:block;margin:0px 0px;padding:15px 20px;width:320px;font-weight:bold' href=https://axeelvazq.000webhostapp.com" . ROOT_PATH ."/verifyemail/terminaRegistro/".$hash. ">finalizar registro</a>
</p>
</body>
</html>";

// Para enviar un correo HTML
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859- 1\r\n";
$headers .= "From: Valida tu cuenta <no-contestar@cervecium.com>\r\n";

		$a = mail($destino,$asunto,$cuerpo,$headers);
		return $a;
	}
	
}
?>