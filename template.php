<?php 

include("dbconnect.php");

$userid=$_REQUEST["userid"]; //this is the userid of the user currently logged in
$username="Username"; //$_REQUEST["username"] - this is the username of the user currently logged in

/*$query="select Name from users where userid=$userid";
$result=mysqli_query($conn,$query);
$resultforusername=mysqli_fetch_assoc($result);*/

$query="select userid,Name,SYSDATE()-statuschangetime as timeelapsed,DATE_FORMAT(statuschangetime, '%d %M %Y | %h:%i %p') as time from enlighten inner join users where acceptorid=userid and requestorid=$userid and status='accepted' order by timeelapsed limit 50";
$result=mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<title>Axel - Dashboard</title>
<!--<link rel="stylesheet" href="home.css"> -->
<link rel="stylesheet" href="template.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link rel="icon" href="logo.png">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- jQuery UI library 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->

<link rel="stylesheet" href = "search.css"> 
<script src="search.js" type="text/javascript"></script>

<script type="text/javascript">

var isopen=0;

function opennotiholder()
{
  if(isopen==0)
  {
    document.getElementById("notiholder").style.visibility="visible";
    document.getElementById("notiholder").style.height="400px";
    document.getElementById("notiholder").style.opacity="1";
    /*document.getElementById("round").style.visibility="hidden";*/
    isopen=1;
  }

  else
  {
    document.getElementById("notiholder").style.visibility="hidden";
    document.getElementById("notiholder").style.height="0";
    document.getElementById("notiholder").style.opacity="0.5";
    isopen=0;
  }
}

</script>
</head>


<body>

<div id="overlay" onclick="closesearch()"></div>

<div id="notiholder">

<?php 
if($count==0)
{
?>
<div id="nonoti" style="margin-top:20px">No notifications!</div>
<?php
}
else
{
while($row=mysqli_fetch_assoc($result))
{ ?>

<div class="notibox">

You were enlightened by <?php echo $row["Name"]."!" ?>
<div class="notitime"><?php echo $row["time"] ?></div>

</div>

<?php 
}
} ?>

</div>


<div id="header"> <!--fixed header-->

<div id="logoholder">
<img id="logo" src="logo.png" height="42px" width="41px" alt="logo">
<div id="title">AXEL</div>
</div>

<div id="otherholder">

<!--<input id="searchbar" type="text" placeholder="Search for startups,mentors and people" spellcheck="false">
<img src="search.png" id="searchicon" alt="search">-->

<div class="searchbox">
            <input id="searchtext" type="text" autocomplete="off" spellCheck="false" placeholder="Search for startups,mentors and people">
            <a class="searchbtn" href="#">
            <img id="searchicon" src="search.png" alt="defaultimgholder.png"></a>
            <div class="searchlist">  
            </div>
</div>

<div id="userdetails">
    <img id="noti" src="notification.png" onclick="opennotiholder()"> <!--<div id="round"></div>-->
    <img id="userdp" src="avatar.png">
</div>

</div>

</div>

<div id="dashboard">

<div id="sidenavbar">
    <!--<div id="dummy"></div>-->
    <a href="dashboard.php?userid=<?php echo $userid ?>">Dashboard</a>
    <a href="#">My Profile</a>
    <a href="#">Explore</a>
    <a href="#">Connect</a>
    <a href="#">News</a>
    <a href="#">Polls</a>
    <a href="#">Contests</a>
    <!--<div id="dummy"></div>-->
</div>

<?php
$query="select puserid,postid,Name, DATE_FORMAT(createdtime,'%d %M %Y | %h:%i %p') as createdtime, Announcement FROM post inner join users WHERE users.userID=post.PuserID and PuserID in (select AcceptorID from enlighten where requestorid=$userid and status='accepted') order by createdtime desc";
$result=mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
$temp=0;
?>


<div id="maindash">

<!--ALL OF YOUR CODE MUST GO HERE-->

</div>

</div>

<script type="text/javascript">

function closesearch()
{
    document.getElementById("overlay").style.opacity="0";
    document.getElementById("overlay").style.zIndex="-1"; 
    /*$('.searchlist').fadeOut();*/
    $('.searchlist').css("visibility","hidden"); 
}
</script>

<script src="dashboard.js" type="text/javascript"></script>

</body>
</html>