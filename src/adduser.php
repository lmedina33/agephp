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
<script>
function verificar()
{
	var idTipoPersona=document.getElementById('usertypeid').value;
	if(idTipoPersona=="")
	{
		alert("Primero debe seleccionar el tipo de persona.\r\nSe listaran los permisos de acuerdo al tipo de persona seleccionado.");
		return false;
	}
	else
	{
		listPerm(idTipoPersona,'');
		return true;
	}
}
</script>
</HEAD>
<BODY>
<div class="indice">
<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configusuarios.php" class="linkscentrales" title="Usuarios">Usuarios</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Agregar Usuario</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/perfil.gif" alt="perfil.gif" />&nbsp;Agregar Usuario</div><br />
<?
if(!isset($_POST['adduser']))
{
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" id="adduser" class="editarperfil" onsubmit="return validarCamposGenerico('nombre','apellido','direccion','date1','username','pass','usertypedesc')">
		<dl>
			<dt>Nombre/s:</dt>
			<dd><input type="text" size=25 name="nombre" id="nombre" onkeypress="return validarTexto(event)" /></dd>
			<dt>Apellido/s:</dt>
			<dd><input type="text" size=25 name="apellido" id="apellido" onkeypress="return validarTexto(event)" /></dd>			
			<dt>Email:</dt>
			<dd>
			<input type="text" size="25" name="mail" id="mail" />&nbsp;(En blanco si no tiene)
			</dd>

			<dt>Direcci&oacute;n:</dt>
			<dd>
			<input type="text" size="25" name="direccion" id="direccion" />
			</dd>

			<dt>Tel&eacute;fono:</dt>
			<dd>
			<input type="text" name="telefono" id="telefono" onkeypress="return validarNumeros(event)" />&nbsp;(En blanco si no tiene)
			</dd>

			<dt>Fecha de Nacimiento:</dt>
			<dd>
			<input type="text"  id="date1" readonly="readonly" name="fechaNac" />&nbsp;
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
			<dd><input type="text" name="username" id="username" /></dd>

			<dt>Contrase&ntilde;a:</dt>
			<dd><input type="password" id='pass' name="password" /></dd>

			<dt>Tipo de Persona:</dt>
			<dd>
			<input type="text" id="usertypedesc" name="usertypedesc" readonly="readonly" />
			<input type="hidden" id="usertypeid" name="usertypeid" />
			<input type="button" value="Elegir" onclick="javascript:listUserType();" />
		</dd>
		
		<dt>Permisos:</dt>
				<dd>
			<textarea id="userpermdesc" readonly="readonly" cols="30" rows="5"></textarea>
			<input type="hidden" id="userpermids" name="userpermids" />
			<br />
			<input type="button" value="Asignar o quitar permisos" onclick="javascript:verificar();">
		</dd>
		<br /><br />
			<br /><br />
			<dt align="right"><input type="submit" value="Aceptar" name="adduser" class="inputAdd" />
			&nbsp;&nbsp;<input type="reset" value="Borrar Todo" class="inputAdd" />
			&nbsp;&nbsp;<input type="button" value="Cancelar" class='inputAdd' onclick="javascript:document.location='configusuarios.php'" /></dt>
		</dl>
	</form>
<? 
}
else
{
$nombre=ucfirst($_POST['nombre']);
$apellido=ucfirst($_POST['apellido']);
$email=$_POST['mail'];
$direccion=ucfirst($_POST['direccion']);
$telefono=$_POST['telefono'];
$fechaNac=$_POST['fechaNac'];
$username=$_POST['username'];
$password=crypt($_POST['password'],'chan');
$tipoPersona=$_POST['usertypeid'];


$permids=$_POST['userpermids'];

$lastUserId="SELECT `idPersona` from `persona` ORDER BY `idPersona` desc";
$result=$conDB->query($lastUserId);
$last=$result->fetchRow();
$prox=$last[0]+1;

$queryInsertUser="INSERT INTO `persona` ( `idPersona` , `apellidos` , `nombres` , `email` , `Direccion` , `Telefono` , `FechaNac` , `nombreUsuario` , `contraseña` , `idTipoPersona` ) VALUES ('$prox', '$apellido', '$nombre', '$email', '$direccion', '$telefono', '$fechaNac', '$username', '$password', '$tipoPersona')";

$result=$conDB->query($queryInsertUser);


//////////Inserto los nuevos permisos//////////////

$permids=explode(",",$permids);
$limitpermids=count($permids);

if($limitpermids>0)
	{
	$insert="INSERT INTO `persona_permiso` ( `idPersona` , `idPermiso` ) VALUES ";
	for($i=0;$i<$limitpermids;$i++)
	{
		$values.="('$prox', '$permids[$i]'), ";
	}
	$values=substr($values,0,strlen($values)-2);
	
	$result=$conDB->query($insert.$values);
	}

///////////////////////////////////////////////////
?>
<div class="advice3">&nbsp;&nbsp;Se agreg&oacute; el usuario <? echo "\"".$apellido." ".$nombre."\"" ?></div><br /><br />
<a href="configusuarios.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a>
<?
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>