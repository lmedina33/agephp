<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include_once("basico.php"); 
$conDB = connectDB();


$consulta = decrypt($_GET['q'],"notelodire");
$fileName = decrypt($_GET['f'],"notelodire"); 

$permisoNecesario = "1"; 
if (canAccess($permisoNecesario))
{ 

// Controla directorio
$partes_ruta = pathinfo($fileName);
$path = $partes_ruta["dirname"].'/';
$id = $partes_ruta["basename"];
if (!file_exists($path))
{ 
	mkdir($path);
}
// Controla archivo
if (!file_exists($fileName))
{ 
	echo "El archivo $fileName no existe!!!";
}
header ("Content-Disposition: attachment; filename=".$id."\n\n");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($fileName));
readfile($fileName);
}
else
{?>
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
<link rel="stylesheet" type="text/css" href="estilos/estilos.css" />
<script type="text/javascript" src="scripts/funciones.js"></script>
</head>
<body>
<div class="indice"><a href="#" onclick="javascript:history.back()" class="linkscentrales" title="Descarga de Archivos">Descarga de Archivos</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;
<div class="textoinfo">
<div class="textoTitle"><img src="imagenes/notice.gif" alt="notice.gif" />&nbsp;Informaci&oacute;n</div><br />
<div class="advice">No tiene asignado los permisos necesarios <br />para bajar archivos!!!</div><br />
<div class="indice"><a href="#" onclick="javascript:history.back()" class="linkscentrales" id="volver" title="Volver">Volver</a>
</div>
</body>
</html>
<?}
disConnectDB($conDB); 
?>