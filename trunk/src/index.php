<? 

/*
================================================================================================================
SAE Admin V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include_once("basico.php"); 
$conDB = connectDB();
$colegio=getTexts($conDB, 'colegio', 'nombre');
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title><? echo getTexts($conDB, 'colegio', 'nombre'); ?></title>
<meta name="Generator" content="EditPlus" />
<meta name="Author" content="" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="content-Type" content="text/html; charset=windows-1252" />
<link rel="icon" href="imagenes/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
</head>
<body class="principal">
<div class="logo">
<a href="index2.php" id="colegio" title="Entrar">		
<?
echo getImage($conDB, 'colegio','logoPresentacion','','Joaquin V. Gonzalez','');
?>
<br />
<? echo $colegio; ?>
</a>
</div>
<p class="footer">
Webmasters: Barisich / Carri / Naso 
</p>
</body>
</html>
<? disConnectDB($conDB); ?>