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
Informaci&oacute;n Acad&eacute;mica
</div>
<div class="textoinfo">
<div class="textotitle">&nbsp;<img src="imagenes/notice.gif" alt="notice.gif" />&nbsp;Informaci&oacute;n Acad&eacute;mica</div><br>
<?
if(!isset($_POST['editahisto']))
{
$query="SELECT `idColegio`,`infoAcademica` FROM `colegio`";
$result=$conDB->query($query);
$row=$result->fetchRow();
$infoacademica=$string = ereg_replace("<BR>","\n",$row[1]); 
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class="editarperfil" onsubmit="return validarCamposGenerico('infoacademica')">
		
		<dl>
			<dt>Informaci&oacute;n:</dt>
			<dd>
			<textarea rows="20" cols="45" name="infoacademica" id="infoacademica"><? echo $infoacademica ?></textarea>
			</dd>
			<br><br>
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
$infoacademica= eregi_replace("\n","<BR>",$_POST['infoacademica']); 


$queryUpdateInfoAcademica="UPDATE `colegio` SET `infoAcademica` = '$infoacademica' WHERE `idColegio` = $id";

$result=$conDB->query($queryUpdateInfoAcademica);
?>
<div class="advice3">Se actualiz&oacute; la informaci&oacute;n acad&eacute;mica del colegio</div><br>
<br><a href="configinsti.php" class="linkscentrales" id="volveratras" title='Volver'>Volver atras</a><br><br>
<? 
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>