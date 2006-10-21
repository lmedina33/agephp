<?
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = "5";
if (canAccess($permisoNecesario))
{ 
	$idLink=$_GET['idLink'];
	$consulta = "DELETE FROM `linksexternos` WHERE `idLink` = '$idLink'";
	$res = $conDB->query($consulta);	
	header("location: configbibliotecalinksexternos.php");
}
else
{
	header("location:noprivileges.html");
}
disConnectDB($conDB); ?>