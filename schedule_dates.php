<?php
include('includes/connection.php');

session_start();
if(!isset($_SESSION['adminUsername']))
{
	header("Location: home.php");
}
$query = "SELECT * FROM dates";
$result = mysqli_query($conn, $query);
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


    

        <!-- main -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                <i class="fa fa-bars"></i>
                </div>

                <!-- search -->
                    <h1 class="welcome"> Welcome <span class="wel_us"><?php echo $_SESSION['adminUsername'];?>!</span></h1>
                 <!-- user Image -->
                 <div class="user">
                    <img src="images/user.jpg" alt="">
                 </div>

            </div>
                <center>
                <br><br>
               <div class="textdata">
               <h2>Change Available Dates</h2>
               <div class="update3">
                <form method="post" action="">
                    <div class="inputBox2">
                    <label for="date">Not Available Dates</label><br>
                             <div class="datesetting">
                            <input type="date" name="date">
                            </div>
                    </div><br><br>
                   

                            <div class="button_container2">
                                <button type="submit" name="submit">Change</button>
                            </div>

                </form>
               </div>
                
               </div>
                
            <br><br>
            <div class="table1">
                <div class="bookings">
                    <div class="heading">
                    <h2>Unavailable Booking Dates</h2>
                    </div>
                    <table>
                            <thead>
                                <th>Date</th>
                                <th>Action</th>
                            </thead>
    
                            <tbody>
                                <?php
                                    
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><a href="includes/removeUnavailableDates.php?id=<?php echo $row['id'] ?>" class="status">Cancel</a></td>
                                        </tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                </div>
                        
            </div>
         </center>
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

<?php

if(isset($_POST['submit'])){
    $date = $_POST['date'];

    $query = "INSERT INTO dates(date) VALUES(?)";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {

        mysqli_stmt_bind_param($stmt, 's', $date);

        $result = mysqli_stmt_execute($stmt);
        
        if ($result) {
            echo "Date inserted successfully.";
        } else {
            echo "Error inserting date: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
