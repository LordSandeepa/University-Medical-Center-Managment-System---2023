<?php
//////////////////////////////////////////////
function alert($message) 
{
    echo "<script>alert('$message');</script>";
}
//////////////////////////////////////////////

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="./css/adminlogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <!-- <form action="../includes/adminRegistration.php" method="POST"> -->
    <div class="login-container">
        <h2>Admin Registration</h2>

        <form action="./includes/adminRegistration.php" method="POST">
            <!-- reg number -->
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input type="text" name="user" id="regno" placeholder="UserName" required>
            </div>

            <!-- password -->
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input type="password" name="pwd" id="pwd" placeholder="Password" required>
            </div>

            <button type="submit">Submit</button>
        </form>

        <?php

            if(!isset($_GET['register']))
            {
                exit();
            }
            else
            {
                $error = $_GET['register'];
                if($error == "fillAll")
                {
                    alert("Fill All Blanks");
                    exit();
                }
                else if($error == "invalidUsername")
                {
                    alert("Invalid Username");
                    exit();
                }
                else
                {
                    exit();
                }
            }

        ?>

    </div>
</body>

</html>