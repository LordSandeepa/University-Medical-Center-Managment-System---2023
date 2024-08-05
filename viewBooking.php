<?php
include "includes/connection.php";

session_start();
if(!isset($_SESSION['regNo']))
{
	header("Location: home.php");
}
function build_calendar($month, $year) {
    $mysqli = new mysqli('localhost', 'root', '', 'healthcenter');
    
    
     $daysOfWeek = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');

     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     $numberDays = date('t',$firstDayOfMonth);

     $dateComponents = getdate($firstDayOfMonth);

     $monthName = $dateComponents['month'];

     $dayOfWeek = $dateComponents['wday'];
     if($dayOfWeek==0){
        $dayOfWeek = 6;
     }else{
        $dayOfWeek = $dayOfWeek - 1;
     }

     
    $datetoday = date('Y-m-d');
    
    
    
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-xs btn-primary month' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
    
    $calendar.= " <a class='btn btn-xs btn-primary month' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    
    $calendar.= "<a class='btn btn-xs btn-primary month' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";
    
    
        
      $calendar .= "<tr>";


     foreach($daysOfWeek as $day) {
          $calendar .= "<th  class='header'>$day</th>";
     } 


     $currentDay = 1;

     $calendar .= "</tr><tr>";


     if ($dayOfWeek > 0) { 
         for($k=0;$k<$dayOfWeek;$k++){
                $calendar .= "<td  class='empty'></td>"; 

         }
     }
    
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);

     $mysqli = new mysqli('localhost', 'root', '', 'healthcenter');

    // Fetch the dates from the "dates" table
    $datesArray = array();
    $datesQuery = "SELECT date FROM dates";
    $datesResult = $mysqli->query($datesQuery);
    
    if ($datesResult) {
        while ($dateRow = $datesResult->fetch_assoc()) {
            $datesArray[] = $dateRow['date'];
        }
    }

     $unbookableDates = $datesArray;
  
     while ($currentDay <= $numberDays) {


          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          $date = "$year-$month-$currentDayRel";
          
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date==date('Y-m-d')? "today" : "";
            if($dayname=='saturday' || $dayname=='sunday'){
                $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs  danger_btn' >Holiday</button>";
            }
         elseif($date<date('Y-m-d')){
             $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs  danger_btn'>N/A</button>";
         }elseif (in_array($date, $unbookableDates)) {
            // Display unbookable dates
            $calendar .= "<td class='unbookable $today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Unavailable</button>";
        }else{

            $totalbookings = checkSlots($mysqli,$date);

            if($totalbookings==24){
                $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='#' class='btn btn-danger btn-xs'>All Booked</a>";
            }else{
                $avaliableslots = 24-$totalbookings;
                $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=".$date."' class='btn btn-success btn-xs  book'>Book</a><small><i>$avaliableslots slots left</i></small>";
            }
         }
            
            
           
            
          $calendar .="</td>";
 
          $currentDay++;
          $dayOfWeek++;

     }
     
     


     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
            for($l=0;$l<$remainingDays;$l++){
                $calendar .= "<td class='empty'></td>"; 

         }

     }
     
     $calendar .= "</tr>";

     $calendar .= "</table>";

     echo $calendar;

}

function checkSlots($mysqli,$date){
    $stmt = $mysqli->prepare("select * from bookings where date=?");
    $stmt->bind_param('s', $date);
    $totalbookings = 0;
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $totalbookings++;
            }
            
            $stmt->close();
        }
    }
    return $totalbookings;
}
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Center</title>
    <!-- <link rel="stylesheet" href="appoinment/appoinment.css?=<?php echo time() ?>">  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="./css/styles1.css?=<?php echo time() ?>">

    <style>
       @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            table, thead, tbody, th, td, tr {
                display: block;

            }
            
            

            .empty {
                display: none;
            }

            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }


            td:nth-of-type(1):before {
                content: "Sunday";
            }
            td:nth-of-type(2):before {
                content: "Monday";
            }
            td:nth-of-type(3):before {
                content: "Tuesday";
            }
            td:nth-of-type(4):before {
                content: "Wednesday";
            }
            td:nth-of-type(5):before {
                content: "Thursday";
            }
            td:nth-of-type(6):before {
                content: "Friday";
            }
            td:nth-of-type(7):before {
                content: "Saturday";
            }


        }


        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            body {
                padding: 0;
                margin: 0;
            }
        }


        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
            body {
                width: 495px;
            }
        }

        @media (min-width:641px) {
            table {
                table-layout: fixed;
            }
            td {
                width: 33%;
            }
        }
        
        .row{
            margin-top: 20px;
        }
        
        .today{
            background:yellow;
            border-radius:5px;
        }
        
        
        
    </style>

</head>
<body>
    <div class="container1" style="position: relative;" id="blur">
        <div class="navigation">
            <ul>
               <li>
                <div class="logo1">
                    <a href="#">
                       <span class="icon icon1"><img src="appoinment/images_1/uoj_logo.png" alt=""></span>
                        <span class="title"></span>
                        <span class="icon"></span>
                    </a>
                </div>
               </li> 


               <li>
                <a href="appoinment\index.php">
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
                    <span class="icon icon2"><i class="fa-regular fa-calendar-check"></i></span>
                    <span class="title"></span>
                    <span class="icon">Bookings</span>
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


    

        <!-- main -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <!-- search -->
                    <h1 class="welcome welcome1"> Welcome <span class="wel_us welus"><?=$_SESSION['name']?></span></h1>
                    <!-- <h1 class="welcome"><span class="wel_us"><?=$_SESSION['regNo']?></span></h1> -->
                 <!-- user Image -->
                 <div class="user">
                    <img src="appoinment/images_1/user.jpg" alt="">
                 </div>

            </div>
            <!--  manin ends -->
          
           <div class="container" >
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            $dateComponents = getdate();
                            if(isset($_GET['month']) && isset($_GET['year'])){
                                $month = $_GET['month']; 			     
                                $year = $_GET['year'];
                            }else{
                                $month = $dateComponents['mon']; 			     
                                $year = $dateComponents['year'];
                            }
                            echo build_calendar($month,$year);
                        ?>
                    </div>
                </div>
            </div>
            <!-- Dashboard ends -->         

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


//popup login
    function viewPopup(){
        var blur = document.getElementById('blur');
        blur.classList.toggle('active');
        var popup = document.getElementById('popup');
        popup.classList.toggle('active');
    }

    function closeviewPopup(){
        var blur = document.getElementById('blur');
        blur.classList.remove('active');
        var popup = document.getElementById('popup');
        popup.classList.remove('active');
    }


//blur 



    </script>
</body>
</html>