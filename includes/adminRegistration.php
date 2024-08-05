<?php

session_start();
 
include "connection.php";


if($_SERVER['REQUEST_METHOD'] == "POST")
{

    // Grabing login page input
    
    $user = htmlspecialchars($_POST["user"]);
    $pwd = $_POST["pwd"];
    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);

    $find = "SELECT * FROM admins WHERE users = '$user';";
    $result = mysqli_query($conn, $find);
    $noRows = mysqli_num_rows($result);

    if(empty($user) || empty($pwd))
    {
        header("Location: ../adminRegistration.php?register=fillAll");
        exit();
    }
    else if($noRows > 0)
    {
        header("Location: ../adminRegistration.php?register=invalidUsername");
        exit();
    }
    else
    {
        $sql = "INSERT INTO admins () VALUES ('$user', '$hashpwd');";
        mysqli_query($conn, $sql);
        header("Location: ../adminRegistration.php");
    }
    
}

?>