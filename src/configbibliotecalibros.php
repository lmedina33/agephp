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
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<script src="scripts/funciones.js" type="text/Javascript"></script>
</head>

<body>
<div class="indice"><a href="configuracion.php" class="linkscentrales" title="Apuntes y Pr&aacute;cticas">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configbiblioteca.php" class="linkscentrales" title="Biblioteca">Biblioteca</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Libros</div>
<div class="textoinfo">
<div class="textotitle">&nbsp;<img src="imagenes/book.gif" alt="book.gif" />&nbsp;Libros</div><br />
<form action="configbibliotecalibros.php" method="post">
<? 
$listusers="SELECT `idLibro`,`nombre` from libro ORDER BY `idLibro`";
	$result=$conDB->query($listusers);
	if($result->numrows()!=0){
	?>

	<table class="textotableusers">
	<tr class="backHeadersTable1">
	<td class="filasusers"><b>Nro</b></td>
	<td class="filasusers" colspan="2"><b>Acci&oacute;n</b></td>
	<td class="filasusers"><b>Nombre del libro</b></td>
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
	echo "<a href=\"javascript:editbook($row[0])\" class=\"linkscentrales\" title=\"Editar Libro: $row[1]\"><img src=\"imagenes/edituser.gif\" alt=\"Editar Libro $row[1]\"></a>";
	echo "</td>\n";
	echo "<td class=\"filasusers\">";
	echo "<a href=\"javascript:elimbook($row[0],'$row[1]')\" class=\"linkscentrales\" title=\"Eliminar Libro: $row[1]\"><img src=\"imagenes/removeuser.gif\" alt=\"Eliminar Libro $row[1]\"></a>";
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
	echo "<div class=\"advice\">No existen libros en la base de datos.<br /> Por favor agregue uno.</div>";
	}?>
	<br />
	<div align="right"><input type="button" value="Agregar Libro (+)" class='inputAdd' onclick="javascript:addBook()" /></div>		
	</form>
</div>
<br /><br />
</body>
</html>
<?
disConnectDB($conDB);
?>