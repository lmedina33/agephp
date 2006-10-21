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
<title>Eleccion de Permisos</title>
<meta name="Generator" content="EditPlus" />
<meta name="Author" content="" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<script type="text/javascript">
function devolverSeleccion()
{
	var selec =document.getElementById('formasignarpermiso').elements;
	var texta=opener.document.getElementById('userpermdesc');
	var permids=new Array();
	var permhidden=opener.document.getElementById('userpermids');
	texta.value="";
	j=0;
	
	for(i=0;i<selec.length-2;i++)
	{
		if(selec[i].type=="checkbox")
		{
			if(selec[i].checked)
			{
				texta.value=texta.value+selec[i].nextSibling.nodeValue+'\r\n';
				permids[j]=selec[i].value;
				j++;
			}
		}
	}
	permhidden.value=permids;

}
ok=false;
function checkAllorNot()
{
	ok=!ok;
	var selec =document.getElementById('formasignarpermiso').elements;
	for(i=0;i<selec.length-2;i++)
	{
		selec[i].checked=ok;
	}
	if(ok){
		document.getElementById('todosbutton').value="Ninguno";
	}
	else
	{
		document.getElementById('todosbutton').value="Todos";
	}
}

</script>

</head>
<body>
<div class="textoTitle" style="width:100%">&nbsp;<img src="imagenes/check.gif" alt="check"/>&nbsp;Elecci&oacute;n de Permisos</div>
<br />
<form id="formasignarpermiso" class="editarperfil" action="userperm.php"><br />
<input type="button" class="inputAdd" onclick="javascript:checkAllorNot();" value="Todos" id="todosbutton"/>

<input type="reset" value="Restablecer" class="inputAdd" />
<br /><br />
	<?
	switch ($_GET["idTipoPersona"])
			{
				case 0:
		         $info = "El administrador posee todos los permisos por defecto. No es necesario tildar ningun permiso.";
				 $admin="No se listan los permisos.";
				 break;
			     case 2:
		         $info = "El alumno solo podr&aacute; bajar archivos.";
				 $permitido="1";
		         break;
				 case 3:
		         $info = "El bibliotecario solo podr&aacute; configurar la secci&oacute;n de biblioteca.";
				 $permitido="5";
		         break;
			     default:
		         $info = "El docente solo podr&aacute; tener los permisos listados.";
				 $ok = true;
			}

			$i=1;
			$consulta = "SELECT P.idPermiso, P.descripcion, PP.idPersona FROM permiso P LEFT OUTER JOIN persona_permiso PP ON PP.idPermiso = P.idPermiso AND PP.idPersona = '".$_GET['idPersona']."' ORDER BY P.descripcion";
		
			$result = $conDB->query($consulta);
			
			while($row = $result->fetchRow())
			{
				$j++;
				if(is_null($row[2]))
				{
					$check = "";
				}
				else
				{
					$check = "checked";
				}
				$j++;
				if($row[0]==$permitido)
				{
					
					echo "<span class=\"list\"><label for=\"$j\"><input type=\"checkbox\" value=\"$row[0]\" class='opt$i' $check id='$j' />$row[1]</label></span><br />\r\n";}
				elseif($ok)
				{
					if($row[0]!='5')
					{
					echo "<span class=\"list\"><label for='$j'><input type=\"checkbox\" value=\"$row[0]\" class=\"opt$i\" $check id=\"$j\" />$row[1]</label></span><br />\r\n";
					}
				}
				if (++$i > 3) $i = 1;
			}
			echo "<h5 style=\"font-size:12px;color:#0058B0\">$admin</h5>";
			?>

<br />

<input type="button" onclick="devolverSeleccion();self.close()" value="Aceptar" class="inputAdd" />
<input type="button" onclick="self.close()" value="Cancelar" class="inputAdd" />
<br /><br />
</form>
<h4 class='editarperfilinfo'>
Informaci&oacute;n:&nbsp;<?echo $info; ?>
<br /><br /> Los campos que tienen un
	<input type="checkbox" disabled="disabled" checked="checked" /> son los permisos actuales del usuario seleccionado.
	</h4>

</body>
</html>
<? disConnectDB($conDB); ?>