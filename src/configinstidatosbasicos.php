<? 
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = 0; 
if (!canAccess($permisoNecesario))
{
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
</head>
<body>
<div class="indice">
<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configinsti.php" class="linkscentrales" title="Instituci&oacute;n">Instituci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" /> 
Datos B&aacute;sicos
</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/datosbasicos.gif" alt="datosbasicos.gif" />&nbsp;Datos B&aacute;sicos</div><br />
<?
if(!isset($_POST['editainstidatosbasicos']))
{
$query="SELECT `idColegio`,`nombre`,`direccion`,`telefono`,`email` FROM `colegio`";
$result=$conDB->query($query);
$row=$result->fetchRow();
?>

<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class="editarperfil" onsubmit="return validarCamposGenerico('nombrecolegio','direccion','telefono','mail')">
		
		<dl>
			<dt>Nombre del Colegio:</dt>
			<dd><input type="text" value="<? echo $row[1] ?>" size="50" name="nombrecolegio" id="nombrecolegio" /></dd>
			<dt>Direcci&oacute;n:</dt>
			<dd><input type="text" value="<? echo $row[2] ?>" size="50" name="direccion" id="direccion"></dd>
			<dt>Tel&eacute;fono:</dt>
			<dd><input type="text" value="<? echo $row[3] ?>" size="50" name="telefono" id="telefono" /></dd>
			<dt>Email:</dt>
			<dd><input type="text" size="50" value="<? echo $row[4] ?>" name="mail" id="mail" /></dd>
			<br /><br />
			<dt align=right>
			<input type="submit" value="Aceptar" name="editainstidatosbasicos" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="reset" value="Restaurar Todo" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="button" value="Cancelar" class="inputAdd" onclick="document.location='configinsti.php'" />
			</dt>
		</dl>
		<input type="hidden" value="<? echo $row[0] ?>" name="id" />
	</form>
<? 
}
else
{
$id=$_POST['id'];
$nombrecolegio=$_POST['nombrecolegio'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$email=$_POST['mail'];
$queryUpdateDatos="UPDATE `colegio` SET `nombre` = '$nombrecolegio',`email` = '$email',`direccion` = '$direccion',`telefono` = '$telefono' WHERE `idColegio` = '$id'";
$result=$conDB->query($queryUpdateDatos);
?>
<div class="advice3">Se actualizaron los datos basicos del colegio</div><br />
<br /><a href="configinsti.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a><br /><br />
<? 
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>