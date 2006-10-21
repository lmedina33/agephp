<? 
include_once("basico.php"); 
$conDB = connectDB();
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>New Document</title>
<meta name="Generator" content="EditPlus" />
<meta name="Author" content="Nicolas Naso, Juan Ignacio Barisich, Jose Ignacio Carri" />
<meta name="Keywords" content="Colegio Joaquin V. Gonzalez" /> 
<meta name="Description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Institucional</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/institucion.gif" alt="institucion.gif" />&nbsp;Institucional</div><br />
<p>

<? echo getTexts($conDB, 'colegio', 'infoInstitucional'); ?>

</p>
</div>
<div class="imginfo">
<? echo getImage($conDB, 'colegio', 'logoInstitucional','','Imagen Institucional',''); ?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>