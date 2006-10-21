<? 
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = 0; 
if (!canAccess($permisoNecesario))
{
	header("location:noprivilegies.html");
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
<LINK rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<script src="scripts/funciones.js" type="text/Javascript"></script>
</head>
<body>
<div class="indice"><a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Proyectos</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/projects.gif" alt="proyects.gif" />&nbsp;Proyectos</div><br>
<? 
$listusers="SELECT `idProyecto`,`nombreProyecto` from proyecto ORDER BY `idProyecto`";
	$result=$conDB->query($listusers);
	?>
	<form action="configproyectos.php" method="post">
	<table class="textotableusers">
	<tr class="backHeadersTable1">
	<td class="filasusers"><b>Nro</b></td>
	<td class="filasusers" colspan="2"><b>Acci&oacute;n</b></td>
	<td class="filasusers"><b>Nombre del proyecto</b></td>
	</tr>
	<? 
	while ($row=$result->fetchRow())
	{
	$i++;
	echo "<tr>";
	echo "<td class=\"filasusers\">";
	echo $i;
	echo "</td>\n";
	echo "<td class=\"filasusers\">";
	echo "<a href=\"javascript:editproyect($row[0])\" class=\"linkscentrales\" title=\"Editar proyecto: $row[1]\"><img src=\"imagenes/edituser.gif\" alt=\"Editar Proyecto $row[1]\" /></a>";
	echo "</td>\n";
	echo "<td class=\"filasusers\">";
	echo "<a href=\"javascript:elimproyect($row[0],'$row[1]')\" class=\"linkscentrales\" title=\"Eliminar Proyecto: $row[1]\"><img src=\"imagenes/removeuser.gif\" alt=\"Eliminar Proyecto $row[1]\"></a>";
	echo "</TD>\n";
	echo "<TD class=\"filasusers\">";
	echo $row[1];
	echo "</TD>\n";
	echo "</TR>";
	}
	?>
	</table>
	<br>
	<div align="right"><input type="button" value="Agregar proyecto (+)" class="inputAdd" onclick="javascript:addProyect()" /></div>
	</form>
</div>
<br><br>
</body>
</html>
<?
disConnectDB($conDB);
?>