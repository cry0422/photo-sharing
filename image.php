<html>

<head>
    <meta charset="UTF-8">
    <title>Photo</title>
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
// get photo src
$src = $_GET['id'];
// $getPid = $_GET['pid'];
if ($_GET['id'] == null){
    $src = $_GET['src'];
}
// get like number
$result = mysqli_query($mysqli, "SELECT * FROM photo where photo='$src'");
$row = $result->fetch_assoc();
$likes = $row['likes'];
$dislikes = $row['dislikes'];
$button = $_GET['status'];
// like
if (isset($_GET['pid']) && $button == null){
    $likePid = $_GET['pid'];
    $result = mysqli_query($mysqli, "SELECT * FROM likes where pid='$likePid'");
    if ($result->num_rows === 0){
        $sql = "INSERT INTO likes (username, pid, likeORdislike)
        VALUES ('$username', '$likePid', 'like')";
        $likes += 1;
        $sql2 = "UPDATE photo SET likes='$likes' where photo_id='$likePid'";
        if ($mysqli->query($sql) === TRUE) {
            mysqli_query($mysqli, $sql2);
            echo "<script> location.href='image.php?id=$src'</script>";
                
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }else{
        $getlike = false;
        while ($row = $result->fetch_assoc()){
            if ($row['username'] == $username){
                $getlike = true;
                $status = $row['likeORdislike'];
                $likeId = $row['id'];
                if ($status == 'like'){
                    $sql1 = "DELETE FROM likes WHERE id='$likeId'";
                    $likes -= 1;
                    $sql2 = "UPDATE photo SET likes='$likes' where photo_id='$likePid'";
                    mysqli_query($mysqli, $sql1);
                    mysqli_query($mysqli, $sql2);
                    echo "<script>location.href='image.php?id=$src'</script>";
                }else{
                    echo "<script> alert('You can only dislike and like a photo one time!')</script>";
                }
            }
        }
        // if getlike = false, it means the user does not like or dislike this photo
        if ($getlike == false){
            $sql = "INSERT INTO likes (username, pid, likeORdislike)
            VALUES ('$username', '$likePid', 'like')";
            $likes += 1;
            $sql2 = "UPDATE photo SET likes='$likes' where photo_id='$likePid'";
            if ($mysqli->query($sql) === TRUE) {
                mysqli_query($mysqli, $sql2);
                echo "<script>location.href='image.php?id=$src'</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
    }
}

// dislike
if (isset($_GET['pid']) && $button != null){
    $likePid = $_GET['pid'];
    $result = mysqli_query($mysqli, "SELECT * FROM likes where pid='$likePid'");
    if ($result->num_rows === 0){
        $sql = "INSERT INTO likes (username, pid, likeORdislike)
        VALUES ('$username', '$likePid', 'dislike')";
        $dislikes += 1;
        $sql2 = "UPDATE photo SET dislikes='$dislikes' where photo_id='$likePid'";
        if ($mysqli->query($sql) === TRUE) {
            mysqli_query($mysqli, $sql2);
            echo "<script>location.href='image.php?id=$src'</script>";
                
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }else{
        $getDislike = false;
        while ($row = $result->fetch_assoc()){
            if ($row['username'] == $username){
                $getDislike = true;
                $status = $row['likeORdislike'];
                $likeId = $row['id'];
                if ($status == 'dislike'){
                    $sql1 = "DELETE FROM likes WHERE id='$likeId'";
                    $dislikes -= 1;
                    $sql2 = "UPDATE photo SET dislikes='$dislikes' where photo_id='$likePid'";
                    mysqli_query($mysqli, $sql1);
                    mysqli_query($mysqli, $sql2);
                    echo "<script>location.href='image.php?id=$src'</script>";
                }else{
                    echo "<script> alert('You can only like and dislike a photo one time!')</script>";
                }
            }
        }
        // if getDislike = false, it means the user does not dislike this photo
        if ($getDislike == false){
            $sql = "INSERT INTO likes (username, pid, likeORdislike)
            VALUES ('$username', '$likePid', 'dislike')";
            $dislikes += 1;
            $sql2 = "UPDATE photo SET dislikes='$dislikes' where photo_id='$likePid'";
            if ($mysqli->query($sql) === TRUE) {
                mysqli_query($mysqli, $sql2);
                echo "<script>location.href='image.php?id=$src'</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
    }
}
// add comments into database
if (isset($_REQUEST['comment'])){
    if ($_REQUEST['comments'] != null){
        $addComment = $_REQUEST['comments'];
        $nPostTime = date("Y-m-d H:i:s", time());
        $sql = "INSERT INTO comments (username, photo, time, comment)
        VALUES ('$username', '$src', '$nPostTime', '$addComment')";
        if ($mysqli->query($sql) === TRUE) {
            echo "<script> alert('comment successfully!')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
    else{
        echo "<script>alert('please type comments！')</script>";
    }
}
// photo review
$result = mysqli_query($mysqli, "SELECT * FROM photo where photo='$src'");
while ($row = $result->fetch_assoc()) 
{
    $persN = $row['username'];
    $likes = $row['likes'];
    $dislikes = $row['dislikes'];
    $time = $row['time'];
    $tags = $row['tags'];
    $pid = $row['photo_id'];
    $check = false;
    $display = $row['type'];
    $description = $row['description'];
    $res = explode("#", $tags);
    if ($display == 'landscape'){
        echo "<div class=\"postedPhoto\">";
        echo "<img class=\"photo\" src=\"uploads/$src\" alt=\"$src\"</img><br>";
    }else{
        echo "<div class=\"postedPhoto1\">";
        echo "<img class=\"photo_trans\" src=\"uploads/$src\" alt=\"$src\"</img><br>";
    }
    echo "<div class=\"bar\">";
    echo "<h1 class=\"poster\"> $persN </h1>";
    foreach ($res as $tag){
        if ($tag != null){
            echo "<a href=\"homepage.php?tag=$tag\"><p class=\"tagshow\"> #$tag </p></a>";
        }
    }
    echo "<div class=\"imgblank\"></div>";
    //check like and dislike
    $result1 = mysqli_query($mysqli, "SELECT * FROM likes where username='$username'");
    while ($row1 = $result1->fetch_assoc()){
        $likedPic = $row1['pid'];
        $status = $row1['likeORdislike'];
        if ($likedPic == $pid){
            $check = true;
            if ($status == 'like'){
                echo "<a href=\"image.php?pid=$pid&src=$src\"><img class=\"likes\" src=\"images/like_clicked.png\" alt=\"likes\"></a>";
                echo "<p class=\"likeNum\">$likes</p>";
                echo "<a href=\"image.php?pid=$pid&src=$src&status=dislike\"><img class=\"dislikes\" src=\"images/dislike.png\" alt=\"dislikes\"></a>";
                echo "<p class=\"likeNum\">$dislikes</p>";
            }else{
                echo "<a href=\"image.php?pid=$pid&src=$src\"><img class=\"likes\" src=\"images/like.png\" alt=\"likes\"></a>";
                echo "<p class=\"likeNum\">$likes</p>";
                echo "<a href=\"image.php?pid=$pid&src=$src&status=dislike\"><img class=\"dislikes\" src=\"images/dislike_clicked.png\" alt=\"dislikes\"></a>";
                echo "<p class=\"likeNum\">$dislikes</p>";
            }
        }
    }
    if (!$check){
        echo "<a href=\"image.php?pid=$pid&src=$src\"><img class=\"likes\" src=\"images/like.png\" alt=\"likes\"></a>";
        echo "<p class=\"likeNum\">$likes</p>";
        echo "<a href=\"image.php?pid=$pid&src=$src&status=dislike\"><img class=\"dislikes\" src=\"images/dislike.png\" alt=\"dislikes\"></a>";
        echo "<p class=\"likeNum\">$dislikes</p>";
    }
    echo "</div>";
    echo "<p class=\"description\"> Description : $description </p>";
    echo "<p class=\"time\"> $time </p>";
    echo "</div>";
}
echo "<div class=\"line\"><span class=\"photoSpan\">comments</span></div>";
// get comments
$result1 = mysqli_query($mysqli, "SELECT * FROM comments where photo='$src'");
while ($row1 = $result1->fetch_assoc()) {
    $comPerson = $row1['username'];
    $postTime = $row1['time'];
    $comment = $row1['comment'];
    echo "<div class=\"comments\">";
    echo "<h1 class=\"comPerson\"> $comPerson: </h1>";
    echo "<p class=\"comment\"> &nbsp;&nbsp;&nbsp;&nbsp;$comment </p>";
    echo "<p class=\"postTime\"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$postTime </p>";
    echo "<div class=\"comline\"></div>";
    echo "</div>";
}

// add comments
echo "<form action=\"#\" method=\"post\" class=\"commentForm\">";
echo " <textarea class=\"addCom\" type=\"text\" name=\"comments\" placeholder=\"Add Comments\"></textarea>";
echo " <fieldset class=\"button\">";
echo "      <input type=\"submit\" name=\"comment\" value=\"Send\"></input>";
echo " </fieldset>";
echo " </form>";

include("connectionClose.php");
include("footer.php");
?>
</body>
</html>