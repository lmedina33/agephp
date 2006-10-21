<? 
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = "5"; 
if (!canAccess($permisoNecesario)){
header("location:noprivileges.html");
}
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
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<script src="scripts/funciones.js" type="text/Javascript"></script>
<style type="text/css">@import url(scripts/calendar-blue.css);</style>
<script type="text/javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="scripts/lang/calendar-es.js"></script>
<script type="text/javascript" src="scripts/calendar-setup.js"></script>
</head>
<body>
<div class="indice">
<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configbiblioteca.php" class="linkscentrales" title="Biblioteca">Biblioteca</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configbibliotecalinksexternos.php" class="linkscentrales" title="Links Externos">Links Externos</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Editar Link</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/link.gif" alt="link.gif" />&nbsp;Editar Link</div><br />
<?
if(!isset($_POST['editlink']))
{
$idLink=$_GET['idLink'];
$consulta="SELECT `nombreLink`,`urlLink` FROM `linksexternos` WHERE `idLink`='$idLink'";
$result=$conDB->query($consulta);
$row=$result->fetchRow();
$nombreLink=$row[0];
$urlLink=$row[1];
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class="editarperfil" onsubmit="return validarCamposGenerico('nombre','url')">
		<dl>
			<dt>Nombre del Link:</dt>
			<dd><input type="text" value="<?echo $nombreLink;?>" size="40" name="nombre" id="nombre"></dd>			
			<dt>Url del link:</dt>
			<dd><input type="text" value="<?echo $urlLink;?>" size="40" name="url" id="url"></dd>	
			<br /><br />
			<dt align=right><input type="submit" value="Aceptar" name="editlink" class="inputAdd" />&nbsp;&nbsp;<input type="reset" value="Borrar Todo" class="inputAdd" />&nbsp;&nbsp;<input type="button" value="Cancelar" class="inputAdd" onclick="javascript:document.location='configbibliotecalinksexternos.php'" /></dt>
		</dl>
		<input type="hidden" value="<?echo $idLink; ?>" name="idLink" />
	</form>
<? 
}
else
{
$nombreLink=ucfirst($_POST['nombre']);
$urlLink=$_POST['url'];
$idLink=$_POST['idLink'];

	$consulta = "UPDATE `linksexternos` SET `nombreLink` = '$nombreLink',`urlLink` = '$urlLink' WHERE `idLink` = '$idLink'";
	$conDB->query($consulta);	

?>
<div class="advice3">&nbsp;&nbsp;Se acutaliz&oacute; el link <? echo "\"".$nombreLink."\"" ?></div><br /><br />
<a href="configbibliotecalinksexternos.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a>
<?
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>