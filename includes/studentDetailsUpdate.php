<?php

session_start();

include "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    //  Insert and Update students informations

    $regNo = htmlspecialchars($_POST["regNo"]);
    $department = htmlspecialchars($_POST["department"]);
    $batch = htmlspecialchars($_POST["batch"]);
    $email = htmlspecialchars($_POST["email"]);
    //$pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
    $nic = htmlspecialchars($_POST['nic']);
    $faculty = htmlspecialchars($_POST['faculty']);
    $fullName = htmlspecialchars($_POST['fullName']);
    $nameInitial = htmlspecialchars($_POST['nameInitial']);
    $rAddress = htmlspecialchars($_POST['rAddress']);
    $pAddress = htmlspecialchars($_POST['pAddress']);
    $dob = $_POST['dob'];
    $sex = htmlspecialchars($_POST['sex']);
    $maritalStatus = htmlspecialchars($_POST['maritalStatus']);
    $mobile = $_POST['mobile'];
    $school = htmlspecialchars($_POST['school']);
    $blood = htmlspecialchars($_POST['blood']);
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $parent = htmlspecialchars($_POST['parent']);
    $pMobile = $_POST['pMobile'];
    $date = $_POST['enrolDate'];
    $_SESSION["fullName"] = $fullName;

    

    $sql = "UPDATE $department SET department='$department', batch='$batch', email='$email', nic='$nic',
            faculty='$faculty', fullName='$fullName', nameInitial='$nameInitial', residentAddress='$rAddress', permanentAddress='$pAddress',
            dob='$dob', sex='$sex', maritialStatus='$maritalStatus', mobileNumber='$mobile', school='$school', blood='$blood', height='$height',
            weight='$weight', parentName='$parent', parentMobile='$pMobile', enrollDate='$date' WHERE regNumber = '$regNo';";
    mysqli_query($conn, $sql);  


    header("Location: ../appoinment/index.php");
    }




?>