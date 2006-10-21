<? include_once("basico.php"); 
$conDB = connectDB();
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title> New Document </title>
<meta name="Generator" content="EditPlus" />
<meta name="Author" content="" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="estilos/estilos.css" />
<script type="text/javascript" src="scripts/funciones.js"></script>
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="scripts/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	language : "es",
	theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright, justifyfull,strikethrough,separator,bullist,numlist,outdent,indent,separator,hr,separator,forecolor,backcolor,",
	theme_advanced_buttons2 : "link,unlink,separator,removeformat,separator,undo,redo",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
});
</script>
<!-- /tinyMCE -->
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Contacto</div>
<div class="textoinfo">
<? if ($_POST){

	$destinatario = getTexts($conDB,'colegio','email');
$asunto = $_POST["asunto"];
$mensaje = "<html>";
$mensaje.="<head><title>Correo de Joaquin V Gonzalez</title>";
$mensaje.="</head>";
$mensaje.="<body>";
$mensaje.="<p>";
$mensaje.=$_POST["mensaje"];
$mensaje.="</p>";
$mensaje.="</body>";
$mensaje.="</html>";

//para el envío en formato HTML
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente
$headers .= "From:".$_POST["nombreyapellido"]." <".$_POST["email"].">\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente
$headers .= "Reply-To: ".$_POST["email"]. "\r\n";
	
	if (@mail ($destinatario,$asunto,$mensaje,$headers))
	{
		echo "<h4 class=\"succes\">Su mail ha sido enviado con exito!!!</h4>";
	}
	else
	{
		echo "<div class=\"textoTitle\">&nbsp;<img src=\"imagenes/notice.gif\" alt=\"notice.gif\" />&nbsp;Informaci&oacute;n</div><br />";
		echo "<h4 class=\"advice\">Hubo un problema al enviar su mail!!!</h4>";
		echo "<br /><br /><a href='".$_SERVER['PHP_SELF']."' class=\"linkscentrales\" id=\"mailAgain\" title=\"Intentar enviar nuevamente\">Intentar enviar nuevamente</a>";
	};
	echo "</div>";
}
else
{
?>
<div class="textoTitle">&nbsp;<img src="imagenes/contacto.gif" alt="contacto.gif" />&nbsp;Contacto</div><br />
<form class='editarperfil' action="<?echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return validarCamposGenerico('nombreyapellido','email','asunto','mensaje')">
<br />
<dt>Nombre y apellido:&nbsp;<input class="contactInput" type="text" name="nombreyapellido" id="nombreyapellido" size="40"></dt>
<dt>Email:&nbsp;<input class="contactInput" type="text" name="email" id="email" size="54" /></dt>
<dt>Asunto:&nbsp;<input class="contactInput" type="text" name="asunto" id="asunto" size="53" /></dt>
<dt>Comentario:&nbsp;<textarea name="mensaje" rows="10" cols="50" id="mensaje"></textarea></dt>
<dd><input type="submit" value="Enviar" id="Enviar" />
<input type="reset" value="Borrar todo" /></dd><br /><br />
</form>
</div>
<?  } ?>
</body>
</html>
<? disConnectDB($conDB);?>