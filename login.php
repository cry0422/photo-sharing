<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="login.css" rel="stylesheet">
</head>

<body>
    <div class="title">
        <h1>Photo Share</h1>
    </div>
    <?php
    include("dbConnection.php");
    // 开启session
    session_start();
    // login form
    echo "<form action=\"#\" method=\"post\" class=\"loginForm\">";
    echo " <label> Username ";
    echo "      <input class=\"account\" type=\"text\" name=\"username\" placeholder=\"Username\"></input></label> <br>";
    echo " <label> Password ";
    echo "      <input class=\"account\" type=\"password\" name=\"password\" placeholder=\"Password\"></input></label> ";
    echo " <fieldset class=\"button\">";
    echo "      <input type=\"submit\" name=\"login\" value=\"Login\"></input> <br>";
    echo "      <div class=\"line\"><span>or</span></div>";
    echo "      <p>No account?</p>";
    echo "      <input type=\"submit\" name=\"Register\" value=\"Register\"></input> ";
    echo " </fieldset>";
    echo " </form>";

    // login: get username and password input 
    if (isset($_REQUEST["login"])) {
        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        // Prepare and run query
        $runQ = "Select * from account";
        if (!$result = $mysqli->query($runQ)) {
            echo "SQL Query Error!";
        }

        // Process result
        if ($result->num_rows === 0){
            echo "<p> Nothing returned. </p>";
        }
        else{
            while ($row = $result->fetch_assoc()){
                $dbUsername = $row['username'];
                $dbPassword = $row['password'];
                if (checkUser($username, $password, $dbUsername, $dbPassword))
                {
                    $_SESSION['username'] = $row['username'];
                    // print $_SESSION['username'];
                    header("location:homepage.php");
                }
            }
            echo "<script>alert('username or password error！')</script>";
            // echo "<script> alert('用户名已存在！');parent.location.href='register.php'; </script>"; 
        }

        // close connection
        include("connectionClose.php");
    }

    // register: create new account
    if (isset($_REQUEST["Register"]))
    {
        header("location:register.php");
    }

    ?>
</body>

</html>

<?php
function checkUser($username, $password, $dbUsername, $dbPassword){
    if ($username == $dbUsername && $password == $dbPassword)
    {
        return true;
    }
    else
    {
        return false;
    }
}
?>