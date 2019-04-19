<?php
require_once "login.php";
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
if(isset($_POST['pid']))
{
	$pid=$_POST['pid'];
	$conn=new mysqli($hn,$un,$pw,$db);
    if($conn->connect_error) die($conn->connect_error);
    $query="select * from publisher where id='$pid' ";
    $query1="delete from publisher where id='$pid' ";
    $result=$conn->query($query);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
    if($rows>0)
    {
    	$result1=$conn->query($query1);
        echo<<<_end
        <meta http-equiv="refresh" content="0; URL='publisherlist.php'"/>
_end;
  	}
    else
    {
    	echo"No publisher with such id is present.";
    	echo"<br> <a href='publisherlist.php'>Go back</a>";
    }
}
}
?>