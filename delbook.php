<?php
require_once "login.php";
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
if(isset($_POST['bid']))
{
	$boid=$_POST['bid'];
	$conn=new mysqli($hn,$un,$pw,$db);
    if($conn->connect_error) die($conn->connect_error);
    $query="select * from books where id='$boid' ";
    $query1="delete from books where id='$boid' ";
    $result=$conn->query($query);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
    if($rows>0)
    {
    	$result1=$conn->query($query1);
        $conn->query($query2);
        $conn->query($query3);
        echo<<<_end
        <meta http-equiv="refresh" content="0; URL='booklist.php'"/>
_end;
  	}
    else
    {
    	echo"No book with such id is present.";
    	echo"<br> <a href='booklist.php'>Go back</a>";
    }
}
}
?>