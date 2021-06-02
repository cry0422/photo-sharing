<html>

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="login.css" rel="stylesheet">
</head>

<body>
    <?php
    include("dbConnection.php");

    // register form
    echo "<div class=\"title\">";
    echo "<h1>New Account</h1>";
    echo "</div>";
    echo "<form action=\"#\" method=\"post\" class=\"loginForm\">";
    echo " <label> Email ";
    echo "      <input class=\"account\" type=\"text\" name=\"email\" placeholder=\"Email\"></input></label> <br>";
    echo " <label> Username ";
    echo "      <input class=\"account\" type=\"text\" name=\"username\" placeholder=\"Username\"></input></label> <br>";
    echo " <label> Password ";
    echo "      <input class=\"account\" type=\"password\" name=\"password\" placeholder=\"Password\"></input></label> <br>";
    echo " <label> Name ";
    echo "      <input class=\"account\" type=\"text\" name=\"name\" placeholder=\"Name\"></input></label> <br>";
    echo " <label>Gender:</label>";
    echo "      <input type=\"radio\" name=\"radio\" value=\"male\" >male";
    echo "      <input type=\"radio\" name=\"radio\" value=\"female\">female<br>";
    echo " <label> Personal Signature ";
    echo "      <textarea class=\"signature\" class=\"signature\" type=\"text\" name=\"signature\" placeholder=\"Signature\"></textarea></label> <br>";
    echo " <fieldset class=\"button\">";
    echo "      <input type=\"submit\" name=\"Register\" value=\"Register\"></input> ";
    echo "      <div class=\"line\"><span>or</span></div>";
    echo "      <p>Already have an account?</p>";
    echo "      <input type=\"submit\" name=\"login\" value=\"Login\"></input> <br>";
    echo " </fieldset>";
    echo " </form>";

    // register: get input information and add into database
    if (isset($_REQUEST["Register"])) {
        $nEmail = $_REQUEST["email"];
        $nUsername = $_REQUEST["username"];
        $nPassword = $_REQUEST["password"];
        $name = $_REQUEST["name"];
        $header = 'header.png';
        $gender = $_REQUEST["radio"];
        $signature = $_REQUEST["signature"];

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
                if (validUsername($nUsername, $dbUsername))
                {
                    echo "<script> alert('The username already exists！');parent.location.href='register.php'; </script>"; 
                }
            }
            $sql = "INSERT INTO account (username, password, email)
            VALUES ('$nUsername', '$nPassword', '$nEmail')";
            $sql2 = "INSERT INTO profile (username, name, gender, header, signature)
            VALUES ('$nUsername', '$name', '$gender', '$header', '$signature')";
            if ($mysqli->query($sql) === TRUE) {
                if ($mysqli->query($sql2) === TRUE){
                    echo "<script> alert('Create user successfully！Please login in');parent.location.href='login.php'; </script>"; 
                }else{
                    echo "Error: " . $sql2 . "<br>" . $mysqli->error;
                }
                
            }else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
            // close connection
            include("connectionClose.php");
        }
    }

    // login
    if (isset($_REQUEST["login"]))
    {
        header("location:login.php");
    }
    ?>
</body>

</html>

<?php
function validUsername($nUsername, $dbUsername)
{
    if ($nUsername == $dbUsername)
    {
        return true;
    }else{
        return false;
    }
}
?>