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
<a href='configbiblioteca.php' class="linkscentrales" title="Biblioteca">Biblioteca</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif"/>
<a href='configbibliotecatemas.php' class="linkscentrales" title="Temas">Temas</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Editar Tema</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/datosbasicos.gif">&nbsp;Editar Tema</div><br />
<?
if(!isset($_POST['edittema']))
{
$idTema=$_GET['idTema'];
$query="SELECT `nombre` FROM `tema` WHERE `idTema` = $idTema";
$result=$conDB->query($query);
$row=$result->fetchRow();
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class="editarperfil" onsubmit="return validarCamposGenerico('nombre')">
		<dl>
			<dt>Nombre del Tema:</dt>
			<dd><input type="text" value="<?echo $row[0] ?>" size="40" name="nombre" id="nombre" /></dd>			
			<br /><br />
			<dt align="right"><input type="submit" value="Aceptar" name="edittema" class="inputAdd" />
			&nbsp;&nbsp;<input type="reset" value="Borrar Todo" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="button" value="Cancelar" class="inputAdd" onclick="javascript:document.location='configbibliotecatemas.php'" /></dt>
		</dl>
		<input type="hidden" value="<?echo $idTema; ?>" name="idTema" />
	</form>
<? 
}
else
{
$nombreTema=ucfirst($_POST['nombre']);
$idTema=$_POST['idTema'];
$updateTema="UPDATE `tema` SET `nombre` = '$nombreTema' WHERE `idTema` = '$idTema'";
$result=$conDB->query($updateTema);
?>
<div class='advice3'>&nbsp;&nbsp;Se actualiz&oacute; el tema <? echo "\"".$nombreTema."\"" ?></div><br /><br />
<a href="configbibliotecatemas.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a>
<?
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>