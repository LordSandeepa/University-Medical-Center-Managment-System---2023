<?php

session_start();
 
include "connection.php";


if($_SERVER['REQUEST_METHOD'] == "POST")
{

    // Grabing login page input
    
    $user = htmlspecialchars($_POST["user"]);
    $pwd = $_POST["pwd"];

    if(empty($user) || empty($pwd))
    {
        header("Location: ../adminLogin.php?login=fillAll");
        exit();
    }
    else
    {
        $sql = "SELECT users, pwd FROM admins WHERE users = '$user';";
        $result = mysqli_query($conn, $sql);
        $noRows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if($noRows > 0)
        {
            if($row['users'] == $user && password_verify($pwd, $row['pwd']))
            {
                $_SESSION['adminUsername'] = $user;
                header("Location: ../adminHome.php");
                exit();
            }
            else
            {
                header("Location: ../adminLogin.php?login=incorrectpwd");
                exit();
            }
        }
        else
        {
            header("Location: ../adminLogin.php?login=invalidUsername");
            exit();
        }

    }
    
}

?>