<? 
include_once("basico.php"); 
$conDB = connectDB();
$nombreMateria=$_GET['nombreMateria'];
$nombreanio=$_GET['nombreAnio'];
$nombreNivel=$_GET['nombreNivel'];
$materia=$nombreMateria." - ".$nombreanio." año ".$nombreNivel;
$idCurso=$_GET['idCurso'];


$permisoNecesario = "3".$idCurso; 
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
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;<a href="configapuntesypracticas.php" class="linkscentrales" title="Apuntes y Pr&aacute;cticas">Apuntes y Pr&aacute;cticas</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;<? echo $materia;?>
</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/normativas.gif" alt="normativas.gif" />&nbsp;Apuntes y Pr&aacute;cticas de <? echo $materia;?>
</div>
<br />
<?
$nombreMateria = eregi_replace(" ","_",$nombreMateria);
$nombreanio = eregi_replace(" ","_",$nombreanio);
$nombreNivel = eregi_replace(" ","_",$nombreNivel);
$consulta = "select fecha, infoArchivo, nombreArchivo, idArchivo FROM archivo WHERE archivo.idCurso = '".$_GET['idCurso']."' ORDER BY archivo.fecha";
$result = $conDB->query($consulta);
if ($result->numrows()!=0)
{
?>
<table border="1" class="textotable">
	<tr class="backHeadersTable1">
	<td>Nro</td>
	<td>Acci&oacute;n</td>
	<td>Fecha</td>
	<td>Nombre</td>
	<td>Archivo</td>
	</tr>	
<?
while ($row =& $result->fetchRow())
{	
	$i++;
	$path= "archivos/".$_GET['idCurso']."/";
	$fileName= $path.$row[2];
	$consulta2 = "SELECT archivo FROM archivo WHERE idArchivo LIKE $row[3]";	
	echo "<tr>";
	echo "<td>";
	echo $i;
	echo "</td>";
	echo "<td>";
		$elibol=ereg_replace(' ','+',$row[2]);
		echo "<a href=\"javascript:elimarchivo('$row[3]','$row[2]','$elibol','$idCurso','$nombreMateria','$nombreanio','$nombreNivel')\" class=\"linkscentrales\" title=\"Eliminar Bolet&iacute;n: $row[2]\"><img src=\"imagenes/removeuser.gif\" alt=\"Eliminar Bolet&iacute;n: $row[2]\"></a>";
		echo "</td>";
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
	echo "<img src=\"imagenes/down.gif\" align=\"center\" alt=\"Descargar: $row[2]\">&nbsp;";
	$query=encrypt($consulta2,"notelodire");
	$fileName=encrypt($fileName,"notelodire");
	echo "<a class=\"linkscentrales\" ";
	echo "href=\"descarga.php?consulta=q=$query&amp;f=$fileName\" id=$fileName title=\"Descargar: $row[2]\">";
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
<div class="advice">No existen archivos en '<?echo $materia ?>'.<br /> Por favor ingreso alguno.</div>	
<?
}
?>
<br />
	<div align="right">
	<form method="get" action="addarchive.php">
	<input type="hidden" value="<? echo $nombreMateria?>" name="nombreMateria" />
	<input type="hidden" value="<? echo $nombreanio;?>" name="nombreAnio" />
	<input type="hidden" value="<? echo $nombreNivel?>" name="nombreNivel" />
	<input type="hidden" value="<?echo $_GET['idCurso']?>" name="idCurso" />
	<input type="submit" value="Agregar Archivo (+)" class="inputAdd" />
	</form>
	</div>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>