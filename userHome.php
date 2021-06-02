<html>

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link href="pageStyle.css" rel="stylesheet" charset="utf-8>
</head>

<body>
<?php
error_reporting(0);
include("topPage.php");
include("dbConnection.php");
// 开启Session
session_start();
$username = $_SESSION['searchUser'];
if ($username != null)
{
        $result1 = mysqli_query($mysqli, "SELECT * FROM profile where username='$username'");
    while ($row1 = $result1->fetch_assoc()) {
        $name = $row1['name'];
        $personalSignature = $row1['signature'];
        $header = $row1['header'];
    }
    echo "<div class=\"profileBar\">";
    echo "<div class=\"profile_header\">";
    echo "<img class=\"profile_photo\" src=\"profilePhotos/$header\">";
    echo "</div>";
    echo "<div class=\"profile_details\">";
    echo "<h1>$username</h1>";
    echo "<h2>$name</h2>";
    echo "<p>$personalSignature</p>";
    echo "<form action=\"#\" method=\"post\">";
    // echo "<input type=\"submit\" name=\"editProfile\" value=\"Edit Profile\"></input> ";
    echo " </form>";
    echo "</div>";
    echo "</div>";
    echo "<div class=\"line\"><span class=\"photoSpan\">own photos</span></div>";
    //posted photo
    $result = mysqli_query($mysqli, "SELECT * FROM photo where username='$username'");
    while ($row = $result->fetch_assoc()) {
        $fileN = $row['photo'];
        $persN = $row['username'];
        $likes = $row['likes'];
        $time = $row['time'];
        $display = $row['type'];
        if ($display == 'landscape'){
            echo "<div class=\"postedPhoto\">";
            echo "<a href=\"image.php?id=$fileN\"><img class=\"photo\" src=\"uploads/$fileN\" alt=\"$fileN\"</img></a><br>";
        }else{
            echo "<div class=\"postedPhoto1\">";
            echo "<a href=\"image.php?id=$fileN\"><img class=\"photo_trans\" src=\"uploads/$fileN\" alt=\"$fileN\"</img></a><br>";
        }
        echo "<div class=\"bar\">";
        echo "<h1> $persN </h1>";
        echo "</div>";
        echo "<p class=\"time\"> $time</p>";
        echo "</div>";
    }
    // $_SESSION['searchUser'] = null;
}


include("connectionClose.php");
include("footer.php");

?>
</body>
</html>