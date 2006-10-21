<?

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include ("basico.php");
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Frame Izquierdo</title>
<meta name="Generator" content="EditPlus" />
<meta name="Author" content="" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<script type="text/javascript">
var majors = new Array('insti','ingreso', 'ensenianza','material');
function toggle(a, b) {
	if (!document.getElementById) return true;
	if (b==1)
	{
		for (var i=majors.length-1; i>=0; i--)
	
			if (majors[i] != a)
				document.getElementById(majors[i]).style.display='none';
				a=document.getElementById(a);
				a.style.display=(a.style.display=='block')?'none':'block';
	}
	return false;
}
</script>
<script type="text/javascript" src="scripts/funciones.js"></script>
</head>
<body onload="arreglarMenuExplorer();" class="bodymenu">
<div id="fecha">
<?
$fecha = getDate();
$anio = $fecha[year];
$diasDeLaSemana = array ('Dom','Lun','Mar','Mie','Jue','Vie','Sab');
$mesesDelAño = array ('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
$mes = $mesesDelAño[$fecha[mon]];
$dia = $diasDeLaSemana [$fecha[wday]];
$numDia = $fecha[mday];
echo $dia.' '.$numDia.' / '.$mes.' / '.$anio;?>
</div>
<div id="nav">
	<!--Institucion-->
	<p><a href="javascript://" onclick="return toggle('insti', 1);" title="Instituci&oacute;n">Instituci&oacute;n</a></p>
	<ul id="insti">
		<li><a href="javascript://" onclick="parent['body'].document.location='institucional.php'" title="Institucional">Institucional</a></li>	
		<li><a href="javascript://" onclick="parent['body'].document.location='historia.php'" title="Historia">Historia</a></li>
		<li><a href="javascript://" onclick="parent['body'].document.location='infoacademica.php'" title="Informaci&oacute;n Acad&eacute;mica">Informaci&oacute;n Acad&eacute;mica</a></li>
		<li><a href="javascript://" onclick="parent['body'].document.location='normativas.php'" title="Normativas">Normativas</a></li>
		<li><a href="javascript://" onclick="parent['body'].document.location='boletin.php'" title="Bolet&iacute;n Informativo">Bolet&iacute;n Informativo</a></li>
		
	</ul>

	<!--Ingreso-->
	<p><a href="javascript://" onclick="return toggle('ingreso', 1);" id="ie1" title="Ingreso">Ingreso</a></p>
	<ul id="ingreso">
	<li><a  href="javascript://" onclick="parent['body'].document.location='ingreso.php'" title="Informaci&oacute;n de Ingreso">Informaci&oacute;n de Ingreso</a></li>
	<li><a href="javascript://" onclick="window.open('fpdf/index.php','','toolbar=no,scrollbars=1,resizable=1,fullscreen=no');return true" title="Formulario de Inscripci&oacute;n">Formulario de Inscripci&oacute;n</a></li>
	</ul>

	<!--Enseñanza-->
	<p><a href="javascript://" onclick="return toggle('ensenianza', 1);" title="Ensenianza">Ense&ntilde;anza</a></p>
	<ul id="ensenianza">
	<li><a href="javascript://" onclick="parent['body'].document.location='talleres.php'" title="Talleres">Talleres</a></li>
	<li><a href="javascript://" onclick="parent['body'].document.location='niveleseducativos.php'" title="Niveles Educativos">Niveles Educativos</a></li>
	<li><a href="javascript://" onclick="parent['body'].document.location='clasesdeapoyo.php'" title="Clases de apoyo">Clases de apoyo</a></li>
	</ul>

	<!--Proyectos-->
	<p><a href="javascript://" onclick="parent['body'].document.location='proyectos.php'" title="Proyectos">Proyectos</a></p>

	<!--Material de Estudio -->
	<p><a href="javascript://" onclick="return toggle('material', 1);" title="Material de Estudio">Material de Estudio</a></p>
	<ul id="material">
	<li><a href="javascript://" onclick="parent['body'].document.location='apuntesypracticas.php'" title="Apuntes y Pr&aacute;cticas">Apuntes y Pr&aacute;cticas</a></li>
	<li><a href="javascript://" onclick="parent['body'].document.location='biblioteca.php'" title="Biblioteca">Biblioteca</a></li>	
	</ul>
	
	<!--Contacto-->
	
</div>
<div id="contacto"><a href="javascript://" onclick="parent['body'].document.location='contacto.php'" title="Contacto">Contacto</a></div>
	
<?


if(canAccessTipoPersona('Administrador')||canAccessTipoPersona('Docente')||canAccessTipoPersona('Bibliotecario'))
	{
?>
<div id="conf"><a href="javascript://" onclick="parent['body'].document.location='configuracion.php'" title="Configuraci&oacute;n">Configuraci&oacute;n</a>
</div>
<?
}
session_start();
if (isset($_SESSION['user']))
{
?>
<div id="perfil"><a href="javascript://" onclick="parent['body'].document.location='perfil.php'" title="Perfil">Perfil</a>
</div>
<?
}
?>
</body>
</html>
