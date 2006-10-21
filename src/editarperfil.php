<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include_once("basico.php"); 
$conDB = connectDB();
session_start();
if (!isset($_SESSION['user']))
{
header("location:noprivileges.html");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<LINK REL="stylesheet" href="estilos/estilos.css" TYPE="text/css">
<script src="scripts/funciones.js" type="text/Javascript"></script>
</HEAD>
<BODY>
<div class="indice">&nbsp;<img src="imagenes/p.gif">&nbsp;Perfil</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/perfil.gif">&nbsp;Perfil</div><br>
<?
if(!isset($_POST['editaperfil']))
{
?>
<?
session_start();
$idUser=$_SESSION['userId'];
$query="SELECT * FROM `persona` WHERE `idPersona`='$idUser'";
$result=$conDB->query($query);
$row=$result->fetchRow();

?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>"  class='editarperfil' onsubmit="return validarCamposGenerico('direccion');">
		
		<dl>
			<dt>Nombre/s:</dt>
			<dd><input type="text" value="<? echo $row[1] ?>" size=25 disabled readonly></dd>
			
			<dt>Apellido/s:</dt>
			<dd><input type="text" value="<? echo $row[2] ?>" size=25 disabled readonly></dd>
			
			<dt>*Email:</dt>
			<dd><input type="text" value="<? echo $row[3] ?>" size="25" name="mail"></dd>

			<dt>*Direcci&oacute;n:</dt>
			<dd><input type="text" size="25" value="<? echo $row[4] ?>" name="direccion" id="direccion"></dd>

			<dt>*Tel&eacute;fono:</dt>
			<dd><input type="text" value="<? echo $row[5] ?>" name="telefono" onkeypress="return validarNumeros(event)"></dd>

			<dt>Fecha de Nacimiento (aaaa-mm-dd):</dt>
			<dd>
			<input type="text" value='<?echo $row[6] ?>' disabled readonly>
			</dd>

			<dt>Nombre de usuario:</dt>
			<dd><input type="text" value="<? echo $row[7]?>" disabled readonly></dd>

			<dt>(&#185;)*Contrase&ntilde;a:</dt>
			<dd><input type="password" value="" id='pass' name="password"></dd>

			<br><br>
			<dt align=right>
			<input type="submit" value="Aceptar" name='editaperfil' class='inputAdd'>
			&nbsp;&nbsp;
			<input type="reset" value="Restaurar Todo" class='inputAdd'>
			</dt>
		</dl>
	</form>
	<h4 class='editarperfilinfo'>
	Informaci&oacute;n: Solo podra modificar los campos marcados con un * (asterisco).<br>
	(&#185;)Dejar en blanco para mantener la contraseña actual.
	</h4>

<? 
}
else
{
session_start();
$password=$_POST['password'];
$email=$_POST['mail'];
$direccion=ucfirst($_POST['direccion']);
$telefono=$_POST['telefono'];
$id=$_SESSION['userId'];
if($password=="")
{
	$query="SELECT `contraseña` FROM `persona` WHERE `idPersona`='$id'";
	$result=$conDB->query($query);
	$row=$result->fetchRow();
	$password=$row[0];
}
else
{
	$password=crypt($password,'chan');
}
$queryUpdateProfile="UPDATE `persona` SET `email` = '$email',`Direccion` = '$direccion',`Telefono` = '$telefono',`contraseña` = '$password' WHERE `idPersona` = $id";
$result=$conDB->query($queryUpdateProfile);
?>
<div class='advice3'>Se actualiz&oacute; su perfil de usuario</div><br>
<br><a href="<?echo $_SERVER['PHP_SELF'];?>" class='linkscentrales' id="volveratras" title='Volver'>Volver atras</a><br><br>
<? 
}
?>

</BODY>
</HTML>
<? disConnectDB($conDB); ?>