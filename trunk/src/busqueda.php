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
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" /> 
</head>
<body>
<div class="indice"><a href="biblioteca.php" class="linkscentrales" title='Biblioteca'>Biblioteca</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;B�squeda
</div>
<div class="textoinfo">
<div class="textoTitle"><img src="imagenes/search.gif" alt="search.gif" />&nbsp;Resultado de la b�squeda</div><br />

<?
//cantidad de resultados por p�gina (opcional, por defecto 20)
$_pagi_cuantos = 4;//Eleg� un n�mero peque�o para que se generen varias p�ginas

//cantidad de enlaces que se mostrar�n como m�ximo en la barra de navegaci�n
$_pagi_nav_num_enlaces = 3;//Eleg� un n�mero peque�o para que se note el resultado

//Decidimos si queremos que se muesten los errores de mysql
$_pagi_mostrar_errores = false;//recomendado true s�lo en tiempo de desarrollo.

//Si tenemos una consulta compleja que hace que el Paginator no funcione correctamente, 
//realizamos el conteo alternativo.
$_pagi_conteo_alternativo = true;//recomendado false.


//definimos qu� ir� en el enlace a la p�gina anterior
$_pagi_nav_anterior = "&#171;&nbsp;anterior";// podr�a ir un tag <img> o lo que sea

//definimos qu� ir� en el enlace a la p�gina siguiente
$_pagi_nav_siguiente = "siguiente&nbsp;&#187;";// podr�a ir un tag <img> o lo que sea

//definimos el estilo para los links
$_pagi_nav_estilo='linkscentrales';

$idAutor = $_GET["idAutor"];
$idTema = $_GET["idTema"];
$titulo = $_GET["titulo"];

$_pagi_sql = "SELECT DISTINCT libro.nombre, libro.anioEdicion, tema.nombre, libro.idLibro FROM tema, libro, libro_autor WHERE libro.idTema = tema.idTema AND libro.idLibro = libro_autor.idLibro"; 
if ($idAutor <> "todos")
{
	$_pagi_sql .= " AND libro_autor.idAutor LIKE $idAutor";
}
if ($idTema <> "todos")
{
	$_pagi_sql .= " AND tema.idTema LIKE $idTema";
}
if ($titulo <> "")
{
	$_pagi_sql .= " AND libro.nombre LIKE '%$titulo%'";
}

//Incluimos el script de paginaci�n. �ste ya ejecuta la consulta autom�ticamente
include("paginator.inc.php");

	if($row =& $_pagi_result->fetchRow())
	{
		do
		{
		echo "<div>";
		echo "<span class=\"busqueda\">Nombre:&nbsp;</span><i>".$row[0]."</i><br />";
		echo "<span class=\"busqueda\">A&ntilde;o de Edici&oacute;n: </span><i>".$row[1]."</i><br />";
		echo "<span class=\"busqueda\">Tema: </span><i>".$row[2]."</i><br />";
		echo "<span class=\"busqueda\">Autor/es: </span><i>";
			$consulta2 = "SELECT autor.nombre FROM autor, libro_autor WHERE autor.idAutor = libro_autor.idAutor AND libro_autor.idLibro LIKE $row[3]";
			$result2 = $conDB->query($consulta2);
			$straux= '';
			while($row2 = $result2->fetchRow())
			{
				
				$straux.= $row2[0].", ";
			}
			echo substr($straux,0,strlen($straux)-2);
			echo "</i></div>";
			echo "<p class=\"lineaBiblioteca\"></p>";			 
		}while($row =& $_pagi_result->fetchRow());

		//Incluimos la barra de navegaci�n
		echo"<p align=\"center\">".$_pagi_navegacion."</p>";
	}
	else
	{
	?>
<div class="advice2">No hay resultados para mostrar</div><br />
<? 	} ?>
<br /><a href="#" onClick="parent['body'].document.location='biblioteca.php'" class="linkscentrales" id="otrabusqueda" title="Realizar otra busqueda">Realizar otra busqueda</a><br /><br />
</div>
</body>
</html>
<?disConnectDB($conDB);?>

