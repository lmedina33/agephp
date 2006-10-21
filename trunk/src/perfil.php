<? 
include_once("basico.php"); 
$conDB = connectDB();
session_start();
if (!isset($_SESSION['user']))
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
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Perfil</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/perfil.gif" alt="perfil.gif" />&nbsp;Perfil</div><br />
<?
session_start();
$idUser=$_SESSION['userId'];
$query="SELECT * FROM `persona` WHERE `idPersona`='$idUser'";
$result=$conDB->query($query);
$row=$result->fetchRow();

?>
<form class="editarperfil">
		
		<dl>
			<dt>Nombre/s:</dt>
			<dd><input type="text" value="<? echo $row[1] ?>" size="35" readonly="readonly" /></dd>
			
			<dt>Apellido/s:</dt>
			<dd><input type="text" value="<? echo $row[2] ?>" size="35" readonly="readonly" /></dd>
			
			<dt>Email:</dt>
			<dd><input type="text" value="<? echo $row[3] ?>" size="35" readonly="readonly" /></dd>

			<dt>Direcci&oacute;n:</dt>
			<dd><input type="text" size="35" value="<? echo $row[4] ?>" readonly="readonly" /></dd>

			<dt>Tel&eacute;fono:</dt>
			<dd><input type="text" value="<? echo $row[5] ?>" size="35" readonly="readonly" /></dd>

			<dt>Fecha de Nacimiento (aaaa-mm-dd):</dt>
			<dd>
			<input type="text" value="<?echo $row[6] ?>" size="35" readonly="readonly" />
			</dd>
			<dt>Nombre de usuario:</dt>
			<dd><input type="text" value="<? echo $row[7]?>" size="35" readonly="readonly" /></dd>
		</dl>
	</form>
	<h4 class="editarperfilinfo">
	Informaci&oacute;n: Si algun dato es incorrecto, por favor comuniquese con el administrador del colegio para poder actualizarlo.
	</h4>
</body>
</html>
<? disConnectDB($conDB); ?>