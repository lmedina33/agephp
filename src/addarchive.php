<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include_once("basico.php"); 
$conDB = connectDB();
$idCurso=$_GET["idCurso"];
$permisoNecesario = "3".$idCurso; 
if (!canAccess($permisoNecesario)){
header("location:noprivileges.html");
}
$nombreMateria = eregi_replace("_"," ",$_GET["nombreMateria"]); 
$nombreanio = eregi_replace("_"," ",$_GET["nombreAnio"]); 
$nombreNivel = eregi_replace("_"," ",$_GET["nombreNivel"]); 
$materia=$nombreMateria." - ".$nombreanio." año ".$nombreNivel;
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
<style type="text/css">@import url(scripts/calendar-blue.css);</style>
<script type="text/javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="scripts/lang/calendar-es.js"></script>
<script type="text/javascript" src="scripts/calendar-setup.js"></script>
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;<a href="configuracion.php" class="linkscentrales" id="apuntesypracticas" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configapuntesypracticas.php" class="linkscentrales" title="Apuntes y Pr&aacute;cticas">Apuntes y Pr&aacute;cticas</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;<a href="configarchivo.php?idCurso=<? echo $idCurso;?>&nombreMateria=<?echo $nombreMateria;?>&nombreAnio=<?echo $nombreanio;?>&nombreNivel=<?echo $nombreNivel;?>" title="<?echo $materia ?>" class="linkscentrales"><? echo $materia ?></a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Agregar Apunte y/o Pr&aacute;ctica</div>
<div class="textoinfo">
<div class="textotitle">&nbsp;<img src="imagenes/normativas.gif" alt="normativas.gif" />&nbsp;Agregar Apunte y/o Pr&aacute;ctica de <?echo $materia;?></div><br />
<? 
	
	if (!isset($_POST['addarchive']))
	{
	?>
	<form method="post" action="addarchive.php?idCurso=<? echo $idCurso;?>&nombreMateria=<?echo $nombreMateria;?>&nombreAnio=<?echo $nombreanio;?>&nombreNivel=<?echo $nombreNivel;?>" class='editarperfil' enctype="multipart/form-data" onsubmit="return validarCamposGenerico('nombre','date1','sourceFile')">
	<dl>
	<dt>Nombre:</dt>
	<dd><input type="Text" id="nombre" name="nombrearchivo" size="35" /></dd>
	<dt>Fecha(aaaa-mm-dd):</dt>
		<dd>
			<input type="text" id="date1" readonly="readonly" name="fechaarchivo">&nbsp;
			<button type="reset" id="but1" class="inputAdd">...</button>
			<script type="text/javascript">
				Calendar.setup({
					inputField     :    "date1",           //*
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    false,
					button         :    "but1",        //*
					step           :    1
				});				
			</script>						
			</dd>
	<dt>Archivo:</dt>
	<dd><input type="file" name="archivo" id="sourceFile" class="inputAdd" size="60" /><input type="Hidden" name="MAX_FILE_SIZE" value="1048576" class="inputAdd" /></dd>
	<input type="hidden" value="<?echo $idCurso; ?>" name="idCurso" />
	<br />
	<dd>
		<input type="submit" value="Agregar" class="adddelbuttons" name="addarchive" />&nbsp;&nbsp;<input type="Reset" value="Borrar" class="adddelbuttons" />&nbsp;&nbsp;<input type="button" value="Cancelar" class="adddelbuttons" onclick="javascript:document.location='configarchivo.php?idCurso=<? echo $idCurso;?>&nombreMateria=<?echo $nombreMateria;?>&nombreAnio=<?echo $nombreanio;?>&nombreNivel=<?echo $nombreNivel;?>'" />
	</dd>
	</form>
<?
		}
		else
		{
			$uploadDir = 'archivos/';
			$file= $_FILES['archivo']['name'];
			$uploadFile = $uploadDir.$_POST['idCurso']."/".$file;
		if(!file_exists($uploadFile))
		{
			if (@move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadFile))
			{
			$consulta = "SELECT idArchivo FROM archivo ORDER BY idArchivo DESC LIMIT 1"; 
			$res = $conDB->query($consulta);
			$row = $res->fetchrow();
			$row[0]++;
			$consulta = "INSERT INTO archivo (idArchivo, idCurso, infoArchivo, 	fecha,nombreArchivo) VALUES('" . $row[0] . "','" . $_POST['idCurso'] . "','" . $_POST['nombrearchivo'] ."','" . $_POST['fechaarchivo'] . "','".$file."')";
			$conDB->query($consulta);
			echo "<div class=\"advice3\">&nbsp;&nbsp;Se agreg&oacute; el archivo '$file' </div><br />";
			echo "<a href=\"configarchivo.php?idCurso=".$_GET['idCurso']."&nombreMateria=".$_GET['nombreMateria']."&nombreAnio=".$_GET['nombreAnio']."&nombreNivel=".$_GET['nombreNivel']."\" class=\"linkscentrales\" title=\"Volver Atras\">Volver atras</a>";
			}
			else
			{
				echo "<div class=\"advice\">No fue posible subir el archivo $file, intentelo mas tarde<br /> o contactese con el administrador</div><br />";
			}
		}
		else
		{
		echo "<div class=\"advice\">El archivo '$file' ya se encuentra en el servidor.<br />Por favor renombre el archivo.</div><br />";
		?>
		<a href="addarchive.php?idCurso=<? echo $_GET['idCurso'];?>&nombreMateria=<?echo $_GET['nombreMateria'];?>&nombreAnio=<?echo $_GET['nombreAnio'];?>&nombreNivel=<?echo $_GET['nombreNivel'];?>" title="Volver Atras" class="linkscentrales">Volver atras</a>
		<?
		}

		}
			
?>
</body>
</html>
<? disConnectDB($conDB); ?>

