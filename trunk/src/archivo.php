<? 
include_once("basico.php"); 
$conDB = connectDB();

$permisoNecesario = "1";
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
<div class="indice"><a href="apuntesypracticas.php" class="linkscentrales" id="apuntesypracticas" title="Apuntes y Pr&aacute;cticas">Apuntes y Pr&aacute;cticas</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;
<?
$nombreMateria=$_GET['nombreMateria'];
$nombreanio=$_GET['nombreAnio'];
$nombreNivel=$_GET['nombreNivel'];
$materia=$nombreMateria." - ".$nombreanio." año ".$nombreNivel;
echo $materia;
?>
</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/normativas.gif" alt="normativas" /s>&nbsp;Apuntes y Pr&aacute;cticas de 
<?
echo $_GET['nombreMateria']." (";
echo $_GET['nombreAnio']." año ";
echo $_GET['nombreNivel'].")";
?>
</div><br />
<?
$consulta = "select fecha, infoArchivo, nombreArchivo, idArchivo FROM archivo WHERE archivo.idCurso = '".$_GET['idCurso']."' ORDER BY archivo.fecha";
$result = $conDB->query($consulta);
if ($result->numrows()!=0)
{
?>
<table border="1" height="48"  class="textotable">
<tr class='backHeadersTable1'>	
<td>Fecha</td>
<td>Nombre</td>
<td>Archivo</td>
</tr>	
<?
while ($row =& $result->fetchRow())
{	
	$path= "archivos/".$_GET['idCurso']."/";
	$fileName= $path.$row[2];
	$consulta2 = "SELECT archivo FROM archivo WHERE idArchivo LIKE $row[3]";	
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
	echo "<img src=\"imagenes/down.gif\" align=\"center\" alt\"down.gif\">&nbsp;";
	$query=encrypt($consulta2,"notelodire");
	$fileName=encrypt($fileName,"notelodire");
	echo "<a class='linkscentrales' ";
	echo "href='descarga.php?consulta=q=$query&amp;f=$fileName' id=$fileName title='$row[2]'>";
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
<div class="advice">No existen archivos en '<?echo $materia ?>'.</div>	
<? } ?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>