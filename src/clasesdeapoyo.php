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
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Clases de apoyo</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/normativas.gif" alt="normativas.gif" />&nbsp;Clases de apoyo</div><br />
<? echo getTexts($conDB, 'colegio', 'infoClaseApoyo'); 
echo "<br /><br />";
$i = 1; //Para backHeadersTable
$consultaAnio = "SELECT DISTINCT anio.nombre, nivel.nombre, anio.idAnio FROM nivel, ciclo, anio, curso, claseapoyo WHERE nivel.idNivel = ciclo.idNivel AND ciclo.idCiclo = anio.idCiclo AND anio.idAnio = curso.idAnio AND claseapoyo.idCurso = curso.idCurso ORDER BY nivel.idNivel, anio.idAnio"; 
$result = $conDB->query($consultaAnio);
while($rowAnio = $result->fetchRow())
{	
	echo "<span class=\"encabezadosTables\">";
	echo $rowAnio[0]." - ".$rowAnio[1];
	echo "</span>";
	echo "<table border=\"1\" width=\"100%\" class=\"textotable\">";
	echo "<tr class=\"backHeadersTable$i\">";
    echo "<td><p>Materia</td><td><p>D&iacute;as y Horarios</td><td><p>Profesor a Cargo</td></tr>";
	$consultaCurso = "SELECT DISTINCT materia.Nombre, curso.idCurso FROM materia, curso, claseapoyo WHERE materia.idMateria = curso.idMateria AND claseapoyo.idCurso = curso.idCurso AND curso.idAnio = $rowAnio[2] ORDER BY materia.Nombre"; 
	$result2 = $conDB->query($consultaCurso);
	while($rowCurso = $result2->fetchRow())
	{
		echo "<tr><td>$rowCurso[0]</td>";
		$dias = "";
		$profesores = "";
		$consultaClaseAp = "SELECT claseapoyo.dia, claseapoyo.horarioInicio, claseapoyo.horarioFin, persona.nombres, persona.apellidos FROM claseapoyo, persona WHERE claseapoyo.idProfesor = persona.idPersona AND claseapoyo.idCurso = $rowCurso[1] ORDER BY claseapoyo.dia"; 
		$result3 = $conDB->query($consultaClaseAp);
		while($rowClaseAp = $result3->fetchRow())
		{
			if($horaInicio = strtotime($rowClaseAp[1]))
			{
				$horaInicio = gmstrftime("%H:%M" ,$horaInicio);
			}
			if($horaFin = strtotime($rowClaseAp[2]))
			{
				$horaFin = gmstrftime("%H:%M" ,$horaFin);
			}
			$dias .= dia($rowClaseAp[0])." de $horaInicio a $horaFin<br />";
			$profesores .=$rowClaseAp[4].", ".$rowClaseAp[3]."<br />";
		}
		echo "<td>$dias</td>";
		echo "<td>$profesores</td>";
		echo "</tr>";
	}
	if (++$i > 6) $i = 1;
	echo "</table><br /><br />";
}
?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>