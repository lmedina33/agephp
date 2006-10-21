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
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Informaci&oacute;n Acad&eacute;mica</div>
<div class="textoinfo">
<div class="textoTitle"><img src="imagenes/notice.gif" alt="notice.gif" />&nbsp;Informaci&oacute;n Acad&eacute;mica</div>
<br />Plan de estudios por nivel:<br /><br />
<? echo getTexts($conDB, 'colegio', 'infoAcademica'); ?>
<br /><br />
<?	
	$i = 1; //Para backHeadersTable
	$consultaCiclosEGB = "SELECT DISTINCT ciclo.nombre, ciclo.idCiclo FROM curso, anio, ciclo, nivel WHERE nivel.idNivel = ciclo.idNivel AND anio.idCiclo = ciclo.idCiclo AND curso.idanio = anio.idanio";  
	$result = $conDB->query($consultaCiclosEGB); 
	while($rowCiclo = $result->fetchRow())
	{
		echo "<table border='1' height='48'  class='textotable'>";
		echo "<h4 class='encabezadosTables'>";
		echo $rowCiclo[0];
		echo "</h4>";
		echo "<tr class='backHeadersTable". $i ."'>";	
		echo "<td>Año</td>";
		if (++$i > 6) $i = 1;
		$consultaMaterias = "SELECT DISTINCT materia.nombre, materia.idMateria FROM curso, anio, ciclo, nivel, materia WHERE nivel.nombre =  'E.G.B.' AND nivel.idNivel = ciclo.idNivel AND anio.idCiclo = ciclo.idCiclo AND curso.idanio = anio.idanio AND materia.idMateria = curso.idMateria AND ciclo.idCiclo = $rowCiclo[1] ORDER BY materia.nombre";
		$arrayMateria = array(); //Contiene los id de las Materias del  Ciclo
		$result2 = $conDB->query($consultaMaterias);  
		while ($rowMateria = $result2->fetchRow())
		{
			echo "<td>". $rowMateria[0] ."</td>";
			array_push($arrayMateria, $rowMateria[1]);			
		}
		echo "<td>Total</td>";
		echo "</tr>";
		$consultaAnios = "SELECT DISTINCT anio.nombre, anio.idAnio FROM anio, ciclo WHERE anio.idCiclo = ciclo.idCiclo AND ciclo.idCiclo = $rowCiclo[1] ORDER BY anio.nombre";
		$result3 = $conDB->query($consultaAnios);  
		while ($rowAnios = $result3->fetchRow())
		{
			echo "<tr>";
			echo "<td>".$rowAnios[0]."</td>";
			$consultaHoras = "";
			for ($e = 0; $e < count($arrayMateria); $e++)
			{	
				$consultaHoras = "SELECT sum(curso.cantidadHoras) FROM curso WHERE curso.idAnio = '".$rowAnios[1]."' AND curso.idMateria = '".$arrayMateria[$e]."'";
				$result4 = $conDB->query($consultaHoras); 
				$rowHoras = $result4->fetchRow();
				echo "<td>"; 
				if ($rowHoras[0] == NULL)
					{echo "-";}
				else
					{echo "$rowHoras[0]";}
				echo "</td>";
			}
			$consultaHoras = "SELECT sum(curso.cantidadHoras) FROM curso WHERE curso.idAnio = '".$rowAnios[1]."'";
			$result4 = $conDB->query($consultaHoras);  
			$rowHoras = $result4->fetchRow();
			echo "<td>"; 
			if ($rowHoras[0] == NULL)
				{echo "-";}
			else
				{echo "$rowHoras[0]";}
			echo "</td>";					
			echo "</tr>";
		}
		echo "</table>";
		echo "<br /><br />";
	}
	?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>