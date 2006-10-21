<? include_once("basico.php"); 
$conDB = connectDB();
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Recordatorio</title>
<meta name="Generator" content="EditPlus" />
<meta name="Author" content="" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<link rel="stylesheet" href='estilos/estilos.css' type='text/css' />
</head>
<body class="bodymenurecordapass">
<div class="logindatos">
<?
$user=strtolower($_POST['username']);
$query="SELECT `email` FROM `persona` WHERE `nombreUsuario`='$user'";
$result=$conDB->query($query);
if(($user!="root")&&($result->numrows()!=0)){
	$mail=$result->fetchrow();
	if(isset($mail[0]) && !empty($mail[0]))
	{
		$para = $mail[0];
		$asunto = "Recordatorio de contraseña";
		$autor = "Colegio Joaquin V. Gonzalez";
		$autor_email = getTexts($conDB,'colegio','email');
		$mensaje = "Para recuperar su contraseña contactese con el administrador del sitio";
		//para el envío en formato HTML
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		//dirección del remitente
		$headers .= "From:".$autor." <".$autor_email.">\r\n";
		//dirección de respuesta, si queremos que sea distinta que la del remitente
		$headers .= "Reply-To: ".$autor_email. "\r\n";

		if (@mail ($para,$asunto,$mensaje,$headers))
		{
			echo "Su mail ha sido enviado con exito!!!";
			echo "<br />";
			echo "Pronto recibira un mail con la contraseña";
		}
		else
		{
			echo "Hubo un problema al enviar su mail!!!";		
		};
	}
	else
	{
		echo "Hubo un problema al enviar su contraseña por mail.Por favor contactese con el administrador del sitio";
	}
	
}
else
{
	echo "Para recuperar su contrase&ntilde;a por favor comuniquese con el administrador del sitio.";
	echo "<br /><br /><input type='button' value='Cerrar' onclick='self.close()' class='okbutton'>";
}

?>
</div>
</body>
</html>


