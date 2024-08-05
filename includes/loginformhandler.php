<?php

session_start();
 
include "connection.php";


if($_SERVER['REQUEST_METHOD'] == "POST")
{

    // Grabing login page input
    
    $regNo = strtoupper(htmlspecialchars($_POST["regNo"]));
    $department = htmlspecialchars($_POST["department"]);
    $pwd = $_POST["pwd"];
    $_SESSION["regNo"] = $regNo;
    $_SESSION["department"] = $department;

    if(empty($regNo) || empty($pwd))
    {
        header("Location: ../login.php");
    }
    else
    {
        $sql = "SELECT regNumber, pwd, nameInitial FROM $department WHERE regNumber = '$regNo';";
        $result = mysqli_query($conn, $sql);
        $noRows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if($noRows > 0)
        {
            if($row['regNumber'] == $regNo && password_verify($pwd, $row['pwd']))
            {
                header("Location: ../appoinment/index.php");
            }
            else
            {
                header("Location: ../login.php?login=incorrectpwd");
            }
        }
        else
        {
            header("Location: ../login.php?login=invalidregnumber");
        }

    }
    
}

?>