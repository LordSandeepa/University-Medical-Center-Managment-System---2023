<?php

session_start();
 
include "connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    // Grabing remark input

    $date = ($_POST["date"]);
    $remark = htmlspecialchars($_POST["remark"]);

    if(empty($date) || empty($remark))
    {
        header("Location: ../remark.php");
    }
    else
    {
        $regNo = $_SESSION["regNo"];
        $addRemark = "INSERT INTO $regNo VALUES ('$date', '$remark');";
        mysqli_query($conn, $addRemark);
        header("Location: ../remarks.php");
    }

}

?>