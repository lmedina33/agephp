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
<link REL="stylesheet" href="estilos/estilos.css" TYPE="text/css" />
<script type="text/javascript" src="scripts/funciones.js"></script>
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Talleres</div><br />
<div class="textoinfo">
	<? 
	$consulta = "select nombreTaller,iconoTaller,resumenTaller,idTaller,iconoTaller From taller";
	$result = $conDB->query($consulta);
	while ($row = $result->fetchRow())
	{
		echo "<span class='textoTitle'>";
		echo "<a href='taller.php?idTaller=$row[3]'\" id=$row[0]' class='linkscentrales' title='$row[0]'>";
		echo $row[0];
		echo "</a>";
		echo "</span><br />\n";
		echo "<p>";
		if(!empty($row[4]))
		{
		echo "<img src=\"".$GLOBALS["uriImages"].'/imgTalleres/'.$row[4]."\" alt=\"".$row[0]."\" align=\"left\" style='margin-right:10px' />";
		}
		echo $row[2];
		echo "<br style='clear:left' />";
		echo "</p><br />";		
	} 
?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>