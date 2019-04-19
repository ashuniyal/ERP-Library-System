<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
require_once "login.php";
if(isset($_POST['borrid'])&&isset($_POST['booki'])&&isset($_POST['borrname']))
{
    $borrowerid=$_POST['borrid'];
    $bookid=$_POST['booki'];
    $name=$_POST['borrname'];
    $dat=date("Y/m/d");
    $conn=new mysqli($hn,$un,$pw,$db);
    if($conn->connect_error) die($conn->connect_error);
 	$checking="select * from books where id='$bookid' ";
    $res=$conn->query($checking);
    $rows=$res->num_rows;

    $check2="select availability as a from placing where book_id='$bookid' ";
    $res2=$conn->query($check2);
       if(!$res2) die($conn->error);
    $rows2=$res2->num_rows;
    $avail='n';
    for($i=0;$i<$rows2;$i++)
  {
        $res2->data_seek($i);
        $row=$res2->fetch_array(MYSQLI_ASSOC);
        $avail=$row['a'];
  }
if($avail=='y')
    $c=1;
else
    $c=0;
	$query="select count(*) as c from issue where borrower_id='$borrowerid' ";
    $re=$conn->query($query);
     $rows2=$re->num_rows;
     $num=1;
    for($i=0;$i<$rows2;$i++)
  {
        $re->data_seek($i);
        $row=$re->fetch_array(MYSQLI_ASSOC);
        $num=$row['c'];
  }

if($num>=4)
	$k=0;
else
	$k=1;


    if($rows>0 && $c && $k)
    {
        $query="select * from borrower where id='$borrowerid'";
        $result=$conn->query($query);
        $n=$result->num_rows;
        if($n>0)
    {
        $query1="insert into issue values('$borrowerid','$bookid','$dat')";
        $result1=$conn->query($query1);
        $query3="update placing set availability='b' where book_id='$bookid' ";
        $conn->query($query3);
    }
    else
    {
        $query="insert into borrower values('$borrowerid','$name')";
        $result=$conn->query($query);
        $query1="insert into issue values('$borrowerid','$bookid','$dat')";
        $result1=$conn->query($query1);
        $query3="update placing set availability='b' where book_id='$bookid' ";
        $conn->query($query3);
    }
        echo<<<_end
        <meta http-equiv="refresh" content="0; URL='remaining.php'"/>
_end;
}
	else
	{
	 	echo"Either book is already borrowed or you have reached your maximum limit.";
    	echo"<br> <a href='booklist.php'>Try Again</a>";
	
	}
}
}
?>