<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment</title>
    <link rel ="stylesheet" href="./css/enrollment.css?=<?php echo time() ?>">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    
   
        <div class="wrapper">
            <div class="form_wrap">
                
                <div class="form_1 data_info">
                    
                    <h2>Enrollment Page</h2>
                    <h3><?php echo $_SESSION["regNo"]; ?></h3>
                    <form action="includes/enrollmentformhandler.php" method="POST">
                        <div class="form_container">
                            <div class="input_wrap">
                                <label for="form1_input1"></label>
                                <input type="hidden" id="form1_input1" name="regNo" value="<?= $_SESSION["regNo"] ?>" required >
                            </div>
                            <div class="input_wrap">
                                <label for="form1_input2">Faculty</label>
                                <input type="text" id="form1_input2" name="faculty" required>
                            </div>
                        </div>

                </div>
                <br>


                <div class="form_2 data_info" >
                    
                           
                    
                    
                            <div class="form_container">
                                <div class="input_wrap">
                                    <label for="form2_input1">Full Name</label>
                                    <input type="text" id="form2_input1" name="fullName" value="" required>
                                </div>
                                <div class="input_wrap">
                                    <label for="form2_input2">Name with initials</label>
                                    <input type="text" id="form2_input2" name="nameInitial" value="" required>
                                </div>
                                <div class="input_wrap">
                                    <label for="form2_input3">NIC number</label>
                                    <input type="text" id="form2_input3" name="nic" value="" required>
                                </div>
                                <div class="input_wrap">
                                    <label for="form2_input4">Residential Address</label>
                                    <input type="text" id="form2_input4" name="rAddress" value="" required>
                                </div>
                                <div class="input_wrap">
                                    <label for="form2_input5">Permanent Address</label>
                                    <input type="text" id="form2_input5" name="pAddress" value="" required>
                                </div>
                            </div>
                    
                    
                </div>
                <br>


                <div class="form_3 data_info" >
                    
                    
                    
                        <div class="form_container">
                            <div class="input_wrap">
                                <label for="form3_input1">Date of Birth</label>
                                <input type="date" id="form3_input1" name="dob" value="" required>
                            </div>
                            <div class="input_wrap">
                                <label for="sex">Gender</label>
                                <select name="sex"  id="form3_input2" class = "input_wrap select_wrap" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="input_wrap">
                                <label for="form3_input3">Marital Status</label>
                                <select name="maritalStatus" id="form3_input3" class = "input_wrap select_wrap" required>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                </select>
                            </div>
                            <div class="input_wrap">
                                <label for="form3_input4">Mobile number</label>
                                <input type="tel" id="form3_input4" name="mobile" value="" required>
                            </div>
                            <div class="input_wrap">
                                <label for="form3_input5">Last School Attended</label>
                                <input type="text" id="form3_input5" name="school" value="" required>
                            </div>
                        </div>
                    
                
                </div>
                <br>


                <div class="form_4 data_info" >
                    
                  
                    
                
                        <div class="form_container">
                            <div class="input_wrap">
                            <label for="form4_input1">Blood Group</label>
                            <select name="blood" id="blood" id="form4_input1" class = "input_wrap select_wrap" required>
                                <option value="" disabled selected hidden>Blood Group</option>
                                <option value="A+" class = "input_wrap">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                            </div>
                            <div class="input_wrap">
                                <label for="form4_input2">Height</label>
                                <input type="number" name="height" id="form4_input2" required >
                            </div>
                            <div class="input_wrap">
                                <label for="form4_input3">Weight</label>
                                <input type="number" name="weight" id="form4_input3" required >
                            </div>
                            <div class="input_wrap">
                                <label for="form4_input4">Guardian Name</label>
                                <input type="text"  value="" name="parent" id="form4_input4" required >
                            </div>
                            <div class="input_wrap">
                                <label for="form4_input5">Contact number</label>
                                <input type="tel"  value="" name="pMobile" id="form4_input5" required >
                            </div>
                        </div>
                    <?php
                    $mydate=getdate(date("U"));
                    $year = $mydate['year'];
                    $month = $mydate['month'];
                    $date = $mydate['mday'];
                    $enrolDate = "$month $date, $year";
                    ?>  
                    <input type="hidden" name="enrolDate" value="<?= $enrolDate ?>">
                        <br>
                       <div class="btns_wrap">
                            <div class="common_btns form_4_btns" >
                                <button type="submit" class="btn_done">Submit
                                <span class="icon"></span>
                                 </button>
                            </div>
                       </div>
                    
                    </form>
                </div>
                <br>
            </div>
        </div>
</body>
</html> 


