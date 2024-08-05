<?php
include('connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM dates WHERE id=$id";
	$result=mysqli_query($conn,$query);
    if ($result) {
        header("location: ../schedule_dates.php");
    } else {
        echo "Error: " .mysqli_connect_error();
    }
}
?>