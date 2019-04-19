<!DOCTYPE html>
<html>
<head>
  <title>Borrower</title>
  <style type="text/css">
     #go a{
      margin-right: 12px;
      color:white;
      text-decoration: none;
    }

    body {
  background: url(borrower.jpg) no-repeat center center fixed;
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
   <form method="post" action="bsearch.php" style="float:right; margin-top:10px; margin-right: 15px; ">
  <input type="number" name="bid" required="required" autocomplete="off" placeholder="Search Borrower id..." />
  <input type="submit" value="Go" style="height: 40px; width:40px"/>
  </form>
</div>
<div>
  <span style="text-decoration: underline; ;margin-left: 34%;font-size: 40px;font-weight: 600">ALL BORROWERS</span>
</div>
<table style="font-weight: 700; text-align: center;width: 100%;margin-top: 20px" border="5px" cellspacing="5px" cellpadding="10px">
  <thead  style="font-size:23px">
    <td>S.No</td>
    <td>ID</td>
    <td>Name</td>
    <td>No_remaining</td>
    <td>Fine</td>
  </thead>
  <tbody>
<?php 
require_once "login.php";
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$query="select id,name,(select count(*) from issue where borrower_id=b.id ) as Number,(select sum((DATEDIFF(CURDATE(),date_of_issue)-30)*5) from issue where (DATEDIFF(CURDATE(),date_of_issue))>30 and borrower_id=b.id) as fine from borrower as b";
$result=$conn->query($query);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
       for($j=0;$j<$rows;$j++)
        {
          $result->data_seek($j);
          $row=$result->fetch_array(MYSQLI_ASSOC);
          $brid=$row['id'];
          $brname=$row['name'];
          $num=$row['Number'];
          $k=$j+1;
          $f=$row['fine'];
          if($f==NULL)
            $f=0;
          echo<<<_end
          <tr style="font-size:15px">
              <td>$k</td>
              <td>$brid</td>
              <td>$brname</td>
              <td>$num</td>
              <td>Rs.$f</td>
          </tr>
_end;
    }
echo<<<_end
</tbody>
</table>
</body>
</html>
_end;
?>