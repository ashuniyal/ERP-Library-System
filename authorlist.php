<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
echo<<<_end
<!DOCTYPE html>
<html>
<head>
	<title>Author</title>
    <style type="text/css">
     #go a{
      margin-right: 12px;
      color:white;
      text-decoration: none;
    }
  body {
  background: url(author.jpg) no-repeat center center fixed;
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
  <form method="post" action="authsearch.php" style="float:right; margin-top:10px; margin-right: 15px; ">
  <input type="text" name="autname" required="required" autocomplete="off" placeholder="Search Author..." />
  <input type="submit" value="Go" style="height: 40px; width:40px"/>
  </form>
</div>
<div style="border:4px solid blue;height: 50px;margin-top: 0px;background-color: hsla(18,99%,49%,0.3);">
	<span style="margin-left: 40%;font-size: 40px;font-weight: 600">AUTHORS</span>
</div>
<div style="color: white; font-weight:600">
<table style="text-align: center;width: 100%;margin-top: 20px" border="5px" cellspacing="5px" cellpadding="10px">
	<thead  style="font-size:23px">
    <td>S.No</td>
		<td>ID</td>
    <td>Book_ID</td>
		<td>Name</td>
		<td>Category</td>
		<td>Number written</td>
	</thead>
	<tbody>
_end;
require_once "login.php";
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$query="select a.id as aut,a.name as name,(SELECT GROUP_CONCAT(DISTINCT category SEPARATOR ', ') from authorcat where a_id=aut) as  category,(select count(*) from authorbook where a_id=aut ) as no_written,(SELECT GROUP_CONCAT(DISTINCT b_id SEPARATOR ', ')
FROM authorbook where a_id=aut) as boki from author as a";
$result=$conn->query($query);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
       for($j=0;$j<$rows;$j++)
        {
          $result->data_seek($j);
          $row=$result->fetch_array(MYSQLI_ASSOC);
          $aid=$row['aut'];
          $aname=$row['name'];
          $acat=$row['category'];
          $anw=$row['no_written'];
          $booki=$row['boki'];
          $k=$j+1;
          echo<<<_end
          <tr style="font-size:15px">
          		<td>$k</td>
              <td>$aid</td>
              <td>$booki</td>
          		<td>$aname</td>
          		<td>$acat</td>
          		<td>$anw</td>
          </tr>
_end;
	    	}
echo<<<_end
</tbody>
</table>
</div>
<div style="color: hsl(215,56%,88%); float:left; margin-top: 40px;width: 24%; height:25% ; border: 2px solid black" >
  <form method="POST" action="delauthor.php">
    <span style=" font-family: Florence,cursive ; padding: 10px ;margin-left:23%; font-size:20px ; border-bottom: 3px solid hsla(245,95%,16%,0.9)" >Delete Author</span>
    </br><br><br>
    <span>Author Id&nbsp;&nbsp;:</span>
                    <input type="number" name="aid" autocomplete="off"/><br/></br>
                    <input style="margin-left: 40%;background-color:hsla(198,84%,56%,0.9);height: 36px;width: 60px;font-size:15px;font-weight: 500" type="submit" value="Delete"/><br/>
  </form>
</div>
<div style="color: hsl(215,56%,88%); float:right; margin-top: 40px;width: 24%; height:25% ; border: 2px solid black" >
  <form method="POST" action="addauthor.php">
    <span style=" font-family: Florence,cursive ; padding: 10px ;margin-left:23%; font-size:20px ; border-bottom: 3px solid hsla(245,95%,16%,0.9)" >ADD AUTHOR</span>
    </br><br><br>
    <span>Author Id&nbsp;&nbsp;:</span>
                    <input type="number" name="aid" autocomplete="off" required="required" /><br/></br>
    <span>Name&nbsp;&nbsp;:</span>
                    <input type="text" name="aname" autocomplete="off" required="required"/><br/></br>
    <span>Category-1&nbsp;&nbsp;:</span>
                    <input type="text" name="acat" autocomplete="off" required="required"/><br/></br>
    <span>Category-2&nbsp;&nbsp;:</span>
                    <input type="text" name="acat2" autocomplete="off"/>(optional)<br/></br>
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