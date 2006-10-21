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
<meta name="Generator" content="EditPlus">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<link rel="stylesheet" href="estilos/estilos.css" type="text/css">
<script type="text/javascript" src="scripts/funciones.js"></script>
</head>
<body>
<div class="indice"><a href="configinsti.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif">
<a href="configinsti.php" class="linkscentrales" title="Instituci&oacute;n">Instituci&oacute;n</a>&nbsp;<img src="imagenes/p.gif">&nbsp;Boletines</div>
<div class="textoinfo">
<div class="textotitle">&nbsp;<img src="imagenes/boletines.gif">&nbsp;Boletines</div><br />	
	<?
	$consulta = "select fecha, nombre, nombreArchivo, idBoletin FROM boletin ORDER BY boletin.fecha";
	$result = $conDB->query($consulta);
if(	$result->numrows()!=0)
{
	?>
	<table border="1" class="textotable">
	<tr class="backheadersTable1">
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
		$filename= "boletines/".$row[2];
		$consulta2 = "SELECT archivo FROM boletin WHERE idBoletin LIKE $row[3]";

		echo "<tr>";
		echo "<td>";
		echo $i;
		echo "</td>";
		echo "<td>";
		$elibol=ereg_replace(' ','+',$row[2]);
		echo "<a href=\"javascript:elimboletin('$row[3]','$row[2]','$elibol')\" class=\"linkscentrales\" title=\"Eliminar Bolet&iacute;n: $row[2]\"><img src=\"imagenes/removeuser.gif\" alt='Eliminar Bolet&iacute;n: $row[2]'></a>";
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
		echo "<img src=\"imagenes/down.gif\" align=\"middle\" alt=\"Descargar: $row[2]\">&nbsp;";

		$query=encrypt($consulta2,"notelodire");
		$filename=encrypt($filename,"notelodire");
		
		echo "<a class=\"linkscentrales\" href=\"descarga.php?q=$query&amp;f=$filename\" title=\"Descargar: $row[2]\">";
		echo $row[2];	
		echo "</a><br />";
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";

}
else
{
	echo "<div class=\"advice\">No existen boletines en la base de datos.<br /> Por favor agregue alguno.</div><br />";
}
	?>
	

	<br />
	<div align="right"><input type="button" value="Agregar Bolet&iacute;n (+)" class='inputAdd' onclick="javascript:addboletin()"></div>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>