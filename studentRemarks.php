<?php

include "includes/connection.php";
session_start();
if(!isset($_SESSION['adminUsername']))
{
	header("Location: index.php");
}
unset($_SESSION['regNo']);

function alert($message) 
{
    echo "<script>alert('$message');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Center</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

</head>
<body>
    <div class="container" style="position: relative;" id="blur">
        <div class="navigation">
            <ul>
            <li>
                <div class="logo">
                    <a href="#">
                       <span class="icon"><img src="images/uoj.png" alt=""></span>
                        <span class="title"></span>
                        <span class="icon"></span>
                    </a>
                </div>
               </li> 


               <li>
                <a href="adminHome.php">
                    <i class="fas fa-desktop"></i>
                    <span class="title"></span>
                    <span class="icon">Dashboard</span>
                </a>
               </li> 


               <li>
                <a href="viewStudent.php">
                <i class="fa fa-user"></i>
                    <span class="title"></span>
                    <span class="icon">View Student</span>
                </a>
               </li> 


               <li>
                <a href="view_appointment.php">
                    <i class="fas fa-stethoscope"></i>  
                    <span class="title"></span>
                    <span class="icon">View Appointments</span>
                </a>
               </li> 


               <li>
                <a href="schedule_dates.php">
                <i class="fas fa-calendar"></i>
                    <span class="title"></span>
                    <span class="icon">Schedule Dates</span>
                </a>
               </li> 

               <li>
                <a href="studentRemarks.php">
                    <i class="fas fa-comment-medical"></i>
                    <span class="title"></span>
                    <span class="icon">Student Remarks</span>
                </a>
               </li> 


               <li>
                <a href="includes/logout.php">
                    <i class="fas fa-sign-out"></i>  
                    <span class="title"></span>
                    <span class="icon">Sign Out</span>
                </a>
               </li> 


            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                <i class="fa fa-bars"></i>
                </div>

                <!-- search -->
                <h1 class="welcome"> Welcome <span class="wel_us"><?=$_SESSION['adminUsername'];?>!</span></h1>
                 <!-- user Image -->
                 <div class="user">
                    <img src="images/user.jpg" alt="">
                 </div>

            </div><br><br>

            <center>
                <div class="searchbar">
                <form action="studentRemarks.php" method="POST">
                <div class="department">
                    <!-- <div class="label">
                    <label for="department" class="label">Student Department :  </label>
                    </div> -->
                
                    <div class="tableform">
                     <select name="department" id="department" class="box" required>
                     <option value=""disabled selected hidden>Student Department</option>
                        <option value="csc">Computer Science</option>
                     </select>
                    </div>
                    
                </div>
                <div class="searchStudent">
                <!-- <label for="search" class="label">Student Registration No :  </label> -->
                    <div class="tableform">
                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Registration No.   eg:- 20XXCSCXXX"name="search" id="search" required>
                        <button type="submit">Search</submit>
                    </div>
                </div>
            </form>
                </div>
            
            </center><br><br><br>
            <?php
        if(!isset($_GET['error'])){}
            else
            {
                $error = $_GET['error'];
                if($error == "error")
                {
                    alert("Invalid input");
                }
            }
        ?>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {

        $regNo = strtoupper($_POST['search']);
        $department = $_POST['department'];

        $find = "SELECT regNumber, department FROM $department WHERE regNumber = '$regNo';";
        $exitResult = mysqli_query($conn, $find);
        $no_Rows = mysqli_num_rows($exitResult);
        $rows = mysqli_fetch_assoc($exitResult);
        
        // Check for the given registration number is valid one and already signup one for the system

        if($no_Rows > 0 && ($rows['regNumber'] == $regNo && !empty($rows['department'])))
        {   
            $findRegNo = "SELECT * FROM $regNo;";
            $result = mysqli_query($conn, $findRegNo);
            $noRows = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
    
            $_SESSION['regNo'] =  $regNo; 
            
            ?>
            <center>
        <div class="textdata2">
        <h2><?php echo $regNo; ?></h2>
        </div>
   
    <div class="update2">
        <form action="includes/studentRemarkformhandler.php" method="POST">
            <div class="inputBox3">
                <label for="remark">Remarks: </label>
                <textarea rows="5" cols="70" required id="remark" name="remark"></textarea>
            </div>  
                
            <div class="inputBox4">
            <label for="date">Date: </label>
                <input required type="date" id="date" name="date" required>
            </div>
            

            <div class="button_container2">
                <button type="submit" name="add">Add Remark</button>
            </div>
        </form>

    </div>
    </center>
    <br><br><br>
    <h3>
    <?php
    if($noRows < 1)
    {
        echo "No previous remarks founds";
    }
    else
    {?>
    </h3>
    <div class="details2">
                    <div class="recentOrders">
                        <div class="cardHeader">
                        <h2>Remark Details</h2>
                        </div>
                        
                        <table>
                            <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>Remark</td>
                                    <td>Action</td>
                                    
                                </tr>
                            </thead>
                            <?php 
                            do
                            { 
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $row['dates']; ?></td>
                                    <td><?php echo $row['remarks']; ?></td>
                                    <td><a href="includes/studentRemarkformhandler.php?dates=<?= $row['dates']; ?>&remarks=<?= $row['remarks']?>" class="status">Cancel</a></td>
                                </tr>
                            </tbody>
                            <?php 
                             }while($row = mysqli_fetch_assoc($result)) ?>
                        </table>
                    </div>
                     <?php 
                    } 
                    ?>
                <?php
                }
                else
                {
                    //header("Location: ./studentRemarks.php?error=error");
                    exit();
                }
                }
                else
                {
                    exit();
                }
                ?>

    </div>
    
           

            </div>

</div>

    

            


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>

console.log("Script executed");

      //add hovered class in selected list item  
      let list = document.querySelectorAll('.navigation li');
      function activeLink(){
        list.forEach((item) =>
        item.classList.remove('hovered'));
        this.classList.add('hovered');
      }
      list.forEach((item) =>
      item.addEventListener('mouseover',activeLink));


    //menu toggle

    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('main');

    toggle.onclick = function(){
        navigation.classList.toggle('active');
        main.classList.toggle('active');
    }


    // // for change status color


    document.addEventListener("DOMContentLoaded",function(){
        const card2 = document.querySelector('.card2');
        const statusElement = card2.querySelector('.numbers');
        const status = statusElement.textContent.toLocaleLowerCase();
        

        if(status === 'active'){
            card2.classList.add('active');
            card2.style.backgroundColor = "rgb(95, 255, 164)";
            
        }else{
            card2.classList.add('deactive');
            card2.style.backgroundColor = "rgb(255, 95, 95";
        }

    
    });


    
//    for diabling date




$(function(){
    var arrayOfDates = ["25-08-2023","29-08-2023"];

    $("input.datePicker").datepicker({
        beforeShowDay: function(date){
            var string = $.datepicker.formatDate("dd-mm-yy", date);  
            return [arrayOfDates.indexOf(string) === -1]; 
        }
    });
});





    </script>
</body>
</html>