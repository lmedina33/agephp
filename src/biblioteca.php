<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

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
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="estilos/estilos.css" />
<script type="text/javascript" src="scripts/funciones.js"></script>
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Biblioteca</div>
<div class="textoinfo">
<div class="textoTitle"><img src="imagenes/book.gif" alt="book.gif" />&nbsp;Biblioteca</div><br />
<div class="bibliocontainer">
<form action="busqueda.php" method="get" class="formularioBusqueda"> 
	<span class="busqueda">Ingrese los criterios de b&uacute;squeda:</span><br /><br />
	<span class="busqueda">Autor:</span>
	<select name="idAutor">
			<option value="todos" class="opt1">(Todos)
			<?
			$i=1;
			$consulta = "SELECT idAutor, nombre FROM autor order by nombre"; 
			$result = $conDB->query($consulta);
			while($row = $result->fetchRow())
			{
				echo "<option value='$row[0]' class='opt$i'>$row[1]";
				if (++$i > 3) $i = 1;
			}
			?>
	</select><br /><br />
	<span class="busqueda">Tema:</span>
	<select name="idTema">
			<option value="todos" class="opt1">(Todos)
			<?
			$i=1;
			$consulta = "SELECT idTema, nombre FROM tema order by nombre"; 
			$result = $conDB->query($consulta);
			while($row = $result->fetchRow())
			{
				echo "<option value='$row[0]' class='opt$i'>$row[1]";
				if (++$i > 3) $i = 1;
			}
			?>
	</select><br /><br />
	<span class="busqueda">T&iacute;tulo:</span>
	<input type="text" name="titulo" class="inputSearch" />			
	<input type="submit" value="Buscar" class="buttonSearch" id="buscar" />
</form>
<?
echo "<h5 class=\"linksbiblioteca\">";
$consulta="SELECT `nombreLink`,`urlLink` FROM `linksexternos`";
$result = $conDB->query($consulta);
while($row=$result->fetchRow())
{
echo "<a href=\"$row[1]\" target=\"_new\" title='$row[0]'>$row[0]</a>";
echo "<br />";
}
echo "</h5>";
?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>