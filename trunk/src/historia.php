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
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Historia</div>
<div class="textoinfo">
<div class="textoTitle"><img src="imagenes/historia.gif" alt="historia" />&nbsp;Un poco de historia...</div><br />
<p>
<? echo getTexts($conDB, 'colegio', 'infoHistoria'); ?>

</p>
<p align=center>

<? 
echo getImage($conDB, 'colegio', 'imagenHistoria','marcoImg','Imagen Historia','');
?>

</p>
<br />
<br />
</div>
</body>
</html>
<? disConnectDB($conDB); ?>