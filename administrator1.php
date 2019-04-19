<?php
session_start();
if(isset($_SESSION['id'])&&isset($_SESSION['pass']))
{
echo<<<_end
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
 body {
  background: url(b.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
	<title>Administrator Panel</title>
</head>
<body>
<div style="border-radius: 5% ; background: url(borrower.jpg) no-repeat center center fixed; height:160px; width: 1200px ; margin-top: 0px"><img src="log.png" style=" border-radius: 5% 0% 0% 5%; height:160px; width:460px"/><img src="log1.png" style=" border-radius: 0% 5% 5% 0% ; height:160px; width:740px"/></div>
<div id="go" style="border:2px solid; margin-top: 40px" >
  <a href="booklist.php"><button style="margin-top: 30px ;width: 100%;background-color: hsla(148,92%,49%,0.8);color: white;height: 50px;font-size: 30px">Books</button></a><br>
  <a href="authorlist.php"><button style=" margin-top:30px ; width: 100%;background-color: hsla(148,92%,49%,0.8); color: white;height: 50px;font-size: 30px">Author</button></a><br>
  <a href="publisherlist.php"><button style=" margin-top:30px ; width: 100%;background-color: hsla(148,92%,49%,0.8); color: white;height: 50px;font-size: 30px">Publishers</button></a><br>
  <a href="borrowerdata.php"><button style=" margin-top:30px ; width: 100%;background-color: hsla(148,92%,49%,0.8); color: white;height: 50px;font-size: 30px">Borrower</button></a>
  <br>
  <a href="placedat.php"><button style=" margin-top:30px ; width: 100%;background-color: hsla(148,92%,49%,0.8); color: white;height: 50px;font-size: 30px">Placing</button></a>
  <br>
  <a href="signout.php"><button style=" margin-top:30px ; width: 100%;background-color: blue; color: white;height: 50px;font-size: 30px">Logout</button></a>
  <br>
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