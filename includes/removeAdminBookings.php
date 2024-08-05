<?php
include('connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM bookings WHERE id=$id";
	$result=mysqli_query($conn,$query);
    if ($result) {
        header("location: ../adminHome.php");
    } else {
        echo "Error: " .mysqli_connect_error();
    }
}
?>