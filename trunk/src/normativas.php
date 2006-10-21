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
<script type="text/javascript" src="scripts/funciones.js">
</script>
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Normativas</div>
<div class="textoinfo">
<div class="textoTitle"><img src="imagenes/normativas.gif" alt="Normativas Generales" />&nbsp;Normativas Generales</div><br />
<? 
echo getTexts($conDB,'colegio','infoNormativas'); 

$consulta = "select normativa.nombreNormativa,normativa.nombreArchivoNormativa, normativa.idNormativa FROM normativa,colegio,colegio_normativa where colegio.idColegio= '1' and colegio.idColegio=colegio_normativa.idColegio and colegio_normativa.idNormativa=normativa.idNormativa";
$id_resu = $conDB->query($consulta);
if($id_resu->numrows()!=0)
{
echo "<br /><br />";
echo "<div class=\"textoTitle\"><img src=\"imagenes/archivos.gif\" alt=\"archivos.gif\" />&nbsp;";
echo "Archivos";
echo "</div><br />";
	while ($row =& $id_resu->fetchRow())
	{
	$fileName= 'reglamentos/'.$row[1];
	echo "<img src=\"imagenes/down.gif\" alt=\"Descargar Archivo: $row[0]\">&nbsp;&nbsp;";
	$query=encrypt($consulta,"notelodire");
	$fileName=encrypt($fileName,"notelodire");
	echo "<a class=\"linkscentrales\" ";
	echo "href=\"descarga.php?q=$query&amp;f=$fileName\" id=$row[1] title=\"Descargar Reglamento: $row[0]\">";
	echo $row[0];
	echo "</a><br />";
	}
}
?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>