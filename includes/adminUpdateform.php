<?php

session_start();

include "connection.php";

if(isset($_POST['update']) == "POST")
{

    //  Insert and Update students informations

    $regNo = htmlspecialchars($_POST['regNo']);
    $department = htmlspecialchars($_POST['department']);
    $batch = htmlspecialchars($_POST['batch']);
    $email = htmlspecialchars($_POST['email']);
    //$pwd = $_POST['pwd'];
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

    $sql = "UPDATE $department SET department='$department', batch='$batch', email='$email', nic='$nic',
            faculty='$faculty', fullName='$fullName', nameInitial='$nameInitial', residentAddress='$rAddress', permanentAddress='$pAddress',
            dob='$dob', sex='$sex', maritialStatus='$maritalStatus', mobileNumber='$mobile', school='$school', blood='$blood', height='$height',
            weight='$weight', parentName='$parent', parentMobile='$pMobile', enrollDate='$date' WHERE regNumber = '$regNo';";
    mysqli_query($conn, $sql);

    header("Location: ../viewStudent.php?update=updated");
    exit();
    }

else if(isset($_POST['remove']) == "POST")
{
    $regNo = htmlspecialchars($_POST["regNo"]);
    $department = htmlspecialchars($_POST['department']);

    $sql = "UPDATE $department SET department=Null, batch=Null, email=Null, pwd=Null, nic=Null,
            faculty=Null, fullName=Null, nameInitial=Null, residentAddress=Null, permanentAddress=Null,
            dob=Null, sex=Null, maritialStatus=Null, mobileNumber=Null, school=Null, blood=Null, height=Null,
            weight=Null, parentName=Null, parentMobile=Null, enrollDate=Null WHERE regNumber = '$regNo';";

    mysqli_query($conn, $sql);  

    $sqlDropTable = "DROP TABLE IF EXISTS $regNo;";
    mysqli_query($conn, $sqlDropTable);

    header("Location: ../viewStudent.php");
    exit();

}
else
{
    header("Location: ../viewStudent.php");
    exit();
}
?>