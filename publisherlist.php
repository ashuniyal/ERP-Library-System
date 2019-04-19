<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
echo<<<_end
<!DOCTYPE html>
<html>
<head>
	<title>Publisher</title>
    <style type="text/css">
     #go a{
      margin-right: 12px;
      color:white;
      text-decoration: none;
    }

    body {
  background: url(publisher1.jpg) no-repeat center center fixed;
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
  <form method="post" action="pubsearch.php" style="float:right; margin-top:10px; margin-right: 15px; ">
  <input type="text" name="pubname" required="required" autocomplete="off" placeholder="Search Publisher..." />
  <input type="submit" value="Go" style="height: 40px; width:40px"/>
  </form>
</div>
<div>
	<span style="text-decoration: underline; color:hsl(255, 98%, 19%); margin-left: 40%;font-size: 40px;font-weight: 600">PUBLISHERS</span>
</div>
<div style="color:hsl(300,94%,10%); font-weight:700">
<table style="text-align: center;width: 100%;margin-top: 20px" border="5px" cellspacing="5px" cellpadding="10px">
	<thead  style="font-size:23px">
    <td>S.No</td>
		<td>ID</td>
		<td>Name</td>
		<td>Printing House</td>
		<td>Number published</td>
	</thead>
	<tbody>
_end;
require_once "login.php";
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$query="select p.id as pubid,name,printing_house,(select count(*) from books where publisher_id=pubid) as no_published from publisher as p";
$result=$conn->query($query);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
       for($j=0;$j<$rows;$j++)
        {
          $result->data_seek($j);
          $row=$result->fetch_array(MYSQLI_ASSOC);
          $pid=$row['pubid'];
          $pname=$row['name'];
          $pphouse=$row['printing_house'];
          $pnp=$row['no_published'];
          $k=$j+1;
          echo<<<_end
          <tr style="font-size:15px">
          		<td>$k</td>
              <td>$pid</td>
          		<td>$pname</td>
          		<td>$pphouse</td>
          		<td>$pnp</td>
          </tr>
_end;
		}
echo<<<_end
</tbody>
</table>
</div>
<div style="color:hsl(215,56%,88%); float:left; margin-top: 40px;width: 24%; height:25% ; border: 2px solid black" >
  <form method="POST" action="delpub.php">
    <span style=" font-family: Florence,cursive ; padding: 10px ;margin-left:23%; font-size:20px ; border-bottom: 3px solid hsla(245,95%,16%,0.9)" >Delete Publisher</span>
    </br><br><br>
    <span>Publisher Id&nbsp;&nbsp;:</span>
                    <input type="number" autocomplete="off" name="pid"/><br/></br>
                    <input style="margin-left: 40%;background-color:hsla(198,84%,56%,0.9);height: 36px;width: 60px;font-size:15px;font-weight: 500" type="submit" value="Delete"/><br/>
  </form>
</div>
<div style="color:hsl(215,56%,88%); float:right; margin-top: 40px;width: 24%; height:25% ; border: 2px solid black" >
  <form method="POST" action="addpub.php">
    <span style=" font-family: Florence,cursive ; padding: 10px ;margin-left:23%; font-size:20px ; border-bottom: 3px solid hsla(245,95%,16%,0.9)" >ADD PUBLISHER</span>
    </br><br><br>
    <span>Publisher Id&nbsp;&nbsp;:</span>
                    <input type="number" name="pid" autocomplete="off" required="required" /><br/></br>
    <span>Name&nbsp;&nbsp;:</span>
                    <input type="text" name="pname" autocomplete="off" required="required"/><br/></br>
    <span>Printing House&nbsp;&nbsp;:</span>
                    <input type="text" name="pph" autocomplete="off" required="required"/><br/></br>
                    <input style="margin-left: 40%;background-color:hsla(198,84%,56%,0.9);height: 36px;width: 60px;font-size:15px;font-weight: 500" type="submit" value="Add"/><br/>
    <form>
</div>
</body>
</html>
_end;
}
else
{
echo"<a href='frontpage.php'>Go Back to Login Page</a>";
}
?>