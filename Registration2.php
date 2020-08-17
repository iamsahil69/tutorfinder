<?php
 //starting session
 session_start();
 error_reporting(0);
 $errors = array(
    "ques" => "",
    "class" => "",
    "board" => "",
    "subjects" => "",
    "university" => "",
    "course" => "",
    "days" => "",
    "duration" => "",
    "lang" => "",
    "fees" => "",
    "tagline" => "",
    "facilities" => "",
    "exp" => "",
    "type" => ""
);
$selected = array( 1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "",);
$ques = $class = $board = $subjects = $uni = $course =$type = $days = $duration = $lang = $fees = $tagline = $facilities = $exp = $facility = "";
$vques = $vclass = $vboard = $vsubjects = $vuni = $vcourse = $vtype = $vdays = $vduration = $vlang = $vfees = $vtagline = $vfacilities = $vexp = false;

    if(isset($_POST["sign-out"])){
        session_unset();
        header("Location:signin.php");
    }
    if(isset($_SESSION['username'])){
        $id = $_SESSION['id'];
        $name = $_SESSION['username'];
    
        if(isset($_POST['submit'])){

            //taking values from form
            $ques = $_POST["Choice"]; 
            $class = $_POST["class"];
            $board = $_POST["board"];
            $subjects = $_POST["Subjects"];
            $uni = $_POST["Uni"];
            $course = $_POST["course"];
            $type = $_POST["type"];
            $days = $_POST["days"];
            $duration = $_POST["duration"];
            $lang = $_POST["lang"];
            $fees = $_POST["fees"];
            $tagline = $_POST["tagline"];
            $facilities = $_POST["facility"]; 
            $exp = $_POST["Exp"];
            
            // validating the question
                if(empty($ques)){
                    $errors["ques"] = "You must answer the question";
                }else{
                    $vques = true;
                    //validating board and class
                    if($ques === "school"){
                        if(empty($board)){
                            $errors["board"] = "Please select a board";
                        }else{
                            $vboard = true;
                        }
                        if(empty($class)){
                            $errors["class"] = "Please select classes to select subjects";
                        }else{
                            $vclass = true;
                        }   
                    }
                    //validating university and course
                    if($ques === "college"){
                        if(empty($uni)){
                            $errors["university"] = "Please select a university";
                        }else{
                            $vuni = true;
                        }
                        if(empty($course)){
                            $errors["course"] = "Please select course to select subjects";
                        }else{
                            $vcourse = true;
                        }   
                    }
                }
            // validating subjects
                if(empty($subjects)){
                    $errors["subjects"] = "Please select atleast one subject";
                }else{
                    $vsubjects = true;
                }

            //validating type of tutor
            if(empty($type)){
                $errors["type"] = "Please select the type of tutor";
            }else{
                $vtype = true;
            }

            //validating experience
            if(empty($exp)){
                $errors["exp"] = "Please mention your experience";
            }else{
                if(preg_match("/^[\d]{1,2}$/",$exp)){
                    $vexp = true;
                }else{
                    $errors["exp"] = "Please mention a valid experience";
                }
            }

            //validating teaching days
            if(empty($days)){
                $errors["days"] = "Please select the teaching days";
            }else{
                $vdays = true;
            }

            //validating duration
            if(empty($duration)){
                $errors["duration"] = "Please mention duration for class";
            }else{
                if(preg_match("/^[\d]$/",$duration)){
                    $vduration = true;
                }else{
                    $errors["duration"] = "Please mention a valid duration";
                }
            }

            //validating language
            if(empty($lang)){
                $errors["lang"] = "Please select a lang for teaching";
            }else{
                $vlang = true;
            }

            //validating fees
            if(empty($fees)){
                $errors["fees"] = "Please mention the fees you will charge";
            }else{
                if(preg_match("/^[1-9][\d]{3}$/",$fees)){
                    $vfees = true;
                }else{
                    $errors["fees"] = "Please mention a valid fees";
                } 
            }

            //validating facility
            if(empty($facilities)){
                $errors["facilities"] = "Please select atleast one facility";
            }else{
                foreach($facilities as $fact){
                    $selected[$fact] = 'checked';
                }
                $facility = implode(",",$facilities);
                $vfacilities = true;
            }

            //validating tagline
            if(empty($tagline)){
                $errors["tagline"] = "Please write a tagline for yourself";
            }else{
                if(preg_match("/^[a-z\d\-\s@]+$/i",$tagline)){
                    $vtagline = true;
                }else{
                    $errors["tagline"] = "You can only use characters,digits,@ and -";
                }
            }
            if($vques && $vdays && $vduration && $vexp && $vfacilities && $vsubjects && $vtagline && $vlang && $vtype){
                require("connection.php");
                    if($vclass && $vboard){
                        echo "Hi i am inside block";
                        $sql = "INSERT INTO teaching_info(Id,BoardUniv,ClassCourse,Type,TeachingDays,Duration,Language,Fees,Tagline,Facilities,Experience) VALUES('$id','$board','$class','$type','$days','$duration','$lang','$fees','$tagline','$facility','$exp')";
                        if(mysqli_query($conn,$sql)){
                            foreach($subjects as $values){
                                $sql = "INSERT INTO subjects(id,Subjects) VALUES ('$id','$values')";
                                mysqli_query($conn,$sql);
                            }
                            echo "Data inserted successfully";
                            header("Location:profile.php");
                        }else{
                            echo "Data not inserted due to technical error please try again later!!!";
                        }
                    }
                    if($vcourse && $vuni){
                        $sql = "INSERT INTO teaching_info(Id,BoardUniv,ClassCourse,Type,TeachingDays,Duration,Language,Fees,Tagline,Facilities,Experience) VALUES('$id','$uni','$course','$type','$days','$duration','$lang','$fees','$tagline','$facility','$exp')";
                        if(mysqli_query($conn,$sql)){
                            foreach($subjects as $values){
                                $sql = "INSERT INTO subjects(id,Subjects) VALUES ('$id','$values')";
                                mysqli_query($conn,$sql);
                            }
                            echo "Data inserted successfully";
                            header("Location:profile.php");
                        }else{
                            echo "Data not inserted due to technical error please try again later!!!";
                        }
                    }
            }
        }

    }else{
        header("Location:signin.php"); 
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Page 2</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css\registration2.css">
</head>
<body>
<div class="logo-nav">
        <div class="logo">
            <h1><i class="fa fa-user" aria-hidden="true"></i>Tutor<span>finder</span></h1>
        </div>
        <div class="nav">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="contacts.html">Contacts</a></li>
            </ul>
        </div>       
</div>
<div class="main-content">
<div class="sign-out">
        <div class="name">
            <h4><?php if(isset($_SESSION['username'])){ echo "Hi, ".$name."<br/> Complete your registration form"; }?></h4> 
        </div>
        <div class="button">
            <form action="registration.php" method="post">
            <input id="submit1" type="submit" value="Sign-out" name="sign-out"><i class="fa fa-sign-out" aria-hidden="true"></i>
            </form>
        </div>   
    </div>  
    <div class="form-container">
        <h2>Teaching details</h2>
     <form action="registration2.php" method="post">
     <label>Q. Which type of students you want to teach ?</label><br>
        <input type="radio" name="Choice" id="School" onclick="showHide()" value="school" <?php if (isset($_POST['Choice']) && $_POST['Choice']=="school") echo "checked";?>><label for="School">School going</label><br>
        <input type="radio" name="Choice" id="College" onclick="showHide()" value="college" <?php if (isset($_POST['Choice']) && $_POST['Choice']=="college") echo "checked";?>><label for="College">College going</label><br>
        <div class="errors"><?php echo $errors["ques"];?></div>
        <div class="school">
                <label for="Board">Board</label>
                <select name="board">
                    <option value="">Select</option>
                    <option value="CBSE" <?php if (isset($_POST['board']) && $_POST['board']=="CBSE") echo "selected='selected'";?> >CBSE</option>
                    <option value="ICSE" <?php if (isset($_POST['board']) && $_POST['board']=="ICSE") echo "selected='selected'";?> >ICSE</option>
                    <option value="PSEB" <?php if (isset($_POST['board']) && $_POST['board']=="PSEB") echo "selected='selected'";?> >PSEB</option>
                    <option value="HPSEB" <?php if (isset($_POST['board']) && $_POST['board']=="HPSEB") echo "selected='selected'";?> >HPSEB</option>
                    <option value="Other" <?php if (isset($_POST['board']) && $_POST['board']=="other") echo "selected='selected'";?> >Other</option>
                </select><br>
                <div class="errors"><?php echo $errors["board"];?></div>

                <label for="Class">Classes</label>
                <select name="class" id="Class" onchange="display()">
                <option value="">Select</option>
                <option value="1st-5th" <?php if (isset($_POST['class']) && $_POST['class']=="1st-5th") echo "selected='selected'";?>>1st-5th</option>
                <option value="6th-10th" <?php if (isset($_POST['class']) && $_POST['class']=="6th-10th") echo "selected='selected'";?>>6th-10th</option>
                <option value="11th-12th" <?php if (isset($_POST['class']) && $_POST['class']=="11th-12th") echo "selected='selected'";?>>11th-12th</option>
                </select><br>
                <div class="errors"><?php echo $errors["class"];?></div>

             
        </div>
        <div class="college">
                <label for="Uni">University</label>
                <select name="Uni">
                    <option value="">Select</option>
                    <option value="PU" <?php if (isset($_POST['Uni']) && $_POST['Uni']=="PU") echo "selected='selected'";?>>Panjab University</option>
                    <option value="CU" <?php if (isset($_POST['Uni']) && $_POST['Uni']=="CU") echo "selected='selected'";?>>Chandigarh University</option>
                    <option value="LPU" <?php if (isset($_POST['Uni']) && $_POST['Uni']=="LPU") echo "selected='selected'";?>>LPU</option>
                    <option value="DU" <?php if (isset($_POST['Uni']) && $_POST['Uni']=="DU") echo "selected='selected'";?>>Delhi University</option>
                    <option value="Other" <?php if (isset($_POST['Uni']) && $_POST['Uni']=="Other") echo "selected='selected'";?>>Other</option>
                </select><br>
                <div class="errors"><?php echo $errors["university"];?></div>

                <label for="Course">Course</label>
                <select name="course" id="Course" onchange="display2()">
                <option value="">Select</option>
                <option value="BCA" <?php if (isset($_POST['course']) && $_POST['course']=="BCA") echo "selected='selected'";?>>BCA</option>
                <option value="B.Com" <?php if (isset($_POST['course']) && $_POST['course']=="B.Com") echo "selected='selected'";?>>B.Com</option>
                <option value="B.Sc" <?php if (isset($_POST['course']) && $_POST['course']=="B.Sc") echo "selected='selected'";?>>B.Sc</option>
                <option value="BBA" <?php if (isset($_POST['course']) && $_POST['course']=="BBA") echo "selected='selected'";?>>BBA</option>
                <option value="M.Sc IT" <?php if (isset($_POST['course']) && $_POST['course']=="M.Sc IT") echo "selected='selected'";?>>M.Sc IT</option>
                </select><br>
                <div class="errors"><?php echo $errors["course"];?></div>

             
        </div>
            <div class="primary">
                <span>Subjects</span>
                <div class="primary-section">
                    <div class="col-1">
                        <input type="checkbox" name="Subjects[]" value="Hindi" id="Hindi"><label for="Hindi">Hindi</label><br>
                        <input type="checkbox" name="Subjects[]" value="Drawing" id="draw"><label for="draw">Drawing</label>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" name="Subjects[]" value="English" id="Eng"><label for="Eng">English</label>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" name="Subjects[]" value="Punjabi" id="Pb"><label for="Pb">Punjabi</label>
                    </div>
                    <div class="col-4">
                        <input type="checkbox" name="Subjects[]" value="E.V.S" id="EVS"><label for="EVS">E.V.S</label>
                    </div>
                </div>
                <div class="errors"><?php echo $errors["subjects"];?></div>

            </div>
            <div class="secondary">
            <span>Subjects</span>
                <div class="primary-section">
                    <div class="col-1">
                        <input type="checkbox" name="Subjects[]" value="Mathematics" id="secMaths"><label for="secMaths">Mathematics</label><br>
                        <input type="checkbox" name="Subjects[]" value="English" id="secEng"><label for="secEng">English</label><br>
                        <input type="checkbox" name="Subjects[]" value="Drawing" id="secDraw"><label for="secDraw">Drawing</label><br>

                    </div>
                    <div class="col-2">
                        <input type="checkbox" name="Subjects[]" value="Science" id="sci"><label for="sci">Science</label><br>
                        <input type="checkbox" name="Subjects[]" value="Hindi" id="secHindi"><label for="secHindi">Hindi</label><br>
                        <input type="checkbox" name="Subjects[]" value="Political" id="secPol"><label for="secPol">Political</label><br>

                    </div>
                    <div class="col-3">
                        <input type="checkbox" name="Subjects[]" value="History" id="his"><label for="his">History</label><br>
                        <input type="checkbox" name="Subjects[]" value="Sanskrit" id="secSan"><label for="secSan">Sanskrit</label><br>
                        <input type="checkbox" name="Subjects[]" value="Punjabi" id="secPb"><label for="secPb">Punjabi</label><br>


                    </div>
                    <div class="col-4">
                        <input type="checkbox" name="Subjects[]" value="Civics" id="civic"><label for="civic">Civics</label><br>
                        <input type="checkbox" name="Subjects[]" value="Music" id="secMusic"><label for="secMusic">Music</label><br>
                        <input type="checkbox" name="Subjects[]" value="Home Sci." id="secHS"><label for="secHS">Home Sci.</label><br>

                    </div>
                </div>
                <div class="errors"><?php echo $errors["subjects"];?></div>
            </div>
            <div class="higher-secondary">
            <span>Subjects</span>
                <div class="primary-section">
                    <div class="col-1">
                        <input type="checkbox" name="Subjects[]" value="Mathematics" id="Maths"><label for="Maths">Mathematics</label><br>
                        <input type="checkbox" name="Subjects[]" value="Comp. Sci." id="CS"><label for="CS">Comp. Sci.</label><br>
                        <input type="checkbox" name="Subjects[]" value="Accountancy" id="Acc"><label for="Acc">Accountancy</label><br>
                        <input type="checkbox" name="Subjects[]" value="Economics" id="Eco"><label for="Eco">Economics</label><br>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" name="Subjects[]" value="Chemistry" id="Chem"><label for="Chem">Chemistry</label><br>
                        <input type="checkbox" name="Subjects[]" value="Sociology" id="Soc"><label for="Soc">Sociology</label><br>
                        <input type="checkbox" name="Subjects[]" value="Statistics" id="Stat"><label for="Stat">Statistics</label><br>
                        <input type="checkbox" name="Subjects[]" value="Business Studies" id="BizzStud"><label for="BizzStud">Business Studies</label><br>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" name="Subjects[]" value="Physics" id="Phy"><label for="Phy">Physics</label><br>
                        <input type="checkbox" name="Subjects[]" value="Physiology" id="Physio"><label for="Physio">Physiology</label><br>
                        <input type="checkbox" name="Subjects[]" value="Business Law" id="BizzLaw"><label for="BizzLaw">Business Law</label><br>
                        <input type="checkbox" name="Subjects[]" value="Music" id="Music"><label for="Music">Music</label><br>
                    </div>
                    <div class="col-4">
                        <input type="checkbox" name="Subjects[]" value="Biology" id="bio"><label for="bio">Biology</label><br>
                        <input type="checkbox" name="Subjects[]" value="Phy. Edu." id="Physical"><label for="Physical">Phy. Edu.</label><br>
                        <input type="checkbox" name="Subjects[]" value="Taxes" id="Taxes"><label for="Taxes">Taxes</label><br>
                    </div>
                </div>
                <div class="errors"><?php echo $errors["subjects"];?></div>
            </div>
            <div class="BCA">
            <span>Subjects</span>
                <div class="primary-section">
                    <div class="col-1">
                        <input type="checkbox" name="Subjects[]" value="Data Structure" id="DS"><label for="DS">Data Structure</label><br>
                        <input type="checkbox" name="Subjects[]" value="C (language)" id="Clang"><label for="Clang">C (language)</label><br>
                        <input type="checkbox" name="Subjects[]" value="VB .NET" id="VB"><label for="VB">VB .NET</label><br>
                        <input type="checkbox" name="Subjects[]" value="DBMS" id="DBMS"><label for="DBMS">DBMS</label><br>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" name="Subjects[]" value="C++ (language)" id="C++"><label for="C++">C++ (language)</label><br>
                        <input type="checkbox" name="Subjects[]" value="PHP" id="PHP"><label for="PHP">PHP</label><br>
                        <input type="checkbox" name="Subjects[]" value="Comp. Organisation" id="CO"><label for="CO">Comp. Organisation</label><br>
                        <input type="checkbox" name="Subjects[]" value="ISD" id="ISD"><label for="ISD">ISD</label><br>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" name="Subjects[]" value="Java (language)" id="java"><label for="java">Java (language)</label><br>
                        <input type="checkbox" name="Subjects[]" value="Linux OS" id="Linux"><label for="Linux">Linux OS</label><br>
                        <input type="checkbox" name="Subjects[]" value="SPM" id="SPM"><label for="SPM">SPM</label><br>
                        <input type="checkbox" name="Subjects[]" value="HCP" id="HCP"><label for="HCP">HCP</label><br>
                    </div>
                    <div class="col-4">
                        <input type="checkbox" name="Subjects[]" value="Javascript" id="JS"><label for="JS">Javascript</label><br>
                        <input type="checkbox" name="Subjects[]" value="E-commerce" id="ecom"><label for="ecom">E-commerce</label><br>
                        <input type="checkbox" name="Subjects[]" value="Comp. Networks" id="CN"><label for="CN">Comp. Networks</label><br>
                        <input type="checkbox" name="Subjects[]" value="Web development" id="FWP"><label for="FWP">Web development</label><br>
                    </div>
                </div>
                <div class="errors"><?php echo $errors["subjects"];?></div>
            </div>
            <div class="BSC">
            <span>Subjects</span>
                <div class="primary-section">
                    <div class="col-1">
                        <input type="checkbox" name="Subjects[]" value="Inorganic Chemistry" id="IC"><label for="IC">Inorganic Chemistry</label><br>
                        <input type="checkbox" name="Subjects[]" value="Organic Chemistry" id="OC"><label for="OC">Organic Chemistry</label><br>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" name="Subjects[]" value="Plane Geometry" id="PG"><label for="PG">Plane Geometry</label><br>
                        <input type="checkbox" name="Subjects[]" value="Mechanics" id="Mech"><label for="Mech">Mechanics</label><br>

                    </div>
                    <div class="col-3">
                        <input type="checkbox" name="Subjects[]" value="Physical Chemistry" id="PC"><label for="PC">Physical Chemistry</label><br>
                        <input type="checkbox" name="Subjects[]" value="Electricity & Magnetism" id="EM"><label for="EM">Electricity & Magnetism</label><br>

                    </div>
                    <div class="col-4">
                        <input type="checkbox" name="Subjects[]" value="Mathematics" id="Math"><label for="Math">Mathematics</label><br>
                        <input type="checkbox" name="Subjects[]" value="Physics" id="Phy"><label for="Phy">Physics</label><br>

                    </div>
                </div>
                <div class="errors"><?php echo $errors["subjects"];?></div>
            </div>
            <div class="BCOM">
            <span>Subjects</span>
             <div class="primary-section">
                <div class="col-1">
                        <input type="checkbox" name="Subjects[]" value="Accounts" id="bcAccounts"><label for="bcAccounts">Accounts</label><br>
                        <input type="checkbox" name="Subjects[]" value="Commercial Law" id="bcCommercial"><label for="bcCommercial">Commercial Law</label><br>
                        <input type="checkbox" name="Subjects[]" value="Business Studies" id="bcBS"><label for="bcBS">Business Studies</label><br>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" name="Subjects[]" value="Macro Economics" id="bcmacro"><label for="bcmacro">Macro Economics</label><br>
                        <input type="checkbox" name="Subjects[]" value="Indirect Tax" id="bcindirect"><label for="bcindirect">Indirect Tax</label><br>
                        <input type="checkbox" name="Subjects[]" value="Company Law" id="bcCL"><label for="bcCL">Company Law</label><br>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" name="Subjects[]" value="Micro Economics" id="bcmicro"><label for="bcmicro">Micro Economics</label><br>
                        <input type="checkbox" name="Subjects[]" value="Human Resource Mang." id="bcHR"><label for="bcHR">Human Resource Mang.</label><br>
                        <input type="checkbox" name="Subjects[]" value="E-commerce" id="bcEC"><label for="bcEC">E-commerce</label><br>
                    </div>
                    <div class="col-4">
                        <input type="checkbox" name="Subjects[]" value="Direct Tax" id="bcdirect"><label for="bcdirect">Direct Tax</label><br>
                    </div>
                    
                </div>
                <div class="errors"><?php echo $errors["subjects"];?></div>
            </div>
            <div class="BBA">
            <span>Subjects</span>
             <div class="primary-section">
                <div class="col-1">
                        <input type="checkbox" name="Subjects[]" value="Accounts" id="bcAccounts"><label for="bcAccounts">Accounts</label><br>
                        <input type="checkbox" name="Subjects[]" value="Commercial Law" id="bcCommercial"><label for="bcCommercial">Commercial Law</label><br>
                        <input type="checkbox" name="Subjects[]" value="Business Studies" id="bcBS"><label for="bcBS">Business Studies</label><br>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" name="Subjects[]" value="Macro Economics" id="bcmacro"><label for="bcmacro">Macro Economics</label><br>
                        <input type="checkbox" name="Subjects[]" value="Indirect Tax" id="bcindirect"><label for="bcindirect">Indirect Tax</label><br>
                        <input type="checkbox" name="Subjects[]" value="Company Law" id="bcCL"><label for="bcCL">Company Law</label><br>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" name="Subjects[]" value="Micro Economics" id="bcmicro"><label for="bcmicro">Micro Economics</label><br>
                        <input type="checkbox" name="Subjects[]" value="Human Resource Mang." id="bcHR"><label for="bcHR">Human Resource Mang.</label><br>
                        <input type="checkbox" name="Subjects[]" value="E-commerce<" id="bcEC"><label for="bcEC">E-commerce</label><br>
                    </div>
                    <div class="col-4">
                        <input type="checkbox" name="Subjects[]" value="Direct Tax" id="bcdirect"><label for="bcdirect">Direct Tax</label><br>
                        <input type="checkbox" name="Subjects[]" value="Commercial Law" id="Commercial"><label for="Commercial">Commercial Law</label><br>
                        <input type="checkbox" name="Subjects[]" value="Business Studies" id="BS"><label for="BS">Business Studies</label><br>
                    </div>
                    
                </div>
                <div class="errors"><?php echo $errors["subjects"];?></div>
            </div>
            <div class="MSC-IT">
            <span>Subjects</span>
                <div class="primary-section">
                <div class="col-1">
                        <input type="checkbox" name="Subjects[]" value="Adv. Data Structure" id="ADS"><label for="ADS">Adv. Data Structure</label><br>
                        <input type="checkbox" name="Subjects[]" value="C (language)" id="mClang"><label for="mClang">C (language)</label><br>
                        <input type="checkbox" name="Subjects[]" value="VB .NET" id="mVB"><label for="mVB">VB .NET</label><br>
                        <input type="checkbox" name="Subjects[]" value="DBMS" id="mDBMS"><label for="mDBMS">DBMS</label><br>
                    </div>
                    <div class="col-2">
                        <input type="checkbox" name="Subjects[]" value="C++ (language)" id="mC++"><label for="C++">C++ (language)</label><br>
                        <input type="checkbox" name="Subjects[]" value="PHP" id="mPHP"><label for="mPHP">PHP</label><br>
                        <input type="checkbox" name="Subjects[]" value="Comp. Organisation" id="mCO"><label for="mCO">Comp. Organisation</label><br>
                        <input type="checkbox" name="Subjects[]" value="ISD" id="mISD"><label for="mISD">ISD</label><br>
                    </div>
                    <div class="col-3">
                        <input type="checkbox" name="Subjects[]" value="Advanced Java (language)" id="Ajava"><label for="Ajava">Advanced Java (language)</label><br>
                        <input type="checkbox" name="Subjects[]" value="Linux OS" id="mLinux"><label for="mLinux">Linux OS</label><br>
                        <input type="checkbox" name="Subjects[]" value="SPM" id="mSPM"><label for="mSPM">SPM</label><br>
                        <input type="checkbox" name="Subjects[]" value="HCP" id="mHCP"><label for="mHCP">HCP</label><br>
                    </div>
                    <div class="col-4">
                        <input type="checkbox" name="Subjects[]" value="Javascript" id="mJS"><label for="mJS">Javascript</label><br>
                        <input type="checkbox" name="Subjects[]" value="E-commerce" id="mecom"><label for="mecom">E-commerce</label><br>
                        <input type="checkbox" name="Subjects[]" value="Comp. Networks" id="mCN"><label for="mCN">Comp. Networks</label><br>
                        <input type="checkbox" name="Subjects[]" value="Web development" id="mFWP"><label for="mFWP">Web development</label><br>
                    </div>
                </div>
                <div class="errors"><?php echo $errors["subjects"];?></div>
            </div>
            <label for="type">Type of Tutor</label>
            <select name="type">
                <option value="">Select</option>
                <option <?php if (isset($_POST['type']) && $_POST['type']=="Home") echo "selected='selected'";?> value="Home">Home</option>
                <option <?php if (isset($_POST['type']) && $_POST['type']=="Class Room") echo "selected='selected'";?> value="Class Room">Class Room</option>
                <option <?php if (isset($_POST['type']) && $_POST['type']=="Online") echo "selected='selected'";?> value="Online">Online</option>
                <option <?php if (isset($_POST['type']) && $_POST['type']=="Others") echo "selected='selected'";?> value="Other">Other</option>
            </select><br>
            <div class="errors"><?php echo $errors["type"];?></div>

            <label for="Experience">Experience</label>
            <input type="number" name="Exp" value="<?php echo $exp ;?>" placeholder="in years"><br>
            <div class="errors"><?php echo $errors["exp"];?></div>

            <label for="Days">Teaching days</label>
            <select name="days" id="Days">
                <option value="">Select</option>
                <option <?php if (isset($_POST['days']) && $_POST['days']=="Mon-Fri") echo "selected='selected'";?> value="Mon-Fri">Mon-Fri</option>
                <option <?php if (isset($_POST['days']) && $_POST['days']=="7 days a week") echo "selected='selected'";?> value="7 days a week">7 days a week</option>
                <option <?php if (isset($_POST['days']) && $_POST['days']=="3 days a week") echo "selected='selected'";?> value="3 days a week">3 days a week</option>                
            </select><br>   
            <div class="errors"><?php echo $errors["days"];?></div>

            <label for="Duration">Class Duration</label>
            <input type="number" name="duration" value="<?php echo $duration ;?>" placeholder="in hours"><br>
            <div class="errors"><?php echo $errors["duration"];?></div>

            <label for="lang">Teaching Language</label>
            <select name="lang" id="lang">
                <option value="">Select</option>
                <option <?php if (isset($_POST['lang']) && $_POST['lang']=="Hindi") echo "selected='selected'";?> value="Hindi">Hindi</option>
                <option <?php if (isset($_POST['lang']) && $_POST['lang']=="English") echo "selected='selected'";?> value="English">English</option>
                <option <?php if (isset($_POST['lang']) && $_POST['lang']=="Punjabi") echo "selected='selected'";?> value="Punjabi">Punjabi</option>
            </select><br>
            <div class="errors"><?php echo $errors["lang"];?></div>

            <label for="Fee">Fees per subject</label>
            <input type="text" name="fees" value="<?php echo $fees ;?>" placeholder="for per month"><br>
            <div class="errors"><?php echo $errors["fees"];?></div>

            <label for="facilities">Facilities you can provide</label><br>
            <input type="checkbox" name="facility[]" <?php echo $selected[1] ?>id="1" value="1"> 
            <label for="1">Free demo class for first day</label><br>
            <input type="checkbox" name="facility[]" <?php echo $selected[2] ?> id="2" value="2">
            <label for="2">Weekly tests</label><br>
            <input type="checkbox" name="facility[]" <?php echo $selected[3] ?> id="3" value="3">
            <label for="3">Monthly tests</label><br>
            <input type="checkbox" name="facility[]"<?php echo $selected[4] ?>  id="4" value="4">
            <label for="4">Notes (online/offline)</label><br>
            <input type="checkbox" name="facility[]" <?php echo $selected[5] ?> id="5" value="5">
            <label for="5">Doubt clearing classes</label><br>
            <input type="checkbox" name="facility[]" <?php echo $selected[6] ?> id="6" value="6">
            <label for="6">Revision tests</label><br>
            <div class="errors"><?php echo $errors["facilities"];?></div>

            <label for="Tagline">Tagline (This is important for your profile)</label><br>
            <textarea name="tagline" id="Tagline" cols="30" rows="10"><?php if(isset($_POST['tagline'])) { 
         echo htmlentities ($_POST['tagline']); }?></textarea><br>
            <div class="errors"><?php echo $errors["tagline"];?></div>

            <input type="submit" value="Submit" name="submit">
            <input type="reset" value="Reset" name="reset">
       
        </form>
    </div>

</div>
<div class="teacher-section">
            <h3>Follow us on</h3>
            <ul>
                <li><i class="fa fa-facebook-square" aria-hidden="true"></i></li>
                <li><i class="fa fa-instagram" aria-hidden="true"></i></li>
                <li><i class="fa fa-twitter-square" aria-hidden="true"></i></li>
                <li><i class="fa fa-linkedin-square" aria-hidden="true"></i></li>
            </ul>
            <h4>Copyrights Reserved 2020.</h4>
</div>
        <script src="javascript/sandbox.js"></script>
</body>

</html>