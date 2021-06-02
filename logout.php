<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="login.css" rel="stylesheet">
</head>

<body>
<?php 
// start session
 session_start(); 
 //clear session 
 $username=$_SESSION['username']; 
 $_SESSION=array(); 
 session_destroy(); 
 echo "<div class=\"titleOut\">";
 echo "<h1> $username, welcome back! </h1>"; 
 echo "<a href='login.php'>Relogin</a>"; 
 echo "</div>";
?>
</body>
</html>