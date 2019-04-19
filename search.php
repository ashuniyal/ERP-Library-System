<?php
session_start();
require_once "login.php";
if(isset($_POST['bname']))
{
  $bname=addslashes($_POST['bname']);
$conn=new mysqli($hn,$un,$pw,$db);
if($conn->connect_error) die($conn->connect_error);
$query="select * from books where name like '%".$bname."%' ";
$result=$conn->query($query);
$rows=$result->num_rows;
if($rows>0)
{
	$q="select distinct b.id as book_id,b.name as book_name,(select group_concat(distinct a.name separator ' & ') from author as a,authorbook as ab where a.id=ab.a_id and ab.b_id=book_id ) as authors,p.name as publisher_name,edition,genre,pages,price,isbn_no,availability as av from books b,publisher p,placing where (b.publisher_id=p.id) and (placing.book_id=b.id) and b.name like '%".$bname."%' ";
echo<<<_end
<!DOCTYPE html>
<html>
<head>
	<title>Books Search</title>
    <style type="text/css">
     #go a{
      margin-right: 12px;
      color:white;
      text-decoration: none;
    }
 
    body {
  background: url(books.jpg) no-repeat center center fixed;
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
	<span style="text-decoration:underline; margin-left: 38%;font-size: 40px;font-weight: 600">BOOKS DETAILS</span>
</div>
<div style="font-weight:800; color:hsl(245, 93%, 33%)">
<table style="text-align: center;width: 100%;margin-top: 20px" border="5px" cellspacing="5px" cellpadding="10px">
	<thead  style="font-size:23px; text-decoration: underline ">
		<td>S.No</td>
		<td>ID</td>
		<td>Book</td>
    <td>Author</td>
		<td>Publisher</td>
		<td>Edition</td>
		<td>Genre</td>
		<td>Pages</td>
		<td>Price</td>
		<td>Isbn_no.</td>
		<td>Availability</td>
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
          $bid=$row['book_id'];
          $bname=$row['book_name'];
          $aname=$row['authors'];
          $bpname=$row['publisher_name'];
          $bed=$row['edition'];
          $bgen=$row['genre'];
          $bpages=$row['pages'];
          $bprice=$row['price'];
          $bisbn=$row['isbn_no'];
          if($row['av']=='y')
          	$av="Yes";
          else
          	$av="Borrowed";
          $k=$j+1;
          echo<<<_end
          <tr style="font-size:15px">
          		<td>$k</td>
          		<td>$bid</td>
          		<td>$bname</td>
              <td>$aname</td>
          		<td>$bpname</td>
          		<td>$bed</td>
          		<td>$bgen</td>
          		<td>$bpages</td>
          		<td>$bprice</td>
          		<td>$bisbn</td>
          		<td>$av</td>
          </tr>
_end;
	    	}
echo<<<_end
</tbody>
</table>
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
	echo<<<_end
	Book is not present.
	</br>
	<a href="booklist.php">Go back</a> 
	</br>
_end;
}
}
?>