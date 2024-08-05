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
    <title>Student Login</title>
    <link rel ="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form action="includes/loginformhandler.php" method="POST">
            <!-- reg number -->
            <div class="input-icon">
                <i class="fa fa-user"></i>
              
                <input type="text" name="regNo" id="regno" placeholder="Registration Number (2020CSCXXX)" required>
            </div>
         <!-- Department -->
         <div class="input-icon">
             <i class="fa fa-home"></i>
             <select style="width:106%;padding: 12px;
    border: 2px solid #000000 ;
    border-radius: 3px;
    font-size: 16px;
    transition:border-color 0.3s ease-in-out;" id="regno" name="department" placeholder="Department">
                <option value="csc">Computer Science</option>
             </select>
                <!-- <input type="" name="" id="regno" placeholder="Department (Computer Science)" required>
            </div> -->

            <!-- password -->
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input type="password" name="pwd" id="pwd" placeholder="Password" required>
            </div>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account?<a href ="signup.php"> Sign Up</a></p>
    </div>
    <?php
        if(!isset($_GET['login']))
        {
            exit();
        }
        else
        {
            $error = $_GET['login'];
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
            else if($error == "wrongcpwd")
            {
                alert("Wrong Current Password.");
                exit();
            }
        }
    ?>


</body>
</html>