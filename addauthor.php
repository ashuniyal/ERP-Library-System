<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
require_once "login.php";
if(isset($_POST['aid'])&&isset($_POST['aname'])&&isset($_POST['acat']))
{
    $id=$_POST['aid'];
    $nam=$_POST['aname'];
    $cat=$_POST['acat'];
	$conn=new mysqli($hn,$un,$pw,$db);
    if($conn->connect_error) die($conn->connect_error);
    $query="insert into author values('$id','$nam')";
    $result=$conn->query($query);
    $query="insert into authorcat values('$id','$cat')";
    $result=$conn->query($query);    
    if($result)
    {
        if($_POST['acat2']!=NULL)
            {
                $cat=$_POST['acat2'];
                $query="insert into authorcat values('$id','$cat')";
                $result=$conn->query($query);
            }
    	echo"Author's data is added successfully.";
  		echo"<br><a href='authorlist.php'>Go back</a>";
        echo<<<_end
        <meta http-equiv="refresh" content="0; URL='authorlist.php'"/>
_end;
}
    else
    {
    	echo"There is some error in the inputs.";
    	echo"<br> <a href='authorlist.php'>Try Again</a>";
    }
}
}
?>