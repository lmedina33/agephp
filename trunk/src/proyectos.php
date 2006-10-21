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
<LINK rel="stylesheet" href="estilos/estilos.css" TYPE="text/css">
<script src="scripts/funciones.js" type="text/Javascript"></script>
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Proyectos</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/projects.gif" alt="proyectos.gif" />&nbsp;Proyectos</div><br />
<? 
	$consulta = 'select nombreProyecto,infoProyecto from proyecto';
	echo getTableTexts($conDB,$consulta,'div','titlesImportant');

?>
<br /><br />
</div>
</body>
</HTML>
<? disConnectDB($conDB); ?>