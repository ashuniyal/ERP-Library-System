<?php
session_start();
$_SESSION['id']="NULL";
$_SESSION['pass']="NULL";
session_destroy();
echo<<<_end
<meta http-equiv="refresh" content="0; URL='frontpage.php' "/>  	
_end;
?>