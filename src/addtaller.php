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
<a href="configtalleres.php" class="linkscentrales" title="Talleres">Talleres</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Agregar Taller</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/talleres.gif">&nbsp;Agregar Taller</div><br />
<?
if(!isset($_POST['addtaller']))
{
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" id="addproyecto" class="editarperfil" onsubmit="return validarCamposGenerico('nombreTaller','resumenTaller','infoTaller')" enctype="multipart/form-data">
		
		<dl>
			<dt>Nombre del Taller:</dt>
			<dd><input type="text" size=60 name="nombreTaller" id="nombreTaller" /></dd>
		<dt>Resumen del taller:</dt>
			<dd>
				<textarea rows="5" cols="40" name="resumenTaller" id="resumenTaller"></textarea>
			</dd>
			<br />
		<dt>Informaci&oacute;n del taller:</dt>
			<dd>
				<textarea rows="20" cols="40" name="infoTaller" id="infoTaller"></textarea>
			</dd>
			<br />
			<dt>Agregar Icono:</dt>
			<dd>
			<input type="file" id="iconotaller" size="50" name="iconotaller" />
			</dd>
			<br />
			<dt>Agregar Imagen:</dt>
			<dd>
			<input type="file" id="imagentaller" size="50" name="imagentaller" />
			</dd>
			<br />
			<dt align=right>
			<input type="submit" value="Aceptar" name="addtaller" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="reset" value="Restaurar Todo" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="button" value="Cancelar" class="inputAdd" onClick="document.location='configtalleres.php'" />
			</dt>
		</dl>
	</form>
<? 
}
else
{
$nombreTaller=ucfirst($_POST['nombreTaller']);
$resumenTaller=ucfirst(eregi_replace("\n","<BR>",$_POST['resumenTaller'])); 
$infoTaller= ucfirst(eregi_replace("\n","<BR>",$_POST['infoTaller'])); 

$uploadDir = 'imagenes/imgTalleres/';
			$fileImagen= $_FILES['imagentaller']['name'];
			$uploadFileImagen = $uploadDir .$fileImagen;
			$fileIcono= $_FILES['iconotaller']['name'];
			$uploadFileIcono = $uploadDir .$fileIcono;

			if(!empty($fileImagen))
			{
				if((file_exists($uploadFileImagen)))
				{
				unlink($uploadFileImagen);
				}
				@move_uploaded_file($_FILES['imagentaller']['tmp_name'], $uploadFileImagen);
			}
			if(!empty($fileIcono))
			{	
				if((file_exists($uploadFileIcono)))
				{
				unlink($uploadFileIcono);
				}
				@move_uploaded_file($_FILES['iconotaller']['tmp_name'], $uploadFileIcono);
			}
			$query="SELECT `idTaller` from `taller` ORDER BY `idTaller` DESC";
			$result=$conDB->query($query);
			$row=$result->fetchRow();
			$prox=$row[0]+1;
			$queryInsertInfoTaller="INSERT INTO `taller` ( `idTaller` , `nombreTaller` , `infoTaller`,`imagenTaller`,`iconoTaller`, `idColegio`,`resumenTaller`) VALUES ('$prox','$nombreTaller','$infoTaller','$fileImagen','$fileIcono','0','$resumenTaller')";
			$result=$conDB->query($queryInsertInfoTaller);

?>
<div class="advice3">&nbsp;&nbsp;Se agreg&oacute; el taller "<? echo $nombreTaller ?>"</div><br />
<br /><a href="configtalleres.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a><br /><br />
<? 
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>