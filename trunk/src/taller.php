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
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<script type="text/javascript" src="scripts/funciones.js"></script>
</head>
<body>
<div class="indice"><a href="talleres.php" class="linkscentrales" title="Talleres">Talleres</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;<? $consulta = "SELECT nombreTaller, infoTaller, imagenTaller FROM taller WHERE idTaller =".$_GET["idTaller"];  
$result = $conDB->query($consulta);
$row= $result->fetchRow();
echo $row[0];?></div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/blueman.gif" alt="blueman.gif" />&nbsp;<?echo $row[0]; ?></div><br />
<? 
if(!empty($row[2]))
		{
		echo "<img src=\"".$GLOBALS["uriImages"].'/imgTalleres/'.$row[2]."\" alt=\"".$row[0]."\" align=\"right\" style='margin-left:20px' />";
		}
echo $row[1];
?>
<br /><br />
</div>
</body>
</html>
<? disConnectDB($conDB); ?>