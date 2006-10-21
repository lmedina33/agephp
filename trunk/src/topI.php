<? 
include_once("basico.php"); 
$conDB = connectDB();
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
<script src="scripts/funciones.js" type="text/Javascript"></script>
</head>

<body class="bodytop">
<span class="contentTitle">
	<? echo getImage($conDB,'colegio','logoEncabezado','','Logo del Colegio','middle');?>
	<span id="title"><? echo getTexts($conDB,'colegio','nombre') ?></span>
	
</span>

</body>
</html>
<? disConnectDB($conDB); ?>


