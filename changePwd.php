
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
    <title>Change Password</title>
    <link rel ="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

    <div class="login-container">
        <h2>Change Password</h2>
        <form action="includes/changePwd.php" method="POST">
            <!-- Current Password -->
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input type="text" name="cpwd" id="cpwd" placeholder="Current Password" required>
            </div>

            <!--New Password -->
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input type="password" name="npwd" id="pwd" placeholder="New Password" required>
            </div>

            <!--Retype New Password -->
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input type="password" name="cnpwd" id="pwd" placeholder="Retype New Password" required>
            </div>

            <button type="submit">Change</button>
        </form>
    </div>
    <?php
        if(!isset($_GET['pwd']))
        {
            exit();
        }
        else
        {
            $error = $_GET['pwd'];
            if($error == "invalidregnumber")
            {
                alert("Invalid Registration Number");
                exit();
            }
            else if($error == "incorrectpwd")
            {
                alert("Incorrect Password");
                exit();
            }
            else if($error == "alreadySigned")
            {
                alert("Already Singned.");
                exit();
            }
        }
    ?>


</body>
</html>