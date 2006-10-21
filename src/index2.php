<? 

/*
================================================================================================================
SAE Admin V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include_once("basico.php"); 
$conDB = connectDB();
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
<head>
<title><? echo getTexts($conDB, 'colegio', 'nombre'); ?></title>
<meta name="Generator" content="EditPlus" />
<meta name="Author" content="Nicolas Naso, Juan Ignacio Barisich, Jose Ignacio Carri" />
<meta name="Keywords" content="Colegio Joaquin V. Gonzalez" />
<meta name="Description" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="icon" href="imagenes/favicon.ico" type="image/x-icon" />
</head>
<frameset rows="61,*" border="0">
	<frameset cols="*,260" border="0">
	<frame src="topI.php" name="topI" marginheight="0" marginwidth="0" noresize="noresize"  scrolling="no"/>
	<frame src="topD.php" name="topD" marginwidth="0" marginheight="0" noresize="noresize" scrolling="no"/>
	</frameset>
	<frameset cols="165,*">
		<frame src="menu.php" name="menu"  marginheight="0" marginwidth="0" noresize="noresize" scrolling="no"/>
		<frame src="

		<? 
		if (!isset($_GET['location'])) 
		{
			ECHO "institucional.php";
		}
		else
		{
			ECHO $_GET['location'];
		}
		?>
		
		" name="body" scrolling="auto" marginheight="0" marginwidth="0" />

	</frameset>	
</frameset>
</html>
<? disConnectDB($conDB); ?>