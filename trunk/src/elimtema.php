<?
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = "5";
if (canAccess($permisoNecesario))
{ 
	$idTema=$_GET['idTema'];
	
	$consulta ="SELECT `idLibro` FROM `libro` WHERE `idTema`='$idTema'";
	$res = $conDB->query($consulta);
	while($row=$res->fetchRow())
	{
		$idlibros[]=$row[0];
	}
	//Elimino los libros asociados al id pasado por parametro
	$consulta = "DELETE FROM `libro` WHERE `idTema` = '$idTema'";
	$res = $conDB->query($consulta);
	
	//Elimino el tema asociado al id pasado por parametro
	$consulta = "DELETE FROM `tema` WHERE idTema = '$idTema'";
	$res = $conDB->query($consulta);

	//Elimino los libros asociados al autor segun el id pasado por parametro
	for($i=0;$i<count($idlibros);$i++)
	{$consulta = "DELETE FROM `libro_autor` WHERE `idLibro` = '$idlibros[$i]'";
	$res = $conDB->query($consulta);
	}
	
	header("location:configbibliotecatemas.php");
	

}
else
{
		header("location:noprivileges.html");
}
disConnectDB($conDB); ?>