<?php

session_start();
 
include "connection.php";


if($_SERVER['REQUEST_METHOD'] == "POST")
{

    // Grabing signup page input

    $regNo = htmlspecialchars(strtoupper($_POST["regNo"]));
    $department = htmlspecialchars($_POST["department"]);
    $batch = htmlspecialchars($_POST["batch"]);
    $email = htmlspecialchars($_POST["email"]);
    $pwd = $_POST["pwd"];
    $pwdc = $_POST["pwdc"];

    // Adding data to session

    $_SESSION["regNo"] = $regNo;
    $_SESSION["department"] = $department;
    $_SESSION["batch"] = $batch;
    $_SESSION["email"] = $email;
    $_SESSION["pwd"] = $pwd;


    if(empty($regNo) || empty($department) || empty($batch) || empty($email) || empty($pwd))
    {
        header("Location: ../signup.php?signup=emptyInput");
    }
    else if(strlen($pwd)<8)
    {
        header("Location: ../signup.php?signup=pwdlength");
    }
    else if(!($pwd == $pwdc))
    {
        header("Location: ../signup.php?signup=pwdmismatched");
    }
    else
    {
        $findRegNo = "SELECT regNumber, department FROM $department WHERE regNumber = '$regNo';";
        $result = mysqli_query($conn, $findRegNo);
        $noRows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

    // Check for the given registration number is valid one and already signup one for the system

        if($noRows > 0 && ($row['regNumber'] == $regNo && !empty($row['department'])))
        {
            header("Location: ../login.php?login=alreadySigned");
        }
        else if($noRows > 0 && ($row['regNumber'] == $regNo && empty($row['department'])))
        {
            header("Location: ../enrollment.php");
        }
        else
        {
            header("Location: ../signup.php?signup=invalidRegNo");
        }
    }


}

?>