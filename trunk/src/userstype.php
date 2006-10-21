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
<link REL="stylesheet" href="estilos/estilos.css" TYPE="text/css" />
<script>
function devolverEleccion()
{
	var id =document.getElementById('tipopersona').value;
	opener.document.getElementById('usertypeid').value=id;
	opener.document.getElementById('usertypedesc').value=document.getElementById(id).innerHTML;
}
</script>
</head>

<body>
<center>
<div class="textoTitle" style="width:100%">&nbsp;<img src="imagenes/check.gif" alt="check.gif" />&nbsp;Elecci&oacute;n de tipo de persona</div><br />
<form class="editarperfil">
<br />
<select id="tipopersona">
			<?
			$i=1;

			$consulta = "SELECT idTipoPersona, tipo FROM tipopersona ORDER BY tipo"; 
			
			$result = $conDB->query($consulta);
			while($row = $result->fetchRow())
			{
				echo "<option value='$row[0]' class='opt$i' id='$row[0]'>$row[1]";
				if (++$i > 3) $i = 1;
			}
			?>
</select>
<br /><br />
<input type="button" onclick="devolverEleccion();self.close()" value="Aceptar" class="inputAdd" />
<input type="button" onclick="self.close()" value="Cancelar" class="inputAdd" />
<br /><br />
</form>
</center>
</body>
</html>
<? disConnectDB($conDB); ?>