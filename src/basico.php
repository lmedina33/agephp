<? 

/*
================================================================================================================
SAE V1.0. Este programa se distribuye segun la licencia GPL v.2 o posteriores y no tiene garantias de ningun tipo. Puede obtener una copia de la licencia GPL o ponerse en contacto con la Free Software Foundation en http://www.gnu.org 
================================================================================================================
*/

include_once("DB.php"); 
include_once("config/config.inc");

function connectDB()
{
	$conDB = DB::connect($GLOBALS["dsn"]);
	return $conDB;
}

function disconnectDB($conDB)
{
	$conDB->disconnect();
	return 0;
}

function getImage($conDB, $Table,$ImageFileField,$clase,$alt,$align)
{
		$image="";
		if($align!="")
			{
			$alignment="align=\"".$align."\"";
			}
		$consulta = "select $ImageFileField From $Table";
		$id_resu = $conDB->query($consulta);
		if($id_resu->numrows()!=0)
		{
		$row =& $id_resu->fetchRow();
		$image = "<img src=\"".$GLOBALS["uriImages"].'/'.$row[0]."\" class=\"".$clase."\" alt=\"".$alt."\" ".$alignment." />";
		}
		return $image;
}

function getTexts($conDB, $Table, $TextField)
{
	$consulta = "select $TextField From $Table";
	$id_resu = $conDB->query($consulta);
	$row =& $id_resu->fetchRow();
	return $row[0];
}

function getFile($blobStream, $fileName)
{
	if (!file_exists($fileName))
	{ 
		$fp = fopen($fileName,"w");
		fwrite($fp,$blobStream);
		fclose($fp); 	
	}
	return $fileName;
}

function getTableTexts($conDB,$consulta,$tagType,$classStyle)
{
	
	$textReturn = '';  
	$id_resu = $conDB->query($consulta);
	while ($row =& $id_resu->fetchRow()){
		
		$textReturn .= "<$tagType class=$classStyle>";
		$textReturn .= $row[0];
		$textReturn .= "</$tagType>";
		$textReturn .= '<br>'.$row[1].'<br><br>';		
}
	return $textReturn;
}

function canAccess($permisoNecesario)
{
	// Devuelve True si es root o si tiene el permiso
	@session_start();
	return @isset($_SESSION["user"]) && ($_SESSION["tipopersona"]== 'Administrador' || in_array($permisoNecesario,$_SESSION["permisos"]));
}

function canAccessTipoPersona($tipoPersona)
{
	// Devuelve True de acuerdo al tipodepersona
	@session_start();
	return @isset($_SESSION["user"]) && ($_SESSION["tipopersona"]== $tipoPersona);
}

function dia($numeroDia)
{
	switch ($numeroDia)
	{
	case 1: return "Lunes";
			break;
	case 2: return "Martes";
		break;
	case 3: return "Mi&eacute;rcoles";
			break;
	case 4: return "Jueves";
			break;
	case 5: return "Viernes";
			break;
	case 6: return "Sabado";
			break;
	}
}

function convertirLetras($texto)
{
	$letras=array("á","é","í","ó","ú","ñ","Ñ","!","»","«","¿","ü","¼","½","¾","®","©");
	$diccionario = array (
						"á"=>"&aacute;",
						"é"=>"&eacute;",
						"í"=>"&iacute;",
						"ó"=>"&oacute;",
						"ú"=>"&uacute;",
						"ñ"=>"&ntilde;",
						"Ñ"=>"&Ntilde;",
						"!"=>"&iexcl;",
						"»"=>"&raquo;",
						"«"=>"&laquo;",
						"¿"=>"&iquest;",
						"ü"=>"&uuml;",
						"¼"=>"&frac14;",
						"½"=>"&frac12;",
						"¾"=>"&frac34;",
						"®"=>"&reg;",
						"©"=>"&copy;"						
							);
	for($i=0;$i<count($letras);$i++)
		{
		$texto=ereg_replace($letras[$i],$diccionario[$letras[$i]],$texto);
		};
	return $texto;
	}


  function encrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));
     $result.=$char;
   }

   return base64_encode($result);
  }

  function decrypt($string, $key) {
   $result = '';
   $string = base64_decode($string);

   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)-ord($keychar));
     $result.=$char;
   }

   return $result;
  }


?>