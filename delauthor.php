<?php
require_once "login.php";
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
if(isset($_POST['aid']))
{
	$aid=$_POST['aid'];
	$conn=new mysqli($hn,$un,$pw,$db);
    if($conn->connect_error) die($conn->connect_error);
    $query="select * from author where id='$aid' ";
    $query1="delete from author where id='$aid' ";
    $result=$conn->query($query);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
    if($rows>0)
    {
    	$result1=$conn->query($query1);
        echo<<<_end
        <meta http-equiv="refresh" content="0; URL='authorlist.php'"/>
_end;
  	}
    else
    {
    	echo"No author with such id is present.";
    	echo"<br> <a href='authorlist.php'>Go back</a>";
    }
}
}
?>