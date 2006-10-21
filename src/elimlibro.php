<?
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = "5";
if (canAccess($permisoNecesario))
{ 
	$consulta = "DELETE FROM libro WHERE idLibro = '". $_GET['idBook']."'"; 
	$res = $conDB->query($consulta);
	
	$consulta = "DELETE FROM libro_autor WHERE idLibro = '". $_GET['idBook']."'"; 
	$res = $conDB->query($consulta);	

	header("location: configbibliotecalibros.php");
}
else
{
	header("location:noprivileges.html");
}
disConnectDB($conDB); ?>