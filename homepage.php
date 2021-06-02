<html>

<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <script type="text/javascript" src="mainPage.js"></script>
    <link href="pageStyle.css" rel="stylesheet" charset="utf-8>
</head>

<body>
<?php
error_reporting(0);
include("topPage.php");
include("dbConnection.php");
// 开启Session
session_start();
$username = $_SESSION['username'];
$searchTag = $_SESSION['searchTag'];
echo "<div class=\"welcome\"><h1>Welcome,&nbsp;$username!</h1></div>";
$result = mysqli_query($mysqli, "SELECT * FROM photo");
$result1 = mysqli_query($mysqli, "SELECT * FROM likes where username='$username'");
// get tag from the clickable tag in image.php 
if ($_GET['tag']){
    $searchTag = $_GET['tag'];
}
if (isset($_REQUEST['searchTag'])){
    $searchTag = $search;
}
// check if search 
if ($searchTag == null){
    while ($row = $result->fetch_assoc()) {
        $fileN = $row['photo'];
        $persN = $row['username'];
        $likes = $row['likes'];
        $time = $row['time'];
        $pid = $row['photo_id'];
        $display = $row['type'];
        $description = $row['description'];
        if ($display == 'landscape'){
            echo "<div class=\"postedPhoto\">";
            echo "<a href=\"image.php?id=$fileN\"><img class=\"photo\" src=\"uploads/$fileN\" alt=\"$fileN\"</img></a><br>";
        }else{
            echo "<div class=\"postedPhoto1\">";
            echo "<a href=\"image.php?id=$fileN\"><img class=\"photo_trans\" src=\"uploads/$fileN\" alt=\"$fileN\"</img></a><br>";
        }
        echo "<div class=\"bar\">";
        echo "<h1 class=\"poster\"> $persN </h1><br>";
        echo "</div>";
        echo "<p class=\"description\"> Description : $description </p>";
        echo "<p class=\"time\"> $time</p>";
        echo "</div>";
    }
}
else{
    $exist = false;
    while ($row = $result->fetch_assoc()) {
        $tags = $row['tags'];
        $res = explode("#", $tags);
        foreach ($res as $tag){
            if ($searchTag == $tag){
                $fileN = $row['photo'];
                $persN = $row['username'];
                $likes = $row['likes'];
                $time = $row['time'];
                $display = $row['type'];
                $description = $row['description'];
                if ($display == 'landscape'){
                    echo "<div class=\"postedPhoto\">";
                    echo "<a href=\"image.php?id=$fileN\"><img class=\"photo\" src=\"uploads/$fileN\" alt=\"$fileN\"</img></a><br>";
                }else{
                    echo "<div class=\"postedPhoto1\">";
                    echo "<a href=\"image.php?id=$fileN\"><img class=\"photo_trans\" src=\"uploads/$fileN\" alt=\"$fileN\"</img></a><br>";
                }
                echo "<div class=\"bar\">";
                echo "<h1 class=\"poster\"> $persN </h1>";
                echo "</div>";
                echo "<p class=\"description\"> Description : $description </p>";
                echo "<p class=\"time\"> $time</p>";
                echo "</div>";
                $exist = true;
            }
        }
    }
    if (!$exist){
        $_SESSION['searchTag'] = null;
        echo "<script>alert('The photo includes the tag \"$searchTag\" does not exist！'); location.href='homepage.php'</script>";
    }
    $_SESSION['searchTag'] = null;   
}
include("connectionClose.php");
include("footer.php");
?>
</body>
</html>