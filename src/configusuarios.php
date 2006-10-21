<? 
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = 0; 
if (!canAccess($permisoNecesario))
{
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
<script type="text/javascript" src="scripts/funciones.js"></script>
</head>
<body>
<div class="indice"><a href="configuracion.php" class="linkscentrales" title="Apuntes y Pr&aacute;cticas">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Usuarios</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/users.gif" alt="users.gif" />&nbsp;Usuarios</div><br />
<? 		
	$listusers="SELECT p.apellidos,p.nombres,p.nombreUsuario,p.idPersona,tp.tipo from persona as p INNER JOIN tipopersona AS tp ON p.idTipoPersona = tp.idTipoPersona WHERE p.idPersona<> '0' ORDER BY nombreUsuario ";
	
	$result=$conDB->query($listusers);
	if ($result->numrows()!=0){
	?>
	<form action="configusuarios.php" method="post">
	<table class="textotableusers">
	<tr class="backHeadersTable1">
	<td class="filasusers"><b>Editar</b></td>
	<td class="filasusers"><b>Eliminar</b></td>
	<td class="filasusers">Apellido</td>
	<td class="filasusers">Nombre</td>
	<td class="filasusers">Nombre de usuario</td>
	<td class="filasusers">Tipo de usuario</td>
	</tr>
	<? 
	while ($row=$result->fetchRow())
	{
	echo "<tr>";
	echo "<td class=\"filasusers\">";
	echo "<a href=\"javascript:edituser($row[3])\" class=\"linkscentrales\" title=\"Editar Usuario: $row[0] $row[1]\"><img src=\"imagenes/edituser.gif\" alt=\"Editar Usuario: $row[0] $row[1]\"></a>";
	echo "</td>";
	echo "<td class=\"filasusers\">";
	echo "<a href=\"javascript:elimuser($row[3],'$row[0] $row[1]')\" class=\"linkscentrales\" title=\"Eliminar Usuario: $row[0] $row[1]\"><img src=\"imagenes/removeuser.gif\" alt=\"Eliminar Usuario: $row[0] $row[1]\"></a>";
	echo "</td>";
	echo "<td class=\"filasusers\">";
	echo $row[0];
	echo "</td>";
	echo "<td class=\"filasusers\">";
	echo $row[1];
	echo "</td>";
	echo "<td class=\"filasusers\">";
	echo $row[2];
	echo "</td>";
	echo "<td class=\"filasusers\">";
	echo $row[4];
	echo "</td>";
	echo "</td>";
	}
	?>
	</table>
	<?
	}
	else
	{?>
	<div class="advice">No existen usuarios en la base de datos.<br /> Por favor cree uno.</div>	
	<?
		}
	?>
	<br />
	<div align="right"><input type="button" value="Agregar usuario (+)" class="inputAdd" onclick="javascript:addUser()"></div>
	</form>
	</div>
</body>
</html>
<? disConnectDB($conDB); ?>