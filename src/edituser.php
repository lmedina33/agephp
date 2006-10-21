<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = "0"; 
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
<meta NAME="Generator" content="EditPlus">
<meta NAME="Author" content="">
<meta NAME="Keywords" content="">
<meta NAME="Description" content="">
<LINK REL="stylesheet" href="estilos/estilos.css" TYPE="text/css">
<script src="scripts/funciones.js" type="text/Javascript"></script>
<style type="text/css">@import url(scripts/calendar-blue.css);</style>
<script type="text/javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="scripts/lang/calendar-es.js"></script>
<script type="text/javascript" src="scripts/calendar-setup.js"></script>
<script>
function verificar(idUser)
{
	var idTipoPersona=document.getElementById('usertypeid').value;
	if(idTipoPersona=="")
	{
		alert("Primero debe seleccionar el tipo de persona.\r\nSe listaran los permisos de acuerdo al tipo de persona seleccionado.");
		return false;
	}
	else
	{
		listPerm(idTipoPersona,idUser);
		return true;
	}
}
</script>
</head>
<body>
<div class="indice">
<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configusuarios.php" class="linkscentrales" title="Usuarios">Usuarios</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Editar Usuario</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/perfil.gif" alt="perfil.gif"/>&nbsp;Editar Usuario</div><br />
<?
if(!isset($_POST['edituser']))
{
?>
<?
$idUser=$_GET['idUser'];
$query="SELECT p.apellidos, p.nombres, p.email, p.Direccion, p.Telefono, p.FechaNac, p.nombreUsuario, p.contraseña, p.idTipoPersona, tp.tipo FROM `persona` as p INNER JOIN tipopersona AS tp ON p.idTipoPersona = tp.idTipoPersona WHERE p.idPersona = '$idUser'";
$result=$conDB->query($query);
$row=$result->fetchRow();
$consulta = "SELECT pp.idPersona, pp.idPermiso,pe.descripcion FROM persona_permiso as pp INNER JOIN persona AS u ON pp.idPersona = u.idPersona INNER JOIN permiso AS pe ON pe.idPermiso = pp.idPermiso WHERE pp.idPersona = $idUser"; 
$result = $conDB->query($consulta);
?>

<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" id="edituser" class="editarperfil" onsubmit="return validarCamposGenerico('nombre','apellido','direccion','date1','username','usertypedesc')">
		
		<dl>
			<dt>Nombre/s:</dt>
			<dd>
			<input type="text" value="<? echo $row[1] ?>" size=25 name="nombre" id="nombre" onkeypress="return validarTexto(event)" />
			</dd>
			
			<dt>Apellido/s:</dt>
			<dd>
			<input type="text" value="<? echo $row[0] ?>" size=25 onkeypress="return validarTexto(event)" name="apellido" id="apellido" />
			</dd>
			
			<dt>Email:</dt>
			<dd>
			<input type="text" value="<? echo $row[2] ?>" size="25" name="mail" id="mail">&nbsp;(Dejar en blanco si no tiene)
			</dd>

			<dt>Direcci&oacute;n:</dt>
			<dd>
			<input type="text" size="25" value="<? echo $row[3] ?>" name="direccion" id="direccion" />
			</dd>

			<dt>Tel&eacute;fono:</dt>
			<dd>
			<input type="text" value="<? echo $row[4] ?>" name="telefono" onkeypress="return validarNumeros(event)" id="telefono" />&nbsp;(Dejar en blanco si no tiene)
			</dd>

			<dt>Fecha de Nacimiento:</dt>
			<dd>
			<input type="text"  value="<?echo $row[5] ?>" id="date1" readonly="readonly" name="fechaNac" />&nbsp;
			<button type="reset" id="but1" class='inputAdd'>...</button>
			<script type="text/javascript">
				Calendar.setup({
					inputField     :    "date1",           //*
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    false,
					button         :    "but1",        //*
					step           :    1
				});				
			</script>						
			</dd>
			<dt>Nombre de usuario:</dt>
			<dd><input type="text" value="<? echo $row[6]?>" name="username" id="username"></dd>

			<dt>*Contrase&ntilde;a:</dt>
			<dd><input type="password" value="" id="pass" name="password"></dd>

			<dt>Tipo de Persona:</dt>
			<dd>
			<input type="text" value="<? echo $row[9] ?>" id="usertypedesc" name="usertypedesc" readonly="readonly" />
			<input type="hidden" value="<?echo $row[8] ?>" id="usertypeid" name="usertypeid" />
			<input type="button" value="Seleccionar" onClick="javascript:listUserType();" class="inputAdd" />
		</dd>
		
		<dt>Permisos:</dt>
		<dd>
			<textarea id="userpermdesc" readonly="readonly" cols="30" rows="5"><? while($row = $result->fetchRow()){echo $row[2]."\r\n";$idperm.=$row[1].",";}?></textarea>
			<input type="hidden" value="<? echo $idperm; ?>" id="userpermids" name="userpermids" />
			<br />
			<input type="button" value="Asignar o quitar permisos" onclick="javascript:verificar(<? echo $idUser ?>);" />
		</dd>
		<br /><br />
			<input type="hidden" value="<?echo $idUser?>" name="idUser" />
			<br /><br />
			<dt align=right>
			<input type="submit" value="Aceptar" name="edituser" class="inputAdd">&nbsp;&nbsp;<input type="reset" value="Restaurar Todo" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="button" value="Cancelar" class="inputAdd" onclick="document.location='configusuarios.php'" />
			</dt>
		</dl>
	</form>
	<h4 class="editarperfilinfo">
	Informaci&oacute;n: *Dejar en blanco para mantener la contraseña actual.
	</h4>
<? 
}
else
{
$nombre=ucfirst($_POST['nombre']);
$apellido=ucfirst($_POST['apellido']);
$password=$_POST['password'];
$email=$_POST['mail'];
$direccion=ucfirst($_POST['direccion']);
$telefono=$_POST['telefono'];
$fechaNac=$_POST['fechaNac'];
$id=$_POST['idUser'];
$tipoPersona=$_POST['usertypeid'];
$permids=$_POST['userpermids'];

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
//////////////Actualizo el perfil///////////////
$queryUpdateProfile="UPDATE `persona` SET `nombres` = '$nombre', `apellidos` = '$apellido' ,`email` = '$email',`Direccion` = '$direccion',`Telefono` = '$telefono',`FechaNac` = '$fechaNac',`contraseña` = '$password',`idTipoPersona` = '$tipoPersona' WHERE `idPersona` = $id";
$result=$conDB->query($queryUpdateProfile);
/////////////////////////////////////////////

//////////Borro los permisos viejos////////////
$queryDeletePersonPerm="DELETE FROM `persona_permiso` WHERE idPersona = '$id'";
$result=$conDB->query($queryDeletePersonPerm);
/////////////////////////////////////////////////

//////////Inserto los nuevos permisos//////////////
$permids=explode(",",$permids);
$limitpermids=count($permids);

if($limitpermids>0)
	{
	$insert="INSERT INTO `persona_permiso` ( `idPersona` , `idPermiso` ) VALUES ";
	for($i=0;$i<$limitpermids;$i++)
	{
		$values.="('$id', '$permids[$i]'), ";
	}
	$values=substr($values,0,strlen($values)-2);
	$result=$conDB->query($insert.$values);
	}
///////////////////////////////////////////////////

?>
<div class="advice3">&nbsp;&nbsp;Se actualiz&oacute; el perfil de usuario de "<? echo $apellido." ".$nombre ?>"</div><br />
<br /><a href="configusuarios.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a><br /><br />
<? 
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>