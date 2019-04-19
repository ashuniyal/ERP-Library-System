<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
echo<<<_end
<!DOCTYPE html>
<html>
<head>
  <title>Borrowers</title>
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
<a href="ALL.php"><button style="border:1px solid black ; border-radius:10% ; float: left; margin-top: 10%; margin-left:40px ;  height: 20% ;
width: auto ; background-color: hsla(42, 66%, 84%,0.6); color: hsla(259, 91%, 8%, 1);cursor: pointer; font-size: 40px">ALL BORROWERS</button></a>
</div>
<div >
<a href="remaining.php"><button style="border:1px solid black ; border-radius:10% ; float: right ; height: 20% ; margin-top: 10%; margin-right:40px ; width: 32% ; background-color: hsla(42, 66%, 84%,0.6); color: hsla(259, 91%, 8%, 1);cursor: pointer; font-size: 40px">BORROWERS LEFT WITH BOOKS</button></a>
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