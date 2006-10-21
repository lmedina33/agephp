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
<link REL="stylesheet" href="estilos/estilos.css" type="text/css" /> 
<script type="text/javascript" src="scripts/funciones.js"></script>
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Apuntes y Pr&aacute;cticas</div><br />
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/normativas.gif" alt="normativas.gif" />&nbsp;Apuntes y Pr&aacute;cticas por año</div><br />
<?
/* *** Modificado debido a que guardaba los archivos en la BD como blob *** */
//$consultaAnio = "SELECT DISTINCT anio.nombre, nivel.nombre, anio.idAnio FROM nivel, ciclo, anio, curso, archivo WHERE nivel.idNivel = ciclo.idNivel AND ciclo.idCiclo = anio.idCiclo AND anio.idAnio = curso.idAnio AND archivo.idCurso = curso.idCurso"; 
$consultaAnio = "SELECT DISTINCT anio.nombre, nivel.nombre, anio.idAnio FROM nivel, ciclo, anio, curso WHERE nivel.idNivel = ciclo.idNivel AND ciclo.idCiclo = anio.idCiclo AND anio.idAnio = curso.idAnio"; 

$result = $conDB->query($consultaAnio);
while($rowAnio = $result->fetchRow())
{
	echo "<span class=\"encabezadosTables\">";
	echo $rowAnio[0]." - ".$rowAnio[1];
	echo "</span>";
	echo "<table border=\"1\" class=\"textotableMaterias\">";
	$consultaMateria = "SELECT materia.nombre, curso.idCurso, anio.nombre, nivel.nombre FROM materia, curso, anio, ciclo, nivel WHERE materia.idMateria = curso.idMateria AND curso.idAnio = anio.idAnio AND ciclo.idCiclo = anio.idCiclo AND nivel.idNivel = ciclo.idNivel AND anio.idAnio ='". $rowAnio[2] ."' ORDER BY materia.nombre";
	$result2 = $conDB->query($consultaMateria);
	while($rowMateria = $result2->fetchRow())
	{
	$rowMateria[0] = ereg_replace( "<br />", " ", $rowMateria[0] );
	echo "<tr><td>";
	echo "<a class=\"linkscentrales\" href=\"archivo.php?idCurso=$rowMateria[1]&amp;nombreMateria=$rowMateria[0]&amp;nombreAnio=$rowMateria[2]&amp;nombreNivel=$rowMateria[3]\" title=\"$rowMateria[0]\">";
	echo $rowMateria[0];
	echo "</a><br />";
	echo "</td></tr>\n";
	}
	echo "</table><br />\n";
}
?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>