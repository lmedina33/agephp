<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = "0";
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
<link REL="stylesheet" href="estilos/estilos.css" TYPE="text/css" />
<script src="scripts/funciones.js" type="text/Javascript"></script>
</head>
<body>
<div class="indice"><a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Talleres</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/talleres.gif" alt="talleres.gif" />&nbsp;Talleres</div><br />

<? 
$listusers="SELECT `idTaller`,`nombreTaller` from taller ORDER BY `idTaller`";
	$result=$conDB->query($listusers);
	?>
	<form action="configtalleres.php" method="post">
	<table class="textotableusers">
	<tr class="backHeadersTable1">
	<td class="filasusers"><b>Nro</b></td>
	<td class="filasusers" colspan=2><b>Acci&oacute;n</b></td>
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
	echo "<a href=\"javascript:edittaller($row[0])\" class='linkscentrales' title=\"Editar Taller: $row[1]\"><img src=\"imagenes/edituser.gif\" alt=\"Editar Taller $row[1]\" /></a>";
	echo "</td>\n";
	echo "<td class='filasusers'>";
	echo "<a href=\"javascript:elimtaller($row[0],'$row[1]')\" class=\"linkscentrales\" title=\"Eliminar Taller: $row[1]\"><img src=\"imagenes/removeuser.gif\" alt=\"Eliminar Taller $row[1]\" /></a>";
	echo "</td>\n";
	echo "<td class=\"filasusers\">";
	echo $row[1];
	echo "</td>\n";
	echo "</tr>";
	}
	?>
	</table>
	<br />
	<div align="right"><input type="button" value="Agregar Taller (+)" class="inputAdd" onclick="javascript:addTaller()"></div>		
	</form>
</div>
<br /><br />
</body>
</html>
<?
disConnectDB($conDB);
?>