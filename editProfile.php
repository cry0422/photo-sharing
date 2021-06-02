<html>

<head>
    <meta charset="UTF-8">
    <title>Profile edit</title>
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
// query database
$result = mysqli_query($mysqli, "SELECT * FROM profile where username='$username'");
while ($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $personalSignature = $row['signature'];
    $header = $row['header'];
    $gender = $row['gender'];
}
// html
echo "<div class=\"addphoto\">";
echo "<h1>Profile edit</h1>";
echo "<form action=\"#\" method=\"post\" class=\"profileAddForm\" “ enctype=\"multipart/form-data\">";
echo "      <input class=\"fileselect\" type=\"file\" name=\"chooseFile\" value=\"\" onchange=\"showImg(this)\"></input><br>";
echo "      <img id=\"preview\" alt=\"profile photo to be added\" src=\"profilePhotos/$header\">";
echo "<div class=\"line\"><span>profile details</span></div>";
echo " <label>Name:&nbsp;";
echo "      <input class=\"name\" type=\"text\" name=\"realname\" value=\"$name\"></input></label>";
if ($gender == 'male')
{
echo " <fieldset class=\"select\">";
echo "      <label>Gender:</label>";
echo "      <input type=\"radio\" name=\"radio\" value=\"male\" checked=\"true\">male";
echo "      <input type=\"radio\" name=\"radio\" value=\"female\">female";
echo " </fieldset>";   
}
else{
    echo " <fieldset class=\"select\">";
    echo "      <label>Gender:</label>";
    echo "      <input type=\"radio\" name=\"radio\" value=\"male\" >male";
    echo "      <input type=\"radio\" name=\"radio\" value=\"female\" checked=\"true\">female";
    echo " </fieldset>"; 
}
echo " <fieldset class=\"alltags\">";
echo " <label> Personal Signature:&nbsp;";
echo "      <textarea class=\"signature\" type=\"text\" name=\"signature\">$personalSignature</textarea></label>";
echo " </fieldset>";
echo " <fieldset class=\"button\">";
echo "      <input type=\"submit\" name=\"Save\" value=\"Save\"></input>";
echo " </fieldset>";
echo " </form>";
echo "</div>";

if (isset($_REQUEST["Save"])) {
    // check if user does not modify profile photo
    if ($_FILES['chooseFile']['tmp_name'] == null)
    {
        $nName = $_REQUEST["realname"];
        $nGender = $_REQUEST["radio"];
        $nSignature = $_REQUEST["signature"];

        // add update into database
        $sql = "UPDATE profile SET name='$nName', gender='$nGender', signature='$nSignature' where username='$username'";

        // execute query 
        if ($mysqli->query($sql) === TRUE) {
            echo "<script> alert('profile modify successfully'); location.href = \"profile.php\"</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
    // check if uploaded profile photo is jpg or png
    $file_ext = strtolower(end(explode('.', $_FILES['chooseFile']['name'])));
    $extensions = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $extensions) === false) {
        echo "extension not allowed, please choose a JPEG or PNG file.";
    } else {
        $nName = $_REQUEST["realname"];
        $nGender = $_REQUEST["radio"];
        $nSignature = $_REQUEST["signature"];
        $tempFile = $_FILES['chooseFile']['tmp_name'];
        $actFile = $_FILES['chooseFile']['name'];
        $sizeFile = $_FILES['chooseFile']['size'];
        $typeFile = $_FILES['chooseFile']['type'];
        $errorFile = $_FILES['chooseFile']['error'];
        // upload to folder
        $folder = "profilePhotos/" . $actFile;
        move_uploaded_file($tempFile, $folder);

        

        // add photo into database
        $sql = "UPDATE profile SET name='$nName', gender='$nGender', signature='$nSignature', header='$actFile' where username='$username'";

        // execute query 
        if ($mysqli->query($sql) === TRUE) {
            echo "<script> alert('profile modify successfully'); location.href = \"profile.php\"</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}
include("connectionClose.php");
include("footer.php");
?>

</body>
</html>