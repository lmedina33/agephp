<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include_once("basico.php"); 
$permisoNecesario = "5"; 
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
</head>
<body>
<div class="indice">
<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>
&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Biblioteca
</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/book.gif" alt="book.gif" />&nbsp;Biblioteca</div><br />

		<div class="configcontainer">

			<div class="celda">
					<a href="configbibliotecaautores.php" title="Autores">
							<h4 class="titleconf">&nbsp;<img src="imagenes/users.gif" alt="users.gif" />&nbsp;&nbsp;Autores
							</h4>
							<p class="comment">
							Comentario explicando algo
							</p>
						</a>	
			</div>
			<div class="celda">
						<a href="configbibliotecatemas.php" title="Temas">
							<h4 class="titleconf">&nbsp;<img src="imagenes/datosbasicos.gif" alt="datosbasicos.gif" />&nbsp;&nbsp;Temas</h4>
							<p class="comment">
							Comentario explicando algo
							</p>
						</a>
			</div>
			<div class="celda">
						<a href="configbibliotecalibros.php" title="Libros">
							<h4 class="titleconf">&nbsp;<img src="imagenes/book.gif" alt="book.gif" />&nbsp;&nbsp;Libros</h4>
							<p class="comment">
							Comentario explicando algo
							</p>
						</a>
			</div>
			<div class="celda">
						<a href="configbibliotecalinksexternos.php" title="Links Externos">
							<h4 class="titleconf">&nbsp;<img src="imagenes/link.gif" alt="link.gif" />&nbsp;&nbsp;Links Externos</h4>
							<p class="comment">
							Comentario explicando algo
							</p>
						</a>
			</div>
		</div>
</div>
</body>
</html>
