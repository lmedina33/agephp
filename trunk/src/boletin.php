<? 
include_once("basico.php"); 
$conDB = connectDB();
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
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<script type="text/javascript" src="scripts/funciones.js"></script>
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Boletin Informativo</div>
<div class="textoinfo">
<div class="textoTitle"><img src="imagenes/boletines.gif" alt="boletines.gif" />&nbsp;Boletines publicados</div><br />
<?
$consulta = "select fecha, nombre, nombreArchivo, idBoletin FROM boletin ORDER BY boletin.fecha";
$result = $conDB->query($consulta);
if ($result->numrows()!=0)
{
?>
<table border="1" class="textotable">
<tr class="backHeadersTable1">	
<td>Fecha</td>
<td>Nombre</td>
<td>Archivo</td>
</tr>	
<?
while ($row =& $result->fetchRow())
{	
	$fileName= "boletines/".$row[2];
	$consulta2 = "SELECT archivo FROM boletin WHERE idBoletin LIKE $row[3]";

	echo "<tr>";		
	echo "<td>";
	if($fecha = strtotime($row[0]))
	{
		echo  gmstrftime ("%d/%m/%Y" ,$fecha);
	}
	echo "</td>";
	echo "<td>";
	echo $row[1];
	echo "</td>";
	echo "<td>";
	
	echo "<img src=\"imagenes/down.gif\" align=\"middle\" alt=\"$row[2]\" />&nbsp;";
	
	$query=encrypt($consulta2,"notelodire");
	$fileName=encrypt($fileName,"notelodire");

	echo "<a class=\"linkscentrales\" href=\"descarga.php?q=$query&amp;f=$fileName\" title=\"Descargar: $row[2]\">";
	echo $row[2];	
	echo "</a><br />";
	echo "</td>";
	echo "</tr>";
}
?>
</table>
<?
}
else
{?>
<div class="advice">No existen boletines en la base de datos.</div>	
<? } ?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>