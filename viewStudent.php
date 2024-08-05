<?php

include "includes/connection.php";

session_start();
if(!isset($_SESSION['adminUsername']))
{
	header("Location: home.php");
}

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
    <script src="https://kit.fontawesome.com/71ca074b64.js" crossorigin="anonymous"></script>

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
                    <h1 class="welcome"> Welcome <span class="wel_us"><?=$_SESSION['adminUsername']?>!</span></h1>
                 <!-- user Image -->
                 <div class="user">
                    <img src="images/user.jpg" alt="">
                 </div>

            </div><br><br>
            


            <div class="searchbar">
            <center>
            <form action="viewStudent.php" method="POST">
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
                        <input type="text" placeholder=" Registration No.   eg:- 20XXCSCXXX" name="search" id="search"required>
                        <button type="submit">Search</submit>
                    </div>
                </div>
            </form>
            </center>
            </div>
            

            

        <br><br>




        <?php
        if(!isset($_GET['error'])){}
        else
        {
            $error = $_GET['error'];
            if($error == "inputInvalid")
            {
                alert("Invalid input");
            }
        } 
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
    
    $regNo = strtoupper($_POST['search']);
    $department = $_POST['department'];
    
    $findRegNo = "SELECT * FROM $department WHERE regNumber = '$regNo';";
    $result = mysqli_query($conn, $findRegNo);
    $noRows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    
    if($noRows < 1)
    {
        //header("Location: viewStudent.php?error=inputInvalid");
    }
    else
    { ?>
            
            <div class="update">
                <form action="includes/adminUpdateform.php" method="POST">
                    <h2>Details</h2>
                    <div class="content">
                            <div class="inputBox">
                                <label for="regNo">Registration Number</label>
                                <input type="text" placeholder="Registration number" name="regNo" id="regNo" value="<?= $regNo ?>" required>
                            </div>
                            <div class="inputBox">
                            <label for="nic">National Identitiy Card</label>
                            <input type="text" placeholder="NIC" name="nic" id="nic" value="<?= $row['nic'] ?>" required>
                            </div>
                            
                            <div class="inputBox">
                            <label for="department">Department</label>
                                <div class="searchbox">
                                <select name="department" id="department" required>
                                    <option value=""disabled selected hidden>Student Department</option>
                                    <option value="csc" <?php if($row['department'] == "csc"){ echo "selected"; } ?>>Computer Science</option>
                                </select>
                                </div>
                                
                            </div>
                            <div class="inputBox">
                            <label for="faculty">Faculty</label>
                            <input type="text" placeholder="Faculty" name="faculty" id="faculty" value="<?= $row['faculty'] ?>"required>
                            </div>
                            <div class="inputBox">
                            <label for="batch">Batch</label>
                            <div class="searchbox">
                            <select name="batch" id="batch" required>
                                <option value="" disabled selected hidden>Batch</option>
                                <option value="2018/2019" <?php if($row['batch'] == "2018/2019"){ echo "selected"; } ?>>2018/2019</option>
                                <option value="2019/2020" <?php if($row['batch'] == "2019/2020"){ echo "selected"; } ?>>2019/2020</option>
                                <option value="2020/2021" <?php if($row['batch'] == "2020/2021"){ echo "selected"; } ?>>2020/2021</option>
                                <option value="2021/2022" <?php if($row['batch'] == "2021/2022"){ echo "selected"; } ?>>2021/2022</option>
                            </select>
                            </div>
                            </div>
                            <div class="inputBox">
                            <label for="email">Email</label>
                            <input type="email" placeholder = "Email" name="email" id="email" value="<?= $row['email'] ?>"required>
                            </div>
                            

                            <div class="inputBox">
                            <label for="mobile">Mobile Number</label>
                            <input type="number" placeholder = "Phone number" name="mobile" id="mobile" value="<?= $row['mobileNumber'] ?>"required>
                            </div>
                            <div class="inputBox">
                            <label for="fullName">Full Name</label>
                            <input type="text" placeholder = "Full Name" name="fullName" id="fullName" value="<?= $row['fullName'] ?>"required>
                            
                            </div>
                            

                            
                            
                            <div class="inputBox">
                            <label for="rAddress">Residential Address</label>
                            <textarea rows="2" cols="49" class="address" name="rAddress" id="rAddress" required><?= $row['residentAddress'] ?></textarea>
                            </div>

                            <div class="inputBox">
                            <label for="nameInitial">Name with Initials</label>
                            <input type="text" placeholder = "Name with Initials" name="nameInitial" id="nameInitial" value="<?= $row['nameInitial'] ?>"required>
                            </div>
                            
                            <div class="inputBox">
                            <label for="pAddress">Permenant Address</label>
                            <textarea rows="2" cols="49" class="address" name="pAddress" id="pAddress" required><?= $row['permanentAddress'] ?></textarea>
                            </div>
                            

                            <div class="inputBox">
                            <label for="dob">DOB</label>
                            <input type="text"  id="date" placeholder = "Date of Birth" onfocus="(this.type='date')" name="dob" id="dob" value="<?= $row['dob'] ?>"required>
                            </div>
                            
                        
                            <div class="inputBox">
                            <label for="sex">Gender</label>
                            <div class="searchbox">
                            <select name="sex" id="sex" required>
                            <option value="" disabled selected hidden>Gender</option>
                            <option value="Male" <?php if($row['sex'] == "Male"){ echo "selected"; } ?>>Male</option>
                            <option value="Female" <?php if($row['sex'] == "Female"){ echo "selected"; } ?>>Female</option>
                             </select>
                            </div>


                            <div class="inputBox">
                            <label for="maritalStatus">Marital Status</label>
                            <div class="searchbox">
                            <select name="maritalStatus" id="maritalStatus" required>
                            <option value="" disabled selected hidden>Marital Status</option>
                            <option value="Single" <?php if($row['maritialStatus'] == "Single"){ echo "selected"; } ?>>Single</option>
                            <option value="Married" <?php if($row['maritialStatus'] == "Married"){ echo "selected"; } ?>>Married</option>
                            </select>
                            </div>
                            
                            </div>
                            


                            <div class="inputBox">
                            <label for="school">Last School Attended</label>
                            <input type="text"  id="date" placeholder = "Last School Attended" onfocus="(this.type='date')" name="school" id="school" value="<?= $row['school'] ?>"required>
                            </div>

                            <div class="inputBox">
                            <label for="weight">Weight</label>
                            <input type="text" placeholder="Weight" name="weight" id="weight" value="<?= $row['weight'] ?>" required>
                            </div>


                            <div class="inputBox">
                            <label for="height">Height</label>
                            <input type="text" placeholder="Height" name="height" id="height" value="<?= $row['height'] ?>"required>
                            </div>

                            <div class="inputBox">
                            <label for="blood">Blood Group</label>
                            <div class="searchbox">
                            <select name="blood" id="blood" name="blood" id="blood" required>
                                <option value="" disabled selected hidden>Blood Group</option>
                                <option value="A+" <?php if($row['blood'] == "A+"){ echo "selected"; } ?>>A+</option>
                                <option value="A-" <?php if($row['blood'] == "A-"){ echo "selected"; } ?>>A-</option>
                                <option value="B+" <?php if($row['blood'] == "B+"){ echo "selected"; } ?>>B+</option>
                                <option value="B-" <?php if($row['blood'] == "B-"){ echo "selected"; } ?>>B-</option>
                                <option value="AB+" <?php if($row['blood'] == "AB+"){ echo "selected"; } ?>>AB+</option>
                                <option value="AB-" <?php if($row['blood'] == "AB-"){ echo "selected"; } ?>>AB-</option>
                                <option value="O+" <?php if($row['blood'] == "O+"){ echo "selected"; } ?>>O+</option>
                                <option value="O-" <?php if($row['blood'] == "O-"){ echo "selected"; } ?>>O-</option>
                            </select>
                            </div>
                           
                            </div>
                    </div>
                    <center>
                    <div class="content2">
                    <p> Contact details in case of emergency</p><br>
                    <div class="inputBox">
                            
                            <label for="parent">Parent/Guardian Name</label>
                            <input type="text" placeholder = "Parent/Guardian" class ="box"  name="parent" id="parent" value="<?= $row['parentName'] ?>"required>
                            <label for="pMobile">Mobile Number</label>
                            <input type="number" placeholder = "Phone number" class ="box" name="pMobile" id="pMobile" value="<?= $row['parentMobile'] ?>"required>
                            </div>
                            
                            <input type="hidden" name="enrolDate" value="<?= $row['enrollDate'] ?>">

                    </div>
                    </center>
                    <br>

                    <div class="content">
                    <div class="button_container2">
                           <button type="submit" name="update"> Update</button>
                           </div>

                           <div class="button_container">
                           <button type="submit" name="remove"> Remove</button>
                           </div>
                    </div>
                </form>
                <?php
                }
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