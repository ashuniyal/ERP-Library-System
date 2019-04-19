<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
echo<<<_end
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
</div>
<div>
  <span style="text-decoration: underline; margin-left: 40%;font-size: 40px;font-weight: 600">BORROWERS</span>
</div>
<table style="font-weight:700; text-align: center;width: 100%;margin-top: 20px" border="5px" cellspacing="5px" cellpadding="10px">
  <thead  style="font-size:23px;text-decoration:underline">
    <td>S.No</td>
    <td>ID</td>
    <td>Name</td>
    <td>Book Id</td>
    <td>Book Name</td>
    <td>Date</td>
    <td>No_issued</td>
    <td>Fine</td>
  </thead>
  <tbody>
_end;
require_once "login.php";
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$query="select count(*) as borrnum,br.id as id,br.name as name,(SELECT GROUP_CONCAT(DISTINCT book_id SEPARATOR ', ')
FROM issue where borrower_id=br.id ) as book_id,(select GROUP_CONCAT(distinct name separator ', ') from books where id in (select book_id from issue where borrower_id=br.id)) as book_name,(select GROUP_CONCAT(date_of_issue separator ', ') from issue where borrower_id=br.id) as date_of_issue,(select sum((DATEDIFF(CURDATE(),date_of_issue)-30)*5) from issue where (DATEDIFF(CURDATE(),date_of_issue))>30 and borrower_id=i.borrower_id) as fine from borrower br,issue i,books b where (br.id=i.borrower_id) and (i.book_id=b.id) group by br.id ";
$result=$conn->query($query);
    if(!$result) die($conn->error);
    $rows=$result->num_rows;
       for($j=0;$j<$rows;$j++)
        {
          $result->data_seek($j);
          $row=$result->fetch_array(MYSQLI_ASSOC);
          $brid=$row['id'];
          $brname=$row['name'];
          $bookid=$row['book_id'];
          $bookname=$row['book_name'];
          $brdoi=$row['date_of_issue'];
          $n=$row['borrnum'];
          $f=$row['fine'];
          if($f==NULL)
            $f=0;
          $k=$j+1;
          echo<<<_end
          <tr style="font-size:15px">
              <td>$k</td>
              <td>$brid</td>
              <td>$brname</td>
              <td>$bookid</td>
              <td>$bookname</td>
              <td>$brdoi</td>
              <td>$n</td>
              <td>Rs.$f</td>
          </tr>
_end;
    }
echo<<<_end
</tbody>
</table>
<div style="font-weight:700; float:left; margin-top: 40px;width: 24%; height:25% ; border: 2px solid black" >
  <form method="POST" action="delborrower.php">
    <span style=" font-family: Florence,cursive ; padding: 10px ;margin-left:23%; font-size:20px ; border-bottom: 3px solid hsla(245,95%,16%,0.9)" >Return Book</span>
    </br><br><br>
    <span>Book Id&nbsp;&nbsp;:</span>
                    <input type="number" name="bid"/><br/></br>
                    <input style="margin-left: 40%;background-color:hsla(198,84%,56%,0.9);height: 36px;width: 60px;font-size:15px;font-weight: 500" type="submit" value="Return"/><br/>
  </form>
</div>
<div style="font-weight:700; float:right ; margin-top: 40px; width: 24%; height:25% ; border: 2px solid black" >
  <form method="POST" action="addexistborrower.php">
    <span style=" font-family: Florence,cursive ; padding: 10px ;margin-left:34%; font-size:20px ; border-bottom: 3px solid hsla(245,95%,16%,0.9)" >Borrower</span>
    </br><br><br>
    <span>Borrower Id&nbsp;&nbsp;:</span>
                    <input type="number" autocomplete="off" name="borrid"  required="required"/><br/></br>
    <span>Borrower Name&nbsp;&nbsp;:</span>
                    <input type="text" name="borrname" autocomplete="off" required="required"/><br/></br>
    <span>Book Id&nbsp;&nbsp;:</span>
                    <input type="number" name="booki" autocomplete="off" required="required"/><br/></br>
                    <input style="margin-left: 40%;background-color:hsla(198,84%,56%,0.9);height: 36px;width: 60px;font-size:15px;font-weight: 500" type="submit" value="Issue"/><br/>
    </form>
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