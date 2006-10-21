<?
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = "5";
if (canAccess($permisoNecesario))
{ 
	$idAutor=$_GET['idAutor'];
	
	//Elimino los autores asociados al libro segun el id pasado por parametro
	$consulta = "DELETE FROM `libro_autor` WHERE `idAutor` = '$idAutor'";
	$res = $conDB->query($consulta);


	//Elimino el autor asociado al id pasado por parametro
	$consulta = "DELETE FROM `autor` WHERE `idAutor` = '$idAutor'";
	$res = $conDB->query($consulta);
	
	
	header("location:configbibliotecaautores.php");
	

}
else
{
		header("location:noprivileges.html");
}
disConnectDB($conDB); ?>