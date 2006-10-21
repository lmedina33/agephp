<? 
session_start(); 
include_once("basico.php"); 
$conDB = connectDB();
$user = $_POST["user"];
$pass = $_POST["pass"];
$query="SELECT persona.nombreUsuario,persona.contraseña,persona.nombres,persona.idPersona,tipopersona.tipo FROM persona,tipopersona WHERE tipopersona.idtipopersona = persona.idtipopersona and persona.nombreUsuario='$user'"; 
$result=$conDB->query($query); 
if(!$row=$result->fetchRow())
{ 
	header("location: loginerror.html");
}
else
{ 

if($row[1]==md5($pass))
	{ 
		$arreglo=array();
		$query2="SELECT idPermiso FROM persona_permiso WHERE idPersona='$row[3]'"; 
		$result2=$conDB->query($query2);
		while($row2=$result2->fetchRow())
		{
			array_push($arreglo, $row2[0]);
			
		}
		$_SESSION["permisos"]=$arreglo;
		$_SESSION["user"]=$user; 
		$_SESSION["nombres"]=$row[2];
		$_SESSION["userId"]=$row[3];
		$_SESSION["tipopersona"]=$row[4];
		
		header("location: index2.php");
	} 
	else 
	{ 
		header("location: loginerror.html");
	}
} 
?> 
