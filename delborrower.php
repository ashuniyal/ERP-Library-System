<?php
require_once "login.php";
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
if(isset($_POST['bid']))
{
	$bid=$_POST['bid'];
	$conn=new mysqli($hn,$un,$pw,$db);
    if($conn->connect_error) die($conn->connect_error);
    $query="select * from issue where book_id='$bid' ";
    $query1="delete from issue where book_id='$bid' ";
    $result=$conn->query($query);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
    if($rows>0)
    {
        $conn->query($query1);
        $query2="update placing set availability='y' where book_id='$bid' ";
        $conn->query($query2);
        echo<<<_end
        <meta http-equiv="refresh" content="0; URL='remaining.php'"/>
_end;
  	}
    else
    {
    	echo"No book with such id is borrowed .";
    	echo"<br> <a href='borrowerdata.php'>Go back</a>";
    }
}
}
?>