<? 
include_once("basico.php"); 
$conDB = connectDB();
$permisoNecesario = 0; 
if (!canAccess($permisoNecesario))
{
	header("location:noprivilegies.html");
}
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title> New Document </title>
<meta name="Generator" content="EditPlus">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta http-equiv="content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" href="estilos/estilos.css" type="text/css">
<script language="JavaScript">
function cambiar()
{
var index=document.getElementById('nivel').selectedIndex;

document.getElementById('anio').length=0;

if(index==0) vacio();
if(index==1) egb();
if(index==2) inicial();
}

function vacio(){
opcion0=new Option("-----","","defauldSelected");
document.getElementById('anio').options[0]=opcion0;
}

function egb(){
opcion0=new Option("1ro","1","defauldSelected");
opcion1=new Option("2do","2");
opcion2=new Option("3ro","3");

document.getElementById('anio').options[0]=opcion0;
document.getElementById('anio').options[1]=opcion1;
document.getElementById('anio').options[2]=opcion2;
}

function inicial(){
opcion0=new Option("1ro","4","defauldSelected");
opcion1=new Option("2do","5");
opcion2=new Option("3ro","6");
opcion3=new Option("4to","7");
opcion4=new Option("5to","8");
opcion5=new Option("6to","9");
opcion6=new Option("7mo","10");
opcion7=new Option("8vo","11");
opcion8=new Option("9no","12");

document.getElementById('anio').options[0]=opcion0;
document.getElementById('anio').options[1]=opcion1;
document.getElementById('anio').options[2]=opcion2;
document.getElementById('anio').options[3]=opcion3;
document.getElementById('anio').options[4]=opcion4;
document.getElementById('anio').options[5]=opcion5;
document.getElementById('anio').options[6]=opcion6;
document.getElementById('anio').options[7]=opcion7;
document.getElementById('anio').options[8]=opcion8;
}
function checkFields()
{
var nivel=document.getElementById('nivel').value;
if(nivel==""){
	alert("Seleccione un nivel y su año correspondiente");
	return false;
	}
else
	{
	return true;
	}
}
</script>
</head>
<body>
<div class="indice"><a href="configuracion.php" class="linkscentrales" title="Configuraci&oacute;n">Configuraci&oacute;n</a>&nbsp;<img src="imagenes/p.gif" alt="p.gif" />&nbsp;Clases de apoyo</div>
<div class="textoinfo">
<div class="textotitle">&nbsp;<img src="imagenes/normativas.gif" alt="normativas.gif" />&nbsp;Clases de apoyo</div><br />
<? if(!isset($_POST['configclasesdeapoyo']))
{?>
<form action="configclasesdeapoyo.php" method="post" class="editarperfil" name="formulario" onsubmit="return checkFields()">
<?
$query="SELECT nombre,idNivel FROM nivel";
$result=$conDB->query($query);
?>
<dt>Seleccione el nivel y el a&ntilde;o que desea editar:
<br /><br />
</dt>
<dd>Nivel:
<select name="nivel" onchange="cambiar()" id="nivel">
<option selected="selected">-------</option>
<?
while($row=$result->fetchRow())
{
	echo "<option value=\"$row[1]\">\n";
	echo $row[0];
}

?>
</select>
A&ntilde;o:
<select name="anio" id="anio">
<option>-----</option>
</select>
</dd>
<input type="submit" value="Aceptar" name="configclasesdeapoyo" />
<input type="button" value="Cancelar" onclick="document.location='configuracion.php'" />
<br /><br />
</form>
<?
}
else
{
	$consultaCurso = "SELECT DISTINCT materia.Nombre, curso.idCurso FROM materia, curso, claseapoyo WHERE materia.idMateria = curso.idMateria AND claseapoyo.idCurso = curso.idCurso AND curso.idAnio ='".$_POST['anio']."' ORDER BY materia.Nombre"; 
	$result2 = $conDB->query($consultaCurso);
	if($result2->numRows()!=0)
	{
	$consultaAnio = "SELECT nombre FROM anio WHERE idAnio = '".$_POST['anio']."'"; 
	$result = $conDB->query($consultaAnio);
	$i = 1; //Para backHeadersTable
	$anio = $result->fetchRow();
	$consultaNivel = "SELECT nombre FROM nivel WHERE idNivel = '".$_POST['nivel']."'"; 
	$result = $conDB->query($consultaNivel);
	$nivel = $result->fetchRow();
 	echo "<span class=\"encabezadosTables\">";
	echo $anio[0]." - ".$nivel[0];
	echo "</span>";
	echo "<table border=\"1\" width=\"100%\" class=\"textotable\">";
	echo "<tr class=\"backHeadersTable$i\">";
    echo "<td><p>Materia</td><td><p>D&iacute;as y Horarios</td><td><p>Profesor a Cargo</td></tr>";
	while($rowCurso = $result2->fetchRow())
	{
		echo "<tr><td>$rowCurso[0]</td>";
		$dias = "";
		$profesores = "";
		$consultaClaseAp = "SELECT claseapoyo.dia, claseapoyo.horarioInicio, claseapoyo.horarioFin, persona.nombres, persona.apellidos FROM claseapoyo, persona WHERE claseapoyo.idProfesor = persona.idPersona AND claseapoyo.idCurso = $rowCurso[1] ORDER BY claseapoyo.dia"; 
		$result3 = $conDB->query($consultaClaseAp);
		while($rowClaseAp = $result3->fetchRow())
		{
			if($horaInicio = strtotime($rowClaseAp[1]))
			{
				$horaInicio = gmstrftime("%H:%M" ,$horaInicio);
			}
			if($horaFin = strtotime($rowClaseAp[2]))
			{
				$horaFin = gmstrftime("%H:%M" ,$horaFin);
			}
			$dias .= dia($rowClaseAp[0])." de $horaInicio a $horaFin<br />";
			$profesores .=$rowClaseAp[4].", ".$rowClaseAp[3]."<br />";
		}
		echo "<td>$dias</td>";
		echo "<td>$profesores</td>";
		echo "</tr>";
	}
	if (++$i > 6) $i = 1;
	echo "</table><br /><br />";
	echo "<input type=\"submit\" value=\"Eliminar clase de apoyo\">";
	}
?>
<br />
<br />
<?
}
?>
</div>
</body>
</html>
<? disConnectDB($conDB); ?>