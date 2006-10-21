<? 
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
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
<script>
function devolverSeleccion()
{
	var selec =document.getElementById('autores').elements;
	var texta=opener.document.getElementById('autoresnames');
	var autids=new Array();
	var authidden=opener.document.getElementById('autoresids');
	texta.value="";
	j=0;
	
	for(i=0;i<selec.length-2;i++)
	{
		if(selec[i].type=="checkbox")
		{
			if(selec[i].checked)
			{
				texta.value=texta.value+selec[i].nextSibling.nodeValue+'\r\n';
				autids[j]=selec[i].value;
				j++;
			}
		}
	}

	authidden.value=autids;
}
ok=false;
function checkAllorNot()
{
	ok=!ok;
	var selec =document.getElementById('autores').elements;
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
<center>
<div class="textotitle" style="width:100%">&nbsp;<img src="imagenes/check.gif" alt="check.gif" />&nbsp;Elecci&oacute;n de autor</div>
<br />
<form class="editarperfil" id="autores">
<br />
<input type="button" class="inputAdd" onClick="checkAllorNot()" value="Todos" id="todosbutton">
<input type="reset" value="Restablecer" class='inputAdd'>
<br /><br />
<?
	$i=1;
	$idLibro=$_GET['idLibro'];
	$consulta = "SELECT A.idAutor, A.nombre, LA.idAutor FROM autor A LEFT OUTER JOIN libro_autor LA ON LA.idAutor = A.idAutor AND LA.idLibro = '$idLibro'"; 
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
	echo "<span class='list'><input type='checkbox' value='$row[0]' id='$j' $check class='opt$i'>".$row[1]."</span><br />\r\n";
	if (++$i > 3) $i = 1;
	}
	?>
<br /><br />
<input type="button" onClick='devolverSeleccion();self.close()' value="Aceptar" class='inputAdd'>
<input type="button" onClick='self.close()' value="Cancelar" class='inputAdd'>
<br /><br />
</form>
</center>
</body>
</HTML>
<? disConnectDB($conDB); ?>