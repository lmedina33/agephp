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
<a href="configuracion.php" class="linkscentrales">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configbiblioteca.php" class="linkscentrales" title="Biblioteca">Biblioteca</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />
<a href="configbibliotecalibros.php" class="linkscentrales" title="Libros">Libros</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Agregar Libro</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/book.gif">&nbsp;Agregar Libro</div><br />
<?
if(!isset($_POST['addbook']))
{
?>
<form method="post" action="<?echo $_SERVER['PHP_SELF'];?>" class='editarperfil' onsubmit="return validarCamposGenerico('nombre','editorial','autoresnames','idTema','date1')">
		<dl>
			<dt>Nombre:</dt>
			<dd><input type="text" size="40" name="nombre" id="nombre" /></dd>
			
			<dt>Editorial:</dt>
			<dd>
			<input type="Text" id="editorial" name="editorial" size="40" />
			</dd>
			
			<dt>Autor/es:</dt>
			<dd>
			<textarea id="autoresnames" readonly="readonly" value="" cols="30" rows="5"></textarea>
			<input type="hidden" id="autoresids" name="autoresids">
			<br />
			<input type="button" value="Agregar autor" onclick="javascript:listAutores();">
			</dd>
			<dt>Tema:</dt>
			<dd>
			<select name="idTema" id="idTema">
			<option class="opt1">(Seleccionar)
			<?
			$i=1;
			$consulta = "SELECT idTema, nombre FROM tema ORDER BY nombre"; 
			$result = $conDB->query($consulta);
			while($row = $result->fetchRow())
			{
				echo "<option value='$row[0]' class='opt$i' id='$row[0]'>$row[1]";
				if (++$i > 3) $i = 1;
			}
			?>
			</select>
			</dd>
			<dt>A&ntilde;o de edici&oacute;n:</dt>
			<dd>
			<input type="text" id="date1" readonly="readonly" name="anio" />&nbsp;
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
			<br /><br />
			<dt align=right><input type="submit" value="Aceptar" name="addbook" class="inputAdd" />&nbsp;&nbsp;<input type="reset" value="Borrar Todo" class="inputAdd" />&nbsp;&nbsp;<input type="button" value="Cancelar" class="inputAdd" onclick="javascript:document.location='configbibliotecalibros.php'" /></dt>
		</dl>
	</form>
	

<? 
}
else
{
$autoresids=$_POST['autoresids'];
$autoresids=explode(",",$autoresids);
$limitpermids=count($autoresids);
$lastAutorId="SELECT `idLibro` from `libro_autor` ORDER BY `idLibro` DESC";
$result=$conDB->query($lastAutorId);
$last=$result->fetchRow();
$prox=$last[0]+1;
$nombreLibro=ucfirst($_POST['nombre']);
$editorial=ucfirst($_POST['editorial']);
$tema=ucfirst($_POST['idTema']);

$consulta = "SELECT idLibro FROM libro ORDER BY idLibro DESC"; 
	$res = $conDB->query($consulta);
	$row = $res->fetchrow();
	$row[0]++;
	$consulta = "INSERT INTO libro (idLibro, nombre, anioEdicion, editorial, idTema, idBiblioteca) VALUES('".$row[0]."','".$nombreLibro."','".$_POST['anio']. "','" .$editorial. "','" . $tema. "','1')";
	$conDB->query($consulta);

	$insert="INSERT INTO `libro_autor` ( `idLibro` , `idAutor` ) VALUES ";
	for($i=0;$i<$limitpermids;$i++)
	{
		$values.="('$prox', '$autoresids[$i]'), ";
	}
	$values=substr($values,0,strlen($values)-2);

	$result=$conDB->query($insert.$values);
	

?>
<div class="advice3">&nbsp;&nbsp;Se agreg&oacute; el libro <? echo "\"".$nombreLibro."\"" ?></div><br /><br />
<a href="configbibliotecalibros.php" class="linkscentrales" id="volveratras" title="Volver">Volver atras</a>
<?
}
?>
</body>
</html>
<? disConnectDB($conDB); ?>