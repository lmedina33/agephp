<? 
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = "5"; 
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
<LINK rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<script src="scripts/funciones.js" type="text/Javascript"></script>
</head>
<body>
<div class="indice"><a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif">
<a href="configbiblioteca.php" class="linkscentrales" title="Biblioteca">Biblioteca</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Links Externos</div>
<div class="textoinfo">
<div class="textotitle">&nbsp;<img src="imagenes/link.gif" alt="link.gif" />&nbsp;Links Externos</div><br>
<form action="configbibliotecalinksexternos.php" method="post">
<? 
$listusers="SELECT `idLink`,`nombreLink` from `linksexternos` ORDER BY `idLink`";
	$result=$conDB->query($listusers);
	if($result->numrows()!=0){
	?>
	<table class="textotableusers">
	<tr class="backHeadersTable1">
	<td class="filasusers"><b>Nro</b></td>
	<td class="filasusers" colspan="2"><b>Acci&oacute;n</b></td>
	<td class="filasusers"><b>Nombre de link</b></td>

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
	echo "<a href=\"javascript:editLink($row[0])\" class=\"linkscentrales\" title=\"Editar Link: $row[1]\"><img src=\"imagenes/edituser.gif\" alt=\"Editar Link $row[1]\" /></a>";
	echo "</td>\n";
	echo "<td class=\"filasusers\">";
	echo "<a href=\"javascript:elimLink($row[0],'$row[1]')\" class=\"linkscentrales\" title='Eliminar Link: $row[1]'><img src=\"imagenes/removeuser.gif\" alt=\"Eliminar Link $row[1]\" /></a>";
	echo "</td>\n";
	echo "<td class=\"filasusers\">";
	echo $row[1];
	echo "</td>\n";
	echo "</tr>";
	}
	?>
	</table>
	<?
	}
	else
	{
	echo "<div class=\"advice\">No existen links en la base de datos.<br> Por favor agregue uno.</div>";
	}?>
	<br>
	<div align="right"><input type="button" value="Agregar Link (+)" class="inputAdd" onclick="javascript:addLink()"></div>		
	</form>
</div>
<br><br>
</body>
</html>
<?
disConnectDB($conDB);
?>