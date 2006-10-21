<? 
session_start(); 
if(isset($_SESSION["user"]))
{	// El usuario esta registrado
	?>	
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta name="Generator" content="EditPlus" />
<meta name="Author" content="" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" href="estilos/estilos.css" type="text/css" />
</head>
<body class="bodytop">
<div class="logindatosIn">
<b class="resaltado">Bienvenido:&nbsp;</b><i><? echo $_SESSION["tipopersona"] ?></i></div>
<span class="logindatosIn"><i><? echo $_SESSION["nombres"];?></i>
</span>
<div class="logindatosIn">Para cerrar la sesión, pulsa: <a href="logout.php" class="linkscentrales" target="_parent" title="Salir"><b>salir</b></a>
</div>
</html> 
<?
} 
else 
{ // El usuario NO esta registrado
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
<link rel="stylesheet" href="estilos/login.css" type="text/css" />
<script src="scripts/funciones.js" type="text/Javascript"></script>
</head>
<body class="bodylogin">
<form method="post" action="comprueba.php" id="entry" onsubmit="return validarCamposGenerico('user','pass')" target="_parent">
	<label for="user"><img src="imagenes/user.gif" alt="user" />&nbsp;Usuario:</label>
	<input id="user" name="user" tabindex="1" /><br class="br"/>
	<label for="pass">
	<img src="imagenes/password.gif" alt="password"/>&nbsp;Contrase&ntilde;a:</label>
	<input id="pass" name="pass" type="password" tabindex="2" /><br />
	<input value="ok" type="submit" class="ok" tabindex="3" />
	</form>
</body>
</html>
<? 
} 
?> 
