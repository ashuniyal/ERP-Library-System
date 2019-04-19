<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
require_once "login.php";
if(isset($_POST['bid'])&&isset($_POST['bname'])&&isset($_POST['bau1'])&&isset($_POST['bpub'])&&isset($_POST['bgen'])&&isset($_POST['bedi'])&&isset($_POST['bpag'])&&isset($_POST['bpr'])&&isset($_POST['bisbn']))
{
    $id=$_POST['bid'];
    $nam=$_POST['bname'];
    $aut=$_POST['bau1'];
    $pub=$_POST['bpub'];
    $gen=$_POST['bgen'];
    $edi=$_POST['bedi'];
    $pag=$_POST['bpag'];
    $bpr=$_POST['bpr'];
    $isbn=$_POST['bisbn'];
    $line=1;
    $shelf=1;
    $stack=1;
    $pos=1;

	$conn=new mysqli($hn,$un,$pw,$db);
    if($conn->connect_error) die($conn->connect_error);
    $que="select max(line_no) as l,max(shelf_no) as sh,max(stack_no) as st,max(position) as p from placing";
    $res=$conn->query($que);
    if(!$res) die($conn->error);
    $rows=$res->num_rows;
    if($rows>0)
{
    for($i=0;$i<$rows;$i++)
  {
        $res->data_seek($i);
        $row=$res->fetch_array(MYSQLI_ASSOC);
        if($row['l']>1)
            $line=$row['l'];
        if($row['sh']>1)
           $shelf=$row['sh'];
        if($row['st']>1)
           $stack=$row['st'];
           $pos=$row['p'];
  }
}
if($pos<30)
    $pos=$pos+1;
else if($stack<15 && $pos==30)
    {
        $pos=1;
        $stack=$stack+1;
    }
else if($shelf<5 && $stack==5)
    {
    $pos=1;
    $stack=1;
    $shelf=$shelf+1;
    }
else if($line<10 && $shelf==5)
    {
        $pos=1;
        $shelf=1;
        $stack=1;
        $line=$line+1;
    }
else
    {
        $pos=0;
        $shelf=0;
        $stack=0;
        $line=0;
    }
    $ch="select * from books where id='$id' ";
    $r=$conn->query($ch);
    $n=$r->num_rows;
    $q="select * from author where id='$aut' ";
    $r1=$conn->query($q);
    $n1=$r1->num_rows;
    $q4="select * from publisher where id='$pub'";
    $r4=$conn->query($q4);
    $n4=$r4->num_rows;    
    if($n==0 && $n1>0 && $n4>0)
    {
        $query="insert into books values('$id','$nam','$pub','$gen','$edi','$pag','$bpr','$isbn')";
        $result=$conn->query($query);
        $query="insert into authorbook values('$aut','$id')";
        $result=$conn->query($query);
        if(isset($_POST['bau2']))
        {
        $aut2=$_POST['bau2'];
        $qe="select * from author where id='$aut2' ";
        $r2=$conn->query($qe);
        $n2=$r2->num_rows;
        if($n2>0)    
        {
            $query="insert into authorbook values('$aut2','$id')";
            $result=$conn->query($query);
        }
        }
        $query2="insert into placing values('$line','$shelf','$stack','$pos','$id',\"y\")";
        $conn->query($query2);
            echo<<<_end
        <meta http-equiv="refresh" content="0; URL='booklist.php'"/>
_end;
  }
    else
    {
    	echo"There is some error in the inputs.<br> Book with given details may be already present or author or publisher data may not be present";
    	echo"<br> <a href='booklist.php'>Try Again</a>";
    }
}
}
?>