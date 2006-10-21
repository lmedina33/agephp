<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include_once("basico.php");
if(!canAccessTipoPersona('Administrador')&&!canAccessTipoPersona('Docente')&&!canAccessTipoPersona('Bibliotecario'))
	{header("location:noprivileges.html");}

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
</head>
<body>
<div class="indice">&nbsp;<img src="imagenes/p.gif">&nbsp;Configuraci&oacute;n</div>
<div class="textoinfo">
<div class="textoTitle">&nbsp;<img src="imagenes/configuracion.gif" alt="configuracion.gif" />&nbsp;Configuraci&oacute;n</div>
<div class="configcontainer">
			<?
					$permisoNecesario = 0; 
			if (canAccess($permisoNecesario))
			{?>
			<div class="celda">
			<a href="configinsti.php" title="Instituci&oacute;n">
					<h4 class='titleconf'>&nbsp;<img src="imagenes/institucion.gif" alt="institucion.gif" />&nbsp;Instituci&oacute;n</h4>
					<p class="comment">
					Comentario explicando algo
					</p>
			</a>	
			</div>
			<div class="celda">
			<a href="configusuarios.php" title="Usuarios">
					<h4 class='titleconf'>&nbsp;<img src="imagenes/users.gif" alt="users.gif" />&nbsp;Usuarios</h4>
					<p class="comment">
					Comentario explicando algo
					</p>
				</a>	
			</div>
			<div class="celda">
			<a href="configproyectos.php" title="Proyectos">
				<h4 class='titleconf'>&nbsp;<img src="imagenes/projects.gif" alt="projects.gif" />&nbsp;Proyectos</h4>
				<p class="comment">
						Comentario explicando algo
				</p>
			</a>
			</div>
			<div class="celda">
			<a href="configtalleres.php" title="Talleres">
					<h4 class='titleconf'>&nbsp;<img src="imagenes/talleres.gif" alt="talleres.gif" />&nbsp;Talleres</h4>
					<p class="comment">
								Comentario explicando algo
					</p>
				</a>
			</div>
			<?
			}
			$permisoNecesario = "5"; 
			if (canAccess($permisoNecesario))
			{?>
			<div class="celda">
			<a href="configbiblioteca.php" title="Biblioteca">
				<h4 class='titleconf'>&nbsp;<img src="imagenes/book.gif" alt="book.gif" />&nbsp;Biblioteca</h4>
				<p class="comment">
						Comentario explicando algo
				</p>
			</a>
			</div>
			<?}				
			$permisoNecesario=0;
			if (canAccessTipoPersona('Docente') || canAccess($permisoNecesario))
			{?>
			<div class="celda">
			<a href="configapuntesypracticas.php" title="Apuntes y Practicas">
				<h4 class='titleconf'>&nbsp;<img src="imagenes/normativas.gif" alt="normativas.gif" />&nbsp;Apuntes y Practicas</h4>
				<p class="comment">
						Comentario explicando algo
				</p>
			</a>
			</div>
			<? 
			}
			$permisoNecesario = 0; 
			if (canAccess($permisoNecesario))
			{
			?>
			<div class="celda">
			<a href="configclasesdeapoyo.php" title="Clases de apoyo">
					<h4 class='titleconf'>&nbsp;<img src="imagenes/normativas.gif" alt="normativas.gif" />&nbsp;Clases de apoyo</h4>
					<p class="comment">
								Comentario explicando algo
					</p>
				</a>
			</div>
			<?
			}
			?>
		</div>
</body>
</html>
