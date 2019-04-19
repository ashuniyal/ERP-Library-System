<?php 
session_start();
require_once "login.php";
if(isset($_POST['uname']) && isset($_POST['psw']))
{
	$id=addslashes($_POST['uname']);
	$p=$_POST['psw'];
	$pass=hash('ripemd128',$_POST['psw']);
	$conn=new mysqli($hn,$un,$pw,$db);
    if($conn->connect_error) die($conn->connect_error);
    $query= "select * from admins where id='$id' and Pass='$pass' ";
    $result=$conn->query($query);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;

    if($rows==0)
    	{
   		  echo<<<_end
          Invalid UserName or Password.<br>
	      <a href="frontpage.php">Back to Login page.</a>
_end;
    	}
    else
    {  
    $_SESSION['id']=$id;
    $_SESSION['pass']=$pass;   
		$conn->close();
		$result->close();
  		echo<<<_end
  		<meta http-equiv="refresh" content="0; URL='administrator1.php' "/>  	
_end;
    }

}
else
{
	    echo<<<_end
        Please fill both the fields.\n
	    <a href="frontpage.php">Back to Login page.</a>
_end;
}

?>