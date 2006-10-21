<? 
session_start(); 
if(isset($_SESSION["user"]))
{ 
	$_SESSION = array();
	session_destroy(); 
	header("location: index2.php"); 
} 
else 
{ 
	header("location: topD.php"); 
} 
?> 

