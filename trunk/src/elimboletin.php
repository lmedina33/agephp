<?
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = 0; 
if (canAccess($permisoNecesario))
{ 
	
	$nombreArchivo=$_GET['elibol'];
	
	if (@unlink("boletines/".$nombreArchivo))
	{
		$consulta = "DELETE FROM boletin WHERE idBoletin = '". $_GET['idBol']."'"; 
		$res = $conDB->query($consulta);
		header("location:configinstiboletin.php");
	}
	else
	{
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
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
</head>
<body>
<div class="indice"><a href="configinstiboletin.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif"/>&nbsp;Boletines</div>
<div class="textoinfo">
<div class="textoTitle"><img src="imagenes/notice.gif" alt="Informaci&oacute;n" />&nbsp;Informaci&oacute;n</div><br />
	<div class="advice2">Hubo un problema al eliminar el archivo "<? echo $nombreArchivo ?>".<br />Por favor corrobore que dicho archivo exista</div>
	<br />
	<a href="configinstiboletin.php" class="linkscentrales" id="apuntesypracticas" title="Configuraci&oacute;n">Volver</a>
</div>
</body>
</html>
	<?
		}

}
else
{
	header("location:noprivileges.html");
}

disConnectDB($conDB); ?>