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
<a href="configbibliotecaautores.php" class="linkscentrales" title="Autores">Autores</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Editar Autor</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/users.gif" alt="users.gif" />&nbsp;Editar Autor</div><br />
<?
if(!isset($_POST['editautor']))
{
$idAutor=$_GET['idAutor'];
$query="SELECT `nombre` FROM `autor` WHERE `idAutor` = '$idAutor'";
$result=$conDB->query($query);
$row=$result->fetchRow();
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class="editarperfil" onsubmit="return validarCamposGenerico('nombre')">
		<dl>
			<dt>Nombre del Tema:</dt>
			<dd><input type="text" value="<?echo $row[0] ?>" size="40" name="nombre" id="nombre" /></dd>			
			<br /><br />
			<dt align="right"><input type="submit" value="Aceptar" name="editautor" class="inputAdd" />&nbsp;&nbsp;<input type="reset" value="Borrar Todo" class="inputAdd" />
			&nbsp;&nbsp;<input type="button" value="Cancelar" class="inputAdd" onclick="javascript:document.location='configbibliotecaautores.php'" /></dt>
		</dl>
		<input type="hidden" value="<?echo $idAutor; ?>" name="idAutor" />
	</form>
<? 
}
else
{
$nombreAutor=ucfirst($_POST['nombre']);
$idAutor=$_POST['idAutor'];
$updateAutor="UPDATE `autor` SET `nombre` = '$nombreAutor' WHERE `idAutor` = '$idAutor'";
$result=$conDB->query($updateAutor);
?>
<div class="advice3">&nbsp;&nbsp;Se actualiz&oacute; el autor <? echo "\"".$nombreAutor."\"" ?></div><br /><br />
<a href="configbibliotecaautores.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a>
<?
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>