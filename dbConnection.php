<?php
    // Open a connection to the database and check connection
    $connUN = "Ruiyang.Chen20";
    $connPW = "kml5400";
    $connDB = "ruiyang.chen20";
    $connIP = "10.7.126.15";
    $mysqli = @(new mysqli($connIP, $connUN, $connPW, $connDB));
    if ($mysqli->connect_errno) {
        echo "Error: Failed to make a MySQL connection: <br/>";
        echo "Errno: " . $mysqli->connect_errno . "<br/>";
        echo "Error: " . $mysqli->connect_error . "<br/>";
        echo "<p> Sorry, this website is experiencing problems. </p>";
        exit;
    }
?>