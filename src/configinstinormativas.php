<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

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
<LINK REL="stylesheet" href="estilos/estilos.css" TYPE="text/css" />
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
Normativas
</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/normativas.gif" alt="normativas.gif" />&nbsp;Normativas</div><br />
<?
if(!isset($_POST['editanorma']))
{
$normativas=getTexts($conDB,'colegio','infoNormativas'); 
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class='editarperfil' onsubmit="return validarCamposGenerico('normativas')" enctype="multipart/form-data">
		
		<dl>
			<dt>Informaci&oacute;n:</dt>
			<dd>
			<textarea rows="20" cols="45" name="normativas" id="normativas"><? echo $normativas ?></textarea>
			</dd>
			<?
			$consulta = "select normativa.nombreNormativa,normativa.nombreArchivoNormativa, normativa.idNormativa FROM normativa,colegio,colegio_normativa where colegio.idColegio= '1' and colegio.idColegio=colegio_normativa.idColegio and colegio_normativa.idNormativa=normativa.idNormativa";
			$id_resu = $conDB->query($consulta);
			if($id_resu->numrows()!=0)
			{
			echo "<dt>Archivos:</dt>";
			echo "<dd>";
			while ($row =& $id_resu->fetchRow())
				{
					$fileName= 'reglamentos/'.$row[1];
					$eliNorm= eregi_replace(' ','_',$row[1]);
					echo "<a href=\"javascript:elimnormativa($row[2],'$row[0]','$eliNorm')\" class=\"linkscentrales\" title=\"Eliminar Reglamento: $row[0]\">";
					echo "<img src=\"imagenes/removeuser.gif\" alt=\"Eliminar Reglamento: $row[0]\" />";
					echo "</a>&nbsp;&nbsp;";
					$query=encrypt($consulta,"notelodire");
					$fileName=encrypt($fileName,"notelodire");
					echo "<a class=\"linkscentrales\" ";
					echo "href=\"descarga.php?q=$query&amp;f=$fileName\" id=$row[1] title=\"Descargar Reglamento: $row[0]\">";
					echo $row[0];
					echo "</a><br />";
				}
			
			}
			?>
			</dd>
			<dt>Nombre nuevo archivo:</dt>
			<dd><input type="text" size="50" name="nombreArchivoNormativa" /></dd>
			<dt>Nuevo archivo:</dt>
			<dd><input type="file" size="50" name="archivo" /></dd>
			<br /><br />
			<dt align=right>
			<input type="submit" value="Aceptar" name="editanorma" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="reset" value="Restaurar Todo" class="inputAdd" />
			&nbsp;&nbsp;
			<input type="button" value="Cancelar" class="inputAdd" onclick="document.location='configinsti.php'" />
			</dt>
		</dl>
	</form>
<? 
}
else
{
$id='1';
$normativas= $_POST['normativas']; 

$uploadDir = 'reglamentos/';
			$file= $_FILES['archivo']['name'];
			$uploadFile = $uploadDir .$file;

if(!empty($file))
	{
	$nombreArchivoNormativa=ucfirst($_POST['nombreArchivoNormativa']);
	if(empty($nombreArchivoNormativa)){$nombreArchivoNormativa="Archivo sin nombre";}
		if((file_exists($uploadFile)))
		{
			unlink($uploadFile);
		}
		if (@move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadFile))
			{

			$queryNextNormativa="SELECT `idNormativa` FROM `normativa` ORDER BY `idNormativa` DESC";
			$result=$conDB->query($queryNextNormativa);
			$row=$result->fetchRow();
			$prox=$row[0]+1;
			$queryUpdateNormativas="UPDATE `colegio` SET `infoNormativas` = '$normativas' WHERE `idColegio` = $id";
			$result=$conDB->query($queryUpdateNormativas);
			$queryInsertNormativa="INSERT INTO `normativa` (idNormativa, nombreNormativa,nombreArchivoNormativa) VALUES ('$prox','$nombreArchivoNormativa','$file')";
			$result=$conDB->query($queryInsertNormativa);
			$queryInsertColegioNormtavia="INSERT INTO `colegio_normativa` ( `idColegio` , `IdNormativa` ) VALUES ('$id', '$prox')";
			$result=$conDB->query($queryInsertColegioNormtavia);
			?>
			<div class="advice3">Se actualiz&oacute; la informaci&oacute;n acad&eacute;mica del colegio</div><br />
			<br />
			<?
			}
			else
			{
			echo "<div class=\"advice\">No fue posible subir el archivo $file, intentelo mas tarde<br /> o contactese con el administrador</div><br />";
			}
			echo "<a href=\"configinsti.php\" class=\"linkscentrales\">Volver</a>";

	}
	else
	{
		$queryUpdateNormativas="UPDATE `colegio` SET `infoNormativas` = '$normativas' WHERE `idColegio` = $id";
		$result=$conDB->query($queryUpdateNormativas);
		?>
		<div class="advice3">Se actualiz&oacute; la informaci&oacute;n acad&eacute;mica del colegio</div><br />
		<br /><a href="configinsti.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a><br /><br />
		<?
	}
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>