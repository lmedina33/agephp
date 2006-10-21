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
<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>
&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configinsti.php" class="linkscentrales" title="Instituci&oacute;n">Instituci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
Historia del Colegio
</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/historia.gif" alt="historia.gif" />&nbsp;Historia del Colegio</div><br />
<?
if(!isset($_POST['editahisto']))
{
$query="SELECT `idColegio`,`infoHistoria` FROM `colegio`";
$result=$conDB->query($query);
$row=$result->fetchRow();
$historia=$string = ereg_replace("<BR>","\n",$row[1]); 
?>
<form method="post" action="configinstihistoria.php" class="editarperfil" onsubmit="return validarCamposGenerico('historia')" enctype="multipart/form-data">
		
		<dl>
			<dt>Informaci&oacute;n:</dt>
			<dd>
			<textarea rows="20" cols="45" name="historia" id="historia"><? echo $historia ?></textarea>
			</dd>
			<br /><br />
			<dt>Imagen Actual:</dt>
			<dd><? echo getImage($conDB, 'colegio', 'imagenHistoria','marcoImg','Imagen Historia','');?></dd>
			<dt>Reemplazar imagen actual:</dt>
			<dd><input type="file" id="imagenhistoria" size="50" name="archivo" /></dd>
			<br /><br />
			<dt align=right>
			<input type="submit" value="Aceptar" name="editahisto" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="reset" value="Restaurar Todo" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="button" value="Cancelar" class="inputAdd" onclick="document.location='configinsti.php'" />
			</dt>

		</dl>
		<input type="hidden" value="<? echo $row[0]?>" name="id" />
	</form>
<? 
}
else
{
$id=$_POST['id'];
$historia= eregi_replace("\n","<BR>",$_POST['historia']); 

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
						$queryUpdateHistoria="UPDATE `colegio` SET `infoHistoria` = '$historia',`imagenHistoria` = '$file' WHERE `idColegio` = $id";
						$result=$conDB->query($queryUpdateHistoria);
						echo "<div class=\"advice3\">Se actualiz&oacute; la historia del colegio</div><br /><br />";
						
			}
			else
			{
					echo "<div class=\"advice\">No fue posible subir el archivo $file, intentelo mas tarde<br /> o contactese con el administrador</div><br />";
			}
			echo "<a href=\"configinsti.php\" class=\"linkscentrales\">Volver</a>";

	}
	else
	{
			$queryUpdateHistoria="UPDATE `colegio` SET `infoHistoria` = '$historia' WHERE `idColegio` = $id";
			$result=$conDB->query($queryUpdateHistoria);
			echo "<div class=\"advice3\">Se actualiz&oacute; la historia del colegio</div><br /><br />";
	}
}
?> 
</body>
</html>
<? disConnectDB($conDB); ?>