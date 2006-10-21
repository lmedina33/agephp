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
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Ingreso</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/ingreso.gif" alt="ingreso.gif" />&nbsp;Ingreso</div><br />
<? echo getTexts($conDB,'colegio','infoIngreso')?>
<div class="textoTitle"><img src="imagenes/plazos.gif" alt="plazos.gif" />
Plazos para Inscripci&oacute;n
</div><br />
<?
$consultaNivel = "SELECT nivel.nombre, nivel.idNivel FROM nivel";
$result = $conDB->query($consultaNivel);
while($rowNivel = $result->fetchRow())
{
	echo "<div class=\"titlesImportant\">";
	echo "Nivel ".$rowNivel[0];
	echo "</div>";
	echo "<ul>";
	$consultaCiclo = "SELECT ciclo.nombre, ciclo.idCiclo FROM ciclo, anio, division WHERE ciclo.idCiclo = anio.idCiclo AND division.idAnio = anio.idAnio AND ciclo.idNivel = '".$rowNivel[1]."' GROUP BY ciclo.nombre, ciclo.idCiclo";
	$result2 = $conDB->query($consultaCiclo);
	while($rowCiclo = $result2->fetchRow())
	{
		echo "<li>";
		echo $rowCiclo[0];
		echo "<ul>";
		$consultaAnio = "SELECT anio.nombre, anio.fechaInicioInscripcion, anio.fechaFinInscripcion, anio.horarioInicioInscripcion, anio.horarioFinInscripcion FROM anio WHERE anio.idCiclo = '".$rowCiclo[1]."'";
		$result3 = $conDB->query($consultaAnio);
		while($rowAnio = $result3->fetchRow())
		{
			if($fechaInicio = strtotime($rowAnio[1]))
			{
				$fechaInicio =gmstrftime("%d/%m" ,$fechaInicio);
			}
			if($fechaFin = strtotime($rowAnio[2]))
			{
				$fechaFin =gmstrftime("%d/%m" ,$fechaFin);
			}
			if($horaInicio = strtotime($rowAnio[3]))
			{
				$horaInicio = gmstrftime("%H:%M" ,$horaInicio);
			}
			if($horaFin = strtotime($rowAnio[4]))
			{
				$horaFin = gmstrftime("%H:%M" ,$horaFin);
			}
			echo "<li>";
			echo$rowAnio[0].": del ";
			echo$fechaInicio." al ".$fechaFin;
			echo ", de ".$horaInicio." a ".$horaFin." hs.";
			echo"</li><br />";
		}
		echo "</ul>";
		echo"</li><br />";
	}
	echo "</ul>";
}
?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>