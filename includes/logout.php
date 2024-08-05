<?php

session_start();

if(isset($_SESSION['adminUsername']) || isset($_SESSION["regNo"]))
{
    session_unset();
    session_destroy();

    header("Location: ../home.php");
    exit();
}
else
{
    header("Location: ../home.php");
}



?>