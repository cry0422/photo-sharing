<html>

<head>
    <meta charset="UTF-8">
    <title>Photo adding</title>
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
// html
echo "<div class=\"addphoto\">";
echo "<h1>Photo adding</h1>";
echo "<form action=\"#\" method=\"post\" class=\"photoAddForm\" “ enctype=\"multipart/form-data\">";
echo "      <input class=\"fileselect\" type=\"file\" name=\"chooseFile\" value=\"\" onchange=\"showImg(this)\"></input><br>";
echo "      <img id=\"preview\" alt=\"photo to be added\" src=\"images/defalutPhoto.jpeg\">";
echo "<div class=\"line\"><span>photo details</span></div>";
echo " <fieldset class=\"select\">";
echo "      <label>Display:</label>";
echo "      <input type=\"radio\" name=\"radio\" value=\"landscape\">landscape";
echo "      <input type=\"radio\" name=\"radio\" value=\"portrait\">portrait";
echo " </fieldset>";
echo " <label> Description";
echo "      <textarea class=\"signature\" type=\"text\" name=\"description\" placeholder=\"description\"></textarea></label>";
echo " <fieldset class=\"alltags\">";
echo " <label> #Tags&nbsp; (up to 4):&nbsp;  1.";
echo "      <input class=\"tags\" type=\"text\" name=\"tag1\" placeholder=\"tag\"></input></label>";
echo " <label>2.";
echo "      <input class=\"tags\" type=\"text\" name=\"tag2\" placeholder=\"tag\"></input></label>";
echo " <label>3.";
echo "      <input class=\"tags\" type=\"text\" name=\"tag3\" placeholder=\"tag\"></input></label>";
echo " <label>4.";
echo "      <input class=\"tags\" type=\"text\" name=\"tag4\" placeholder=\"tag\"></input></label>";
echo " </fieldset>";
echo " <fieldset class=\"button\">";
echo "      <input type=\"submit\" name=\"post\" value=\"Post\"></input>";
echo " </fieldset>";
echo " </form>";
echo "</div>";
if (isset($_REQUEST["post"])) {
    // check if uploaded file is jpg or png
    $file_ext = strtolower(end(explode('.', $_FILES['chooseFile']['name'])));
    $extensions = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $extensions) === false) {
        echo "extension not allowed, please choose a JPEG or PNG file.";
    } else {
        $likes = 0;
        $dislikes = 0;
        $tags = checkTag($_REQUEST["tag1"]).checkTag($_REQUEST["tag2"]).checkTag($_REQUEST["tag3"]).checkTag($_REQUEST["tag4"]);
        echo $tags;
        $type = $_REQUEST["radio"];
        $description = $_REQUEST["description"];
        $postTime = date("Y-m-d H:i:s", time());
        $username = $_SESSION['username'];
        $tempFile = $_FILES['chooseFile']['tmp_name'];
        $actFile = $_FILES['chooseFile']['name'];
        $sizeFile = $_FILES['chooseFile']['size'];
        $typeFile = $_FILES['chooseFile']['type'];
        $errorFile = $_FILES['chooseFile']['error'];
        // upload to folder
        $folder = "uploads/" . $actFile;
        move_uploaded_file($tempFile, $folder);

        // add photo into database
        $sql = "INSERT INTO photo (username, photo, time, likes, tags, type, dislikes, description) VALUES 
        ('$username','$actFile', '$postTime', '$likes', '$tags','$type', '$dislikes', '$description')";

        // execute query 
        if ($mysqli->query($sql) === TRUE) {
            echo "<script> alert('photo upload successfully'); location.href = \"homepage.php\"</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}
include("connectionClose.php");
include("footer.php");
?>

<?php
  function checkTag($tag){
      if ($tag == null){
          return '';
      }else{
          return '#'.$tag;    
      }
  }
?>
</body>
</html>