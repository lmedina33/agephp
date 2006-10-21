
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
<a href="configproyectos.php" class="linkscentrales" title="Proyectos">Proyectos</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Editar Proyecto</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/projects.gif" alt="proyects.gif" />&nbsp;Editar Proyecto</div><br />
<?
if(!isset($_POST['editproyect']))
{
?>
<?
$idProy=$_GET['idProy'];
$query="SELECT `nombreProyecto`,`infoProyecto` FROM `proyecto` WHERE `idProyecto`='$idProy'";
$result=$conDB->query($query);
$row=$result->fetchRow();
$infoProyecto=$string = eregi_replace("<BR>","\n",$row[1]); 

?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" id="editproyecto" class="editarperfil" onsubmit="return validarCamposGenerico('nombreProyecto','infoProyecto')">
		
		<dl>
			<dt>Nombre del Proyecto:</dt>
			<dd><input type="text" value="<? echo $row[0] ?>" size=60 name="nombreProyecto" id="nombreProyecto" /></dd>				
		<dt>Informaci&oacute;n del Proyecto:</dt>
			<dd>
				<textarea rows="20" cols="45" name="infoProyecto" id="infoProyecto"><? echo $infoProyecto ?></textarea>
			</dd>
			<br /><br />
			<dt align=right>
			<input type="submit" value="Aceptar" name="editproyect" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="reset" value="Restaurar Todo" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="button" value="Cancelar" class="inputAdd" onclick="document.location='configproyectos.php'" />
			</dt>
		</dl>
		<input type="hidden" value="<? echo $idProy ?>" name="id" />
	</form>
<? 
}
else
{
$id=$_POST['id'];
$nombreProyecto=ucfirst($_POST['nombreProyecto']);
$infoProyecto= ucfirst(eregi_replace("\n","<BR>",$_POST['infoProyecto'])); 
$queryUpdateInfoProyecto="UPDATE `proyecto` SET `nombreProyecto` = '$nombreProyecto',`infoProyecto` = '$infoProyecto' WHERE `idProyecto` = $id";
$result=$conDB->query($queryUpdateInfoProyecto);

?>
<div class="advice3">&nbsp;&nbsp;Se actualiz&oacute; el proyecto "<? echo $nombreProyecto ?>"</div><br />
<br /><a href="configproyectos.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a><br /><br />
<? 
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>