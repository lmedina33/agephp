<? 
include_once("basico.php"); 
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
</head>
<body>
<div class="indice">
<a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Instituci&oacute;n
</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/institucion.gif" alt="institucion.gif" />&nbsp;Instituci&oacute;n</div>
<div class="configcontainer">
				<div class="celda">
						<a href="configinstidatosbasicos.php" title="Datos Basicos">
							<h4 class="titleconf">&nbsp;<img src="imagenes/datosbasicos.gif" alt="datosbasicos.gif" />&nbsp;&nbsp;Datos Basicos</h4>
							<p class="comment">
							Comentario explicando algo
							</p>
						</a>	
				</div>
				<div class="celda">			
						<a href="configinstihistoria.php" title="Historia del Colegio">
							<h4 class="titleconf">&nbsp;<img src="imagenes/historia.gif" alt="historia.gif" />&nbsp;&nbsp;Historia del Colegio</h4>
							<p class="comment">
							Comentario explicando algo
							</p>
						</a>
				</div>
				<div class="celda">
						<a href="configinstiinstitucional.php" title="Institucional">
							<h4 class="titleconf">&nbsp;<img src="imagenes/institucion.gif">&nbsp;&nbsp;Institucional</h4>
							<p class="comment">
							Comentario explicando algo
							</p>
						</a>
				</div>
				<div class="celda">
						<a href="configinstiinfoacademica.php" title="Informaci&oacute;n Acad&eacute;mica">
							<h4 class="titleconf">&nbsp;<img src="imagenes/notice.gif" alt="notice.gif" />&nbsp;&nbsp;Informaci&oacute;n Acad&eacute;mica</h4>
							<p class="comment">
							Comentario explicando algo
							</p>
						</a>
				</div>
				<div class="celda">
						<a href="configinstiboletin.php" title="Bolet&iacute;n Informativo">
							<h4 class="titleconf">&nbsp;<img src="imagenes/boletines.gif" alt="boletines.gif" />&nbsp;&nbsp;Bolet&iacute;n Informativo</h4>
							<p class="comment">
							Comentario explicando algo
							</p>
						</a>
				</div>
				<div class="celda">
							<a href="configinstinormativas.php" title="Normativas">
							<h4 class="titleconf">&nbsp;<img src="imagenes/normativas.gif" alt="normativas.gif" />&nbsp;&nbsp;Normativas
							</h4>
							<p class="comment">
							Comentario explicando algo
							</p>
						</a>
				</div>
		</div>
</div>
</body>
</html>
