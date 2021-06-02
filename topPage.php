<html>

<head>
    <meta charset="UTF-8">
    <title>TOP PAGE</title>
    <link href="top_footer.css" rel="stylesheet">
</head>

<body>
    <?php
    error_reporting(0);
    include("dbConnection.php");
    // 开启Session
    session_start();
    $username = $_SESSION['username'];
    // logo
    echo "<header class=\"menu\">";
    echo "<div class=\"logo\">";
    echo "<a href=\"homepage.php\"><h1>Photo Share</h1></a>";
    echo "</div>";
    // search bar
    echo "<div class=\"searchPart\">";
    echo "<form action=\"#\" method=\"post\" class=\"searchBar\">";
    echo "  <input class=\"search\" type=\"text\" name=\"search\" placeholder=\"Search\"></input></label>";
    echo "  <input class=\"searchButton\" type=\"submit\" name=\"searchUser\" value=\"search user\"></input> ";
    echo "  <input class=\"searchButton\" type=\"submit\" name=\"searchTag\" value=\"search tag\"></input> ";
    echo " </form>";
    echo "</div>";
    // menu
    echo "<div class=\"buttonBar\">";
    echo "<div class=\"blank\"></div>";
    echo "<a href=\"homepage.php\">";
    echo "  <img class=\"home\" src=\"images/HOME.png\" alt=\"home\">";
    echo "</a>";
    echo "<div></div>";
    echo "<a href=\"addPhoto.php\">";
    echo    "<img class=\"addPicture\" src=\"images/add_image.png\" alt=\"share photo\">";
    echo "</a>";
    echo "<div></div>";
    echo "<a href=\"profile.php\">";
    echo    "<img class=\"profile\" src=\"images/PROFILE.png\" alt=\"profile\">";
    echo "</a>";
    echo "<div></div>";
    echo "<a href=\"logout.php\" id=\"logout\">";
    echo    "<img class=\"logout\" src=\"images/logout.png\" alt=\"logout\">";
    echo "</a>";
    echo "</div>";
    echo "</header>";

    if ($_REQUEST['search'] != null)
    {
        $search = $_REQUEST['search'];
        if (isset($_REQUEST['searchUser'])){
            $result = mysqli_query($mysqli, "SELECT * FROM account where username='$search'");
            if ($result->num_rows === 0){
                echo "<script>alert('The User \"$search\" does not exist！'); location.href='homepage.php'</script>";
            }
            else{
                $_SESSION['searchUser'] = $search;
                header("location:userHome.php");
            }
        }
        if (isset($_REQUEST['searchTag'])){
            $_SESSION['searchTag'] = $search;
        }
    }
    include("connectionClose.php");
    ?>
</body>

</html>