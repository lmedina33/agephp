
<? 
include_once("basico.php"); 
$conDB = connectDB();

$permisoNecesario = "0";
if (!canAccess($permisoNecesario))
{
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
<script src="scripts/funciones.js" type="text/Javascript"></script>
<script language="javascript" type="text/javascript" src="scripts/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	language : "es",
	plugins : "preview,searchreplace,print",
	theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright, justifyfull,separator,bullist,numlist,separator,hr,charmap,separator,forecolor,backcolor,",
	theme_advanced_buttons2 : "undo,redo,separator,link,unlink,separator,print,preview",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
});
</script>
</head>
<body>
<div class="indice">
<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configtalleres.php" class="linkscentrales" title="Talleres">Talleres</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Editar Taller</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/talleres.gif" alt="talleres.gif" />&nbsp;Editar Taller</div><br>
<?
if(!isset($_POST['edittaller']))
{
$idTall=$_GET['idTall'];
$query="SELECT `nombreTaller`,`infoTaller`,`resumenTaller`,`imagenTaller`,`iconoTaller` FROM `taller` WHERE `idTaller`='$idTall'";
$result=$conDB->query($query);
$row=$result->fetchRow();
$infoTaller=eregi_replace("<BR>","\n",$row[1]);
$resumenTaller=eregi_replace("<BR>","\n",$row[2]);
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" id="editproyecto" class="editarperfil" onsubmit="return validarCamposGenerico('nombreTaller','resumenTaller','infoTaller')" enctype="multipart/form-data">		
		<dl>
			<dt>Nombre del Proyecto:</dt>
			<dd><input type="text" value="<? echo $row[0] ?>" size=60 name="nombreTaller" id="nombreTaller" /></dd>
		<dt>Resumen del taller:</dt>
			<dd>
				<textarea rows="5" cols="45" name="resumenTaller" id="resumenTaller"><? echo $resumenTaller ?></textarea>
			</dd>
			<br />		
		<dt>Informaci&oacute;n del taller:</dt>
			<dd>
				<textarea rows="20" cols="45" name="infoTaller" id="infoTaller"><? echo $infoTaller ?></textarea>
			</dd>
			<br />
			<? 
			if(!empty($row[4]))
			{
			?>
			<dt>Icono Actual:</dt>
			<dd><img src="imagenes/imgTalleres/<? echo $row[4]; ?>" alt="<? echo $row[4]; ?>" /></dd>
			<?
			$textoIcn="Reemplazar";
			}
			else
			{
			$textoIcn="Agregar";
			}
			?>
			<dt><?echo $textoIcn ?> icono:</dt>
			<dd><input type="file" size="50" name="iconoTaller" /></dd>
			<br />
			<? 
			if(!empty($row[3]))
			{
			?>
			<dt>Imagen Actual:</dt>
			<dd><img src="imagenes/imgTalleres/<?echo $row[3]; ?>" alt="<?echo $row[3]; ?>" /></dd>
			<?
			$textoImg="Reemplazar";
			}
			else
			{
			$textoImg="Agregar";
			}
			?>
			<dt><? echo $textoImg?> imagen:</dt>
			<dd><input type="file" size="50" name="imagenTaller" /></dd>
			<br /><br />
			<dt align=right>
			<input type="submit" value="Aceptar" name="edittaller" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="reset" value="Restaurar Todo" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="button" value="Cancelar" class="inputAdd" onclick="document.location='configtalleres.php'" />
			</dt>
		</dl>
		<input type="hidden" value="<? echo $idTall ?>" name="id" />
	</form>
	

<? 
}
else
{
$id=$_POST['id'];
$nombreTaller=ucfirst($_POST['nombreTaller']);
$resumenTaller=ucfirst(eregi_replace("\n","<BR>",$_POST['resumenTaller'])); 
$infoTaller= ucfirst(eregi_replace("\n","<BR>",$_POST['infoTaller'])); 

$uploadDir = 'imagenes/imgTalleres/';
			$fileImagen= $_FILES['imagenTaller']['name'];
			$uploadFileImagen = $uploadDir .$fileImagen;
			$fileIcono= $_FILES['iconoTaller']['name'];
			$uploadFileIcono = $uploadDir .$fileIcono;

			if(!empty($fileImagen) && !empty($fileIcono))
			{
				if((file_exists($uploadFileImagen)))
				{
				unlink($uploadFileImagen);
				}
				if((file_exists($uploadFileIcono)))
				{
				unlink($uploadFileIcono);
				}
				@move_uploaded_file($_FILES['imagenTaller']['tmp_name'], $uploadFileImagen);
				@move_uploaded_file($_FILES['iconoTaller']['tmp_name'], $uploadFileIcono);
				$queryUpdateInfoTaller="UPDATE `taller` SET `nombreTaller` = '$nombreTaller',`infoTaller` = '$infoTaller', `resumenTaller` = '$resumenTaller',`imagenTaller` = '$fileImagen',`iconoTaller` = '$fileIcono' WHERE `idTaller` = '$id'";
			}
			elseif(!empty($fileIcono))
			{	
				if((file_exists($uploadFileIcono)))
				{
				unlink($uploadFileIcono);
				}
				@move_uploaded_file($_FILES['iconoTaller']['tmp_name'], $uploadFileIcono);
				$queryUpdateInfoTaller="UPDATE `taller` SET `nombreTaller` = '$nombreTaller',`infoTaller` = '$infoTaller', `resumenTaller` = '$resumenTaller',`iconoTaller` = '$fileIcono' WHERE `idTaller` = '$id'";
			}
			else
			{
			$queryUpdateInfoTaller="UPDATE `taller` SET `nombreTaller` = '$nombreTaller',`infoTaller` = '$infoTaller', `resumenTaller` = '$resumenTaller' WHERE `idTaller` = '$id'";
			}
	

$result=$conDB->query($queryUpdateInfoTaller);

?>
<div class="advice3">&nbsp;&nbsp;Se actualiz&oacute; el taller "<? echo $nombreTaller ?>"</div><br />
<br /><a href="configtalleres.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a><br /><br />
<? 
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>