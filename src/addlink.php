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
<meta name="Keywords" content="">
<meta name="Description" content="">
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<script src="scripts/funciones.js" type="text/Javascript"></script>
<style type="text/css">@import url(scripts/calendar-blue.css);</style>
<script type="text/javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="scripts/lang/calendar-es.js"></script>
<script type="text/javascript" src="scripts/calendar-setup.js"></script>
</head>
<body>
<div class="indice">
<a href="configuracion.php" class="linkscentrales">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configbiblioteca.php" class="linkscentrales" title="Biblioteca">Biblioteca</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configbibliotecalinksexternos.php" class="linkscentrales" title="Links Externos">Links Externos</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Agregar Link</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/link.gif" alt="link.gif" />&nbsp;Agregar Link</div><br />
<?
if(!isset($_POST['addlink']))
{
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class="editarperfil" onsubmit="return validarCamposGenerico('nombre','url')">
		<dl>
			<dt>Nombre del Link:</dt>
			<dd><input type="text" size="40" name="nombre" id="nombre" /></dd>			
			<dt>Url del link:</dt>
			<dd><input type="text" value="http://" size="40" name="url" id="url" /></dd>	
			<br /><br />
			<dt align=right><input type="submit" value="Aceptar" name="addlink" class="inputAdd" />&nbsp;&nbsp;<input type="reset" value="Borrar Todo" class="inputAdd" />&nbsp;&nbsp;<input type="button" value="Cancelar" class="inputAdd" onclick="javascript:document.location='configbibliotecalinksexternos.php'" /></dt>
		</dl>
	</form>
<? 
}
else
{
$lastTemaId="SELECT `idLink` from `linksexternos` ORDER BY `idLink` DESC";
$result=$conDB->query($lastTemaId);
$last=$result->fetchRow();
$prox=$last[0]+1;
$nombreLink=ucfirst($_POST['nombre']);
$urlLink=$_POST['url'];

	$consulta = "INSERT INTO `linksexternos` (`idLink`, `nombreLink`,`urlLink`) VALUES('$prox','$nombreLink','$urlLink')";
	$conDB->query($consulta);	

?>
<div class="advice3">&nbsp;&nbsp;Se agreg&oacute; el link <? echo "\"".$nombreLink."\"" ?></div><br /><br />
<a href="configbibliotecalinksexternos.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a>
<?
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>