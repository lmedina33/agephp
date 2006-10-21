<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

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
</HEAD>
<body>
<div class="indice">
<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif">
<a href="configbiblioteca.php" class="linkscentrales" title="Biblioteca">Biblioteca</a>&nbsp;<img src="imagenes/p.gif">
<a href="configbibliotecaautores.php" class="linkscentrales" title="Autores">Autores</a>&nbsp;<img src="imagenes/p.gif">&nbsp;Agregar Autor</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/users.gif">&nbsp;Agregar Autor</div><br />
<?
if(!isset($_POST['addautor']))
{
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class='editarperfil' onsubmit="return validarCamposGenerico('nombre')">
		<dl>
			<dt>Nombre del Autor:</dt>
			<dd><input type="text" size="40" name="nombre" id="nombre" /></dd>			
			<br /><br />
			<dt align="right">
			<input type="submit" value="Aceptar" name="addautor" class="inputAdd" />
			&nbsp;&nbsp;<input type="reset" value="Borrar Todo" class="inputAdd" />
			&nbsp;&nbsp;<input type="button" value="Cancelar" class="inputAdd" onclick="javascript:document.location='configbibliotecaautores.php'" /></dt>
		</dl>
	</form>
	

<? 
}
else
{
$lastAutorId="SELECT `idAutor` from `autor` ORDER BY `idAutor` DESC";
$result=$conDB->query($lastAutorId);
$last=$result->fetchRow();
$prox=$last[0]+1;
$nombreAutor=ucfirst($_POST['nombre']);

	$consulta = "INSERT INTO `autor` (`idAutor`, `nombre`) VALUES('$prox','$nombreAutor')";
	$conDB->query($consulta);	

?>
<div class="advice3">&nbsp;&nbsp;Se agreg&oacute; el autor <? echo "\"".$nombreAutor."\"" ?></div><br /><br />
<a href="configbibliotecaautores.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a>
<?
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>