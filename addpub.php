<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
require_once "login.php";
if(isset($_POST['pid'])&&isset($_POST['pname'])&&isset($_POST['pph']))
{
    $id=$_POST['pid'];
    $nam=$_POST['pname'];
    $ph=$_POST['pph'];
	$conn=new mysqli($hn,$un,$pw,$db);
    if($conn->connect_error) die($conn->connect_error);
    $query="insert into publisher values('$id','$nam','$ph')";
    $result=$conn->query($query);
    if($result)
    {
    	echo"Publisher's data is added successfully.";
  		echo"<br><a href='publisherlist.php'>Go back</a>";
        echo<<<_end
        <meta http-equiv="refresh" content="0; URL='publisherlist.php'"/>
_end;
 	}
    else
    {
    	echo"There is some error in the inputs.";
    	echo"<br> <a href='publisherlist.php'>Try Again</a>";
    }
}
}
?>