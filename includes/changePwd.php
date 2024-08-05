<?php

session_start();
 
include "connection.php";

if(!isset($_SESSION['regNo']))
{
	header("Location: home.php");
}

$regNo = $_SESSION["regNo"];
$department = $_SESSION["department"];

$findRegNo = "SELECT pwd FROM $department WHERE regNumber = '$regNo';";
$result = mysqli_query($conn, $findRegNo);
$noRows = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

$pwd = $row['pwd'];

if($noRows < 1)
{
    header("Location: ../changePwd.php");
}


if($_SERVER['REQUEST_METHOD'] == "POST")
{

    // Grabing inputs

    $cpwd = $_POST["cpwd"];
    $npwd = $_POST["npwd"];
    $cnpwd = $_POST["cnpwd"];

    if(empty($cpwd) || empty($npwd) || empty($cnpwd))
    {
        header("Location: ../changePwd.php?pwd=emptyInput");
    }
    else if(!(password_verify($cpwd, $pwd)))
    {
        header("Location: ../changePwd.php?pwd=wrongcpwd");
    }
    else if(strlen($npwd)<8)
    {
        header("Location: ../signup.php?pwd=pwdlength");
    }
    else if(!($npwd == $cnpwd))
    {
        header("Location: ../signup.php?pwd=pwdmismatched");
    }
    else
    {
        $hpwd = password_hash($npwd, PASSWORD_DEFAULT);
        $sql = "UPDATE $department SET pwd='$hpwd' WHERE regNumber = '$regNo';";

        mysqli_query($conn, $sql);

        header("Location: ../user.php");
    }


}

?>