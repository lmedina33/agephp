<?
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = 0; 
if (canAccess($permisoNecesario))
{ 
	$consulta="SELECT `imagenTaller`,`iconoTaller` FROM `taller` WHERE idTaller = '". $_GET['idTall']."'";
	$res = $conDB->query($consulta);
	$row=$res->fetchRow();
	@unlink("imagenes/imgTalleres/".$row[0]);
	@unlink("imagenes/imgTalleres/".$row[1]);
	$consulta = "DELETE FROM taller WHERE idTaller = '". $_GET['idTall']."'"; 
	$res = $conDB->query($consulta);
	
	header("location:configtalleres.php");
}
else
{
	header("location:noprivileges.html");
}
disConnectDB($conDB); ?>