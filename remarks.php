<?php

include "includes/connection.php";

session_start();
if(!isset($_SESSION['regNo']))
{
	header("Location: home.php");
}

$regNo = $_SESSION["regNo"];

$remarkInfo = "SELECT * FROM $regNo;";
$result = mysqli_query($conn, $remarkInfo);
$noRows = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Center</title>
    <link rel="stylesheet" href="./css/styles1.css?=<?php time() ?>">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

</head>
<body>
    <div class="container" style="position: relative;" id="blur">
    <div class="navigation1">
            <ul>
               <li>
                <div class="logo1">
                    <a href="#">
                       <span class=" icon icon1"><img src="appoinment\images_1\uoj_logo.png" alt=""></span>
                        <span class="title"></span>
                        <span class="icon"></span>
                    </a>
                </div>
               </li> 


               <li>
                <a href="appoinment/index.php">
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="title"></span>
                    <span class="icon">Dashboard</span>
                </a>
               </li> 


               <li>
               <a href="user.php">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <span class="title"></span>
                    <span class="icon">User Profile</span>
                </a>
               </li>
               
               <li>
               <a href="cancelBooking.php">
                    <span class="icon"><ion-icon name="time-outline"></ion-icon></span>
                    <span class="title"></span>
                    <span class="icon">Appoinment</span>
                </a>
               </li> 

               <li>
               <a href="viewBooking.php">
                    <span class="icon"><i class="fa-regular fa-calendar-check"></i></span>
                    <span class="title"></span>
                    <span class="icon">Booking</span>
                </a>
               </li> 


               <li>
                <a href="remarks.php">
                    <span class="icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
                    <span class="title"></span>
                    <span class="icon">Remarks</span>
                </a>
               </li> 


               <li>
                <a href="includes/logout.php">
                    <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                    <span class="title"></span>
                    <span class="icon">Sign Out</span>
                </a>
               </li> 


            </ul>
        </div>

        <div class="main">
            <div class="topbar1">
                <div class="toggle1">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <!-- search -->
                <h1 class="welcome  welcome1"> Welcome <span class="wel_us welus"><?=$_SESSION['name']?>!</span></h1>
                 <!-- user Image -->
                 <div class="user">
                    <img src="images/user.jpg" alt="">
                 </div>

            </div><br><br>

        <?php
        
        // Check for the given registration number is valid one and already signup one for the system
   
            $findRegNo = "SELECT * FROM $regNo;";
            $result = mysqli_query($conn, $findRegNo);
            $noRows = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
    
            $_SESSION['regNo'] =  $regNo; 
            
            ?>
           
    <br><br><br>
    <?php
    if($noRows < 1)
    {
        echo "No previous remarks founds";
    }
    else
    {?>

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

    let toggle = document.querySelector('.toggle1');
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