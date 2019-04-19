<?php
session_start();
require_once "login.php";
if(isset($_POST['bid']))
{
  $bid=addslashes($_POST['bid']);
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$query="select * from books where id=$bid ";
$result=$conn->query($query);
$rows=$result->num_rows;
if($rows>0)
{
	$q="select line_no as l,shelf_no as sh,stack_no as st,position as p,b.id as id,availability as a,b.name as nam from placing as pl,books as b where b.id=pl.book_id and b.id=$bid ";
echo<<<_end
<!DOCTYPE html>
<html>
<head>
	<title>Place Search</title>
    <style type="text/css">
     #go a{
      margin-right: 12px;
      color:white;
      text-decoration: none;
    }
 
    body {
  background: url(placing.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}

 #go a button{
      cursor: pointer ;
      display: inline-block;
      height: 60px;
      width: auto;
      background-color: black;
      color:white;
      border:0px;
      font-family: sans-serif;
      font-size: 15px;
    }
  #go a button:hover{
    background-color:red;
    border-radius: 10px;
  }
  </style>
</head>
<body>
<div id="go" style="border:2px solid; width:100%; padding-left: 10px ; margin-bottom:10px; height:60px;
background-color: black" >
  <a href="administrator1.php"><button>HOME</button></a>
  <a href="booklist.php"><button>BOOKS</button></a>
  <a href="borrowerdata.php"><button>BORROWER</button></a>
  <a href="authorlist.php"><button>AUTHORS</button></a>
  <a href="publisherlist.php"><button>PUBLISHERS</button></a>
  <a href="placedat.php"><button>PLACING</button></a>
  <a href="signout.php"><button>SIGN OUT</button></a>
  <img src="logo2.png" style="position:absolute; height: 55px; width:120px ;"/>
  </div>
  <div>
	<span style="text-decoration:underline; margin-left: 38%;font-size: 40px;font-weight: 600">BOOKS PLACING</span>
</div>
<table style="text-align: center;width: 100%;margin-top: 20px" border="5px" cellspacing="5px" cellpadding="10px">
  <thead  style="font-size:23px">
    <td>S.No</td>
    <td>Book_ID</td>
    <td>Book_Name</td>
    <td>Line_No</td>
    <td>Shelf_No</td>
    <td>Stack_No</td>
    <td>Position</td>
    <td>Status</td>
  </thead>
  <tbody>
_end;
$result=$conn->query($q);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
       for($j=0;$j<$rows;$j++)
        {
          $result->data_seek($j);
          $row=$result->fetch_array(MYSQLI_ASSOC);
          $l=$row['l'];
          $sh=$row['sh'];
          $st=$row['st'];
          $p=$row['p'];
          $id=$row['id'];
          $nam=$row['nam'];
          if($row['a']=='y')
            $avail="Available";
          else
            $avail="Borrowed";
          $k=$j+1;
          echo<<<_end
          <tr style="font-size:15px">
              <td>$k</td>
              <td>$id</td>
              <td>$nam</td>
              <td>$l</td>
              <td>$sh</td>
              <td>$st</td>
              <td>$p</td>
              <td>$avail</td>
          </tr>
_end;
	    	}
echo<<<_end
</tbody>
</table>
</body>
</html>
_end;
}
else
{
	echo<<<_end
	Book is not present.
	</br>
	<a href="booklist.php">Go back</a> 
	</br>
_end;
}
}
?>