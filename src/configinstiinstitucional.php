<? 
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = 0; 
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
<a href="configinsti.php" class="linkscentrales" title="Instituci&oacute;n">Instituci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
Institucional
</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/institucion.gif" alt="institucion.gif" />&nbsp;Institucional</div><br />
<?
if(!isset($_POST['editainsti']))
{
$query="SELECT `idColegio`,`infoInstitucional` FROM `colegio`";
$result=$conDB->query($query);
$row=$result->fetchRow();
$infoInstitucional=$row[1]; 

?>
<form method="post" action="<?echo $_SERVER['PHP_SELF']?>" class="editarperfil" onsubmit="return validarCamposGenerico('infoInstitucional')" enctype="multipart/form-data">
		<dl>
			<dt>Informaci&oacute;n:</dt>
			<dd>
			<textarea rows="20" cols="45" name="infoInstitucional" id="infoInstitucional"><? echo $infoInstitucional ?></textarea>
			</dd>
			<br /><br />
			<dt>Imagen Actual:</dt>
			<dd><? echo getImage($conDB, 'colegio', 'logoInstitucional','','Imagen Institucional','');?></dd>
			<dt>Agregar nueva imagen o reemplazar la existente:</dt>
			<dd><input type="file" id="imagenhistoria" size="50" name="archivo" /></dd>
			<br /><br />
			<dt align=right>
			<input type="submit" value="Aceptar" name="editainsti" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="reset" value="Restaurar Todo" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="button" value="Cancelar" class="inputAdd" onClick="document.location='configinsti.php'" />
			</dt>
		</dl>
		<input type="hidden" value="<? echo $row[0]?>" name="id" />
	</form>
<? 
}
else
{
$id=$_POST['id'];
$infoInstitucional= $_POST['infoInstitucional']; 

$uploadDir = 'imagenes/';
			$file= $_FILES['archivo']['name'];
			$uploadFile = $uploadDir .$file;


	if(!empty($file))
	{
		if((file_exists($uploadFile)))
		{
			unlink($uploadFile);
		}
			if (@move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadFile))
			{

				$queryUpdateInfoInstitucional="UPDATE `colegio` SET `infoInstitucional` = '$infoInstitucional', `logoInstitucional` = '$file' WHERE `idColegio` = $id";
				$result=$conDB->query($queryUpdateInfoInstitucional);
				echo "<div class=\"advice3\">Se actualiz&oacute; la seccion institucional del colegio</div><br /><br />";
			}
			else
			{
					echo "<div class=\"advice\">No fue posible subir el archivo $file, intentelo mas tarde<br /> o contactese con el administrador</div><br />";
			}
			echo "<a href=\"configinsti.php\" class=\"linkscentrales\">Volver</a>";

	}
	else
	{
			$queryUpdateInfoInstitucional="UPDATE `colegio` SET `infoInstitucional` = '$infoInstitucional' WHERE `idColegio` = $id";
			$result=$conDB->query($queryUpdateInfoInstitucional);
			echo "<div class=\"advice3\">Se actualiz&oacute; la seccion institucional del colegio</div><br /><br />";
	}

}
?>
</body>
</html>
<? disConnectDB($conDB); ?>