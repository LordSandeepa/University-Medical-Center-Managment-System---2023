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
    <title>Document</title>
    <link rel ="stylesheet" href="./css/signup/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

    <div class="login-container">
        <h2>Signup</h2>
        
        <form action="includes/signupformhandler.php" method="POST">
            <!-- reg number -->
            <div class="input-icon">
                <label for="regNo">Registration Number</label>
                <input type="text" name="regNo" id="regNo" placeholder="2020CSCXXX" required>
            </div>
            <!-- Department -->
            <div class="input-icon">
             <label for="department">Department</label>
             <select style="width:86%;padding: 12px;
    border: 2px solid #000000 ;
    border-radius: 3px;
    font-size: 16px;
    transition:border-color 0.3s ease-in-out;" id="department" name="department" placeholder="Department" required>
                <option value="csc">Computer Science</option>
             </select>
             </div>
             <!-- Batch -->
            <div class="input-icon">
             <label for="batch">Batch</label>
             <select style="width:86%;padding: 12px;
    border: 2px solid #000000 ;
    border-radius: 3px;
    font-size: 16px;
    transition:border-color 0.3s ease-in-out;" id="batch" name="batch" placeholder="Batch" required>
                <option value="2018/2019">2018/2019</option>
                <option value="2019/2020">2019/2020</option>
                <option value="2020/2021">2020/2021</option>
                <option value="2021/2022">2021/2022</option>
             </select>
             </div>
             <!-- email -->
            <div class="input-icon">
            <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email" required>
            </div>
            <!-- password -->
            <div class="input-icon">
            <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd" placeholder="Password" required>
            </div>
             <!-- confirm password -->
             <div class="input-icon">
             <label for="pwdc">Re-Password</label>
                <input type="password" name="pwdc" id="pwdc" placeholder="Password" required>
            </div>

            <button type="submit">Submit</button>
        </form>
        
    </div>
    
    <?php 
        
        if(!isset($_GET['signup']))
        {
            exit();
        }
        else
        {
            $error = $_GET['signup'];
            if($error == "emptyInput")
            {
                alert("Fill all blanks.");
                exit();
            }
            else if($error == "invalidRegNo")
            {
                alert("Invalid Registration Number");
                exit();
            }
            else if($error == "pwdlength")
            {
                alert("Minimum Password Length 8");
                exit();
            }
            else if($error == "pwdmismatched")
            {
                alert("Password Mismatched");
                exit();
            }
        }

    ?>


</body>
</html>