<?
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = 0; 
if (canAccess($permisoNecesario))
{ 
	$consulta = "DELETE FROM proyecto WHERE idProyecto = '". $_GET['idProy']."'"; 
	$res = $conDB->query($consulta);
	header("location:configproyectos.php");
}
else
{
	header("location:noprivileges.html");
}
disConnectDB($conDB); ?>