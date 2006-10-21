<? 
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = "5"; 
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
<style type="text/css">@import url(scripts/calendar-blue.css);</style>
<script type="text/javascript" src="scripts/calendar.js"></script>
<script type="text/javascript" src="scripts/lang/calendar-es.js"></script>
<script type="text/javascript" src="scripts/calendar-setup.js"></script>
</head>
<body>
<div class="indice">
<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configbiblioteca.php" class="linkscentrales" title="Biblioteca">Biblioteca</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif"/>
<a href="configbibliotecalibros.php" class="linkscentrales" title="Libros">Libros</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif"/>&nbsp;Editar Libro</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/book.gif" alt="book.gif" />&nbsp;Editar Libro</div><br />
<?
if(!isset($_POST['editbook']))
{
$query="SELECT DISTINCT libro.idLibro, libro.nombre, libro.editorial, libro.anioEdicion, autor.nombre,autor.idAutor,libro.idTema FROM libro INNER JOIN libro_autor ON libro.idLibro = libro_autor.idLibro INNER JOIN autor ON libro_autor.idAutor = autor.idAutor WHERE libro.idLibro='".$_GET['idBook']."'";
$result=$conDB->query($query);
$row=$result->fetchRow();
$anioEdicion=$row[3];
$idTema=$row[6];
$idLibro=$row[0];
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class='editarperfil' onsubmit="return validarCamposGenerico('nombre','editorial','autoresnames','idTema','date1')">
		<dl>
			<dt>Nombre:</dt>
			<dd><input type="text" value="<? echo $row[1]?>" size="40" name="nombre" id="nombre" /></dd>
			<dt>Editorial:</dt>
			<dd>
			<input type="Text" id="editorial" name="editorial" size="40" value="<? echo $row[2]?>" />
			</dd>
			<dt>Autor/es:</dt>
			<dd>
			<textarea id="autoresnames" readonly="readonly" cols="30" rows="5"><?do{echo $row[4]."\r\n";
			$autids.=$row[5].",";
			}while($row=$result->fetchRow());?>
			</textarea>
			<input type="hidden" value="<?echo $autids?>" id="autoresids" name="autoresids" />
			<br>
			<input type="button" value="Agregar autor" onClick="javascript:listAutores(<?echo $idLibro; ?>);" />
			</dd>
			<dt>Tema:</dt>
			<dd>
			<select name="idTema" id="idTema">
			<?
			$i=1;
			$consulta = "SELECT idTema, nombre FROM tema ORDER BY idTema"; 
			$result = $conDB->query($consulta);
			$row = $result->fetchRow();
			do{
				if($idTema==$row[0]){$selected="selected=\"selected\"";}
				else{$selected="";}
				echo "<option value=\"$row[0]\" class=\"opt$i\" id=\"$row[0]\" $selected>$row[1]\n";
				if (++$i > 3){ $i = 1;}
			}while($row = $result->fetchRow());
			?>
			</select>
			</dd>
			<dt>A&ntilde;o de edici&oacute;n:</dt>
			<dd>
			<input type="text"  value="<?echo $anioEdicion; ?>" id="date1" readonly="readonly" name="anio" />&nbsp;
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
			<input type="hidden" name="idLibro" value="<? echo $idLibro; ?>" />
			<br /><br />
			<dt align=right><input type="submit" value="Aceptar" name="editbook" class="inputAdd" />&nbsp;&nbsp;<input type="reset" value="Borrar Todo" class="inputAdd" />&nbsp;&nbsp;<input type="button" value="Cancelar" class="inputAdd" onclick="javascript:document.location='configbibliotecalibros.php'" /></dt>
		</dl>
	</form>
<? 
}
else
{
$autoresids=$_POST['autoresids'];
$autoresids=explode(",",$autoresids);
$limitautorids=count($autoresids);
$anioEdicion=$_POST['anio'];
$idLibro=$_POST['idLibro'];
$idTema=$_POST['idTema'];

$nombreLibro=ucfirst($_POST['nombre']);
$editorial=ucfirst($_POST['editorial']);
$tema=ucfirst($_POST['idTema']);

$updateBook = "UPDATE `libro` SET `nombre` = '$nombreLibro', `anioEdicion` = '$anioEdicion', `editorial` = '$editorial', `idTema` = '$idTema' WHERE `idLibro` = '$idLibro'";
	$conDB->query($updateBook);

	//////////Borro los autores viejos////////////
$queryDeleteAutores="DELETE FROM `libro_autor` WHERE `idLibro` = '$idLibro'";
$result=$conDB->query($queryDeleteAutores);
/////////////////////////////////////////////////

	$updateLibro_Autor="INSERT INTO `libro_autor` ( `idLibro` , `idAutor` ) VALUES ";
	for($i=0;$i<$limitautorids;$i++)
	{
		$values.="('$idLibro', '$autoresids[$i]'), ";
	}
	$values=substr($values,0,strlen($values)-2);
	$result=$conDB->query($updateLibro_Autor.$values);
?>
<div class="advice3">&nbsp;&nbsp;Se actualiz&oacute; el libro <? echo "\"".$nombreLibro."\"" ?></div><br /><br />
<a href="configbibliotecalibros.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a>
<?
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>