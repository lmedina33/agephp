<? 
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = "0"; 
if (!canAccess($permisoNecesario)){
header("location:noprivileges.html");
}
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
<div class="indice"><a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configinsti.php" class="linkscentrales" title="Instituci&oacute;n">Instituci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;<a href="configinstiboletin.php" title="Boletines" class="linkscentrales">Boletines</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Agregar Bolet&iacute;n</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/boletines.gif" alt="boletines.gif" />&nbsp;Agregar Bolet&iacute;n</div><br />
<? 
	
	if (!isset($_POST['addboletin']))
	{
	?>
	<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class="editarperfil" enctype="multipart/form-data" id="" onsubmit="return validarCamposGenerico('nombre','fechaboletin','sourceFile')">
	<dl>
	<dt>Nombre:</dt>
	<dd><input type="Text" id="nombre" name="nombre" size="35" /></dd>
	<dt>Fecha:</dt>
		<dd>
			<input type="text" id="fechaboletin" readonly="readonly" name="fechaboletin" />&nbsp;
			<button type="reset" id="but1" class="inputAdd">...</button>
			<script type="text/javascript">
				Calendar.setup({
					inputField     :    "fechaboletin",           //*
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    false,
					button         :    "but1",        //*
					step           :    1
				});				
			</script>						
			</dd>
	<dt>Archivo:</dt>
	<dd><input type="file" name="archivo" id="sourceFile" class="inputAdd" size="60" /><input type="Hidden" name="MAX_FILE_SIZE" value="1048576" class="inputAdd" /></dd>
	<br />
	<dd>
		<input type="submit" value="Agregar" class="adddelbuttons" name="addboletin">&nbsp;&nbsp;<input type="Reset" value="Borrar" class="adddelbuttons" />&nbsp;&nbsp;<input type="button" value="Cancelar" class="adddelbuttons" onclick="javascript:document.location='configinstiboletin.php'" /> 	 	
	</dd>
	</form>
<?
		}
		else
		{
			$consulta = "SELECT idBoletin FROM boletin ORDER BY idBoletin DESC LIMIT 1"; 
			$res = $conDB->query($consulta);
			$row = $res->fetchrow();
			$prox=$row[0];
			$prox++;
			$uploadDir = 'boletines/';
			$file= $_FILES['archivo']['name'];
			$uploadFile = $uploadDir .$file;
			if(!file_exists($uploadFile))
			{
				if (@move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadFile))
				{

					$consulta = "INSERT INTO boletin (idBoletin,fecha,nombre,nombreArchivo,idColegio) VALUES('" . $prox . "','" . $_POST['fechaboletin'] . "','" . $_POST['nombre'] . "','" . $file . "', '1')";
					$conDB->query($consulta);
					echo "<div class=\"advice3\">&nbsp;&nbsp;Se agreg&oacute; el archivo '$file' </div><br />";
					
				}
				else
				{
					echo "<div class=\"advice\">No fue posible subir el archivo $file, intentelo mas tarde<br /> o contactese con el administrador</div><br />";

				}
			echo "<a href=\"configinstiboletin.php\" class=\"linkscentrales\">Volver</a>";

			}
			else
			{
			echo "<div class=\"advice\">El archivo '$file' ya se encuentra en el servidor.<br />Por favor renombre el archivo.</div><br />";
			echo "<a href='".$_SERVER['PHP_SELF']."' class=\"linkscentrales\">Volver</a>";
			}
		}
		?>
</body>
</html>
<? disConnectDB($conDB); ?>

