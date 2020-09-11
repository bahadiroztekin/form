<?php

if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $connection = mysqli_connect("localhost","root", "", "loginapp");

    /* if ($connection) {
        echo "Database connected" . "<br>";
    }
    else
        die("Database connection failed");
    */

    $sql_u = "SELECT * FROM users WHERE username='$username'";
    $res_u = mysqli_query($connection, $sql_u);

    if (mysqli_num_rows($res_u) > 0) {
        echo "Sorry... username already taken";
    }
    else {
        switch ($username) {
            case strlen($username) < 5:
                echo "Username has to be longer than 5." . "<br>";
                break;
            case strlen($username) > 12:
                echo "Username has to be less than 12." . "<br>";
                break;
            default:
                echo "Welcome to our site " . $username . " !" . "<br>";
        }

        switch ($password) {
            case strlen($password) < 6:
                echo "Your password is too short " . "<br>";
                break;
            default:
                if (5 < strlen($username) and strlen($username) < 12) {
                    echo "Your password: " . $password . "<br>";
                    $query = "INSERT INTO users(username, password) ";
                    $query .= "VALUES ('$username', '$password')";

                    $res_i = mysqli_query($connection, $query);
                    if (!$res_i) {
                        die("Server not found " . mysqli_error());
                    }
                }
        }
    }
}
?>
