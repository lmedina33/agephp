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
<link REL="stylesheet" href="estilos/estilos.css" TYPE="text/css" />
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Niveles Educativos</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/niveles.gif" alt="niveles">&nbsp;Niveles Educativos</div><br />

A continuación se detalla el número de divisiones por año y el número de alumnos inscriptos por ciclo:<br /><br />
<?
$consultaNivel = "SELECT nivel.nombre, nivel.idNivel FROM nivel";
$result = $conDB->query($consultaNivel);
while($rowNivel = $result->fetchRow())
{
	echo "<div class='titlesImportant'>";
	echo "Nivel ".$rowNivel[0];
	echo "</div>";
	echo "<ul>";
	$consultaCiclo = "SELECT ciclo.nombre, ciclo.idCiclo, sum(division.cantidadAlumnos) FROM ciclo, anio, division WHERE ciclo.idCiclo = anio.idCiclo AND division.idAnio = anio.idAnio AND ciclo.idNivel = '".$rowNivel[1]."' GROUP BY ciclo.nombre, ciclo.idCiclo";
	$result2 = $conDB->query($consultaCiclo);
	while($rowCiclo = $result2->fetchRow())
	{
		echo "<li>";
		echo $rowCiclo[0];
		echo " (".$rowCiclo[2]." alumnos)";
		echo "<ul>";
		$consultaAnio = "SELECT anio.nombre, count(division.idDivision) FROM anio, division WHERE anio.idAnio = division.idAnio AND anio.idCiclo = '".$rowCiclo[1]."' GROUP BY anio.idAnio";
		$result3 = $conDB->query($consultaAnio);
		while($rowAnio = $result3->fetchRow())
		{
			echo "<li>";
			echo$rowAnio[0].": ";
			echo$rowAnio[1]." divisiones.";
			echo"</li>";
		}
		echo "</ul>";
		echo"</li><li>&nbsp;</li>";
	}
	echo "</ul>";
}
?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>