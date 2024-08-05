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
        header("Location: ../studentRemarks.php");
    }
    else
    {
        $regNo = $_SESSION["regNo"];
        $addRemark = "INSERT INTO $regNo VALUES ('$date', '$remark');";
        mysqli_query($conn, $addRemark);
        header("Location: ../studentRemarks.php");
    }

}
else if(isset($_GET['dates']))
{
    $regNo = $_SESSION["regNo"];
    $dates = $_GET['dates'];
    $remarks = $_GET['remarks'];

    $removeRemark = "DELETE FROM $regNo WHERE dates = '$dates' AND remarks = '$remarks';";
    mysqli_query($conn, $removeRemark);
    header("Location: ../studentRemarks.php");
}

?>