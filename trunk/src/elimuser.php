<?
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = 0; 
if (canAccess($permisoNecesario))
{ 
	$consulta = "DELETE FROM persona WHERE idPersona = '". $_GET['idUser']."'"; 
	$res = $conDB->query($consulta);
	$consulta = "DELETE FROM persona_permiso WHERE idPersona = '". $_GET['idUser']."'"; 
	$res = $conDB->query($consulta);
	
	header("location:configusuarios.php");
}
else
{
	header("location:noprivileges.html");
}
disConnectDB($conDB); ?>