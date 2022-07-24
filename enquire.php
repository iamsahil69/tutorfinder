<?php

        require("connection.php");

        //declaring variables
        $ques = $classCourse = $boardUni = $subject = $pincode = $outcome = $add = $pic ="";
        $flag = $vques = $vclass = $vboard = $vsubject = $vpincode = false;
        $errors = array( "ques" => "", "class" => "", "board" => "", "subject" => "", "pincode" => "");
            
        $filter1 = array();
        $filter2 = array();
        $filter3 = array();   
        $names = array();
        $address = $exp = $quali = $profile_pic = array();
          
     if(isset($_POST['submit'])){
          
          $ques = $_POST['ques'];
          
          if(empty($ques)){
              $errors['ques'] = "Please answer the question";    
          }else{
               $vques = true;
               if($ques == "school"){
                      $boardUni = $_POST['board'];
                      $classCourse = $_POST['class'];
                                  
                       if(empty($boardUni)){
                            $errors['board'] = "Please select a board";   
                       }else{
                            $vboard = true;   
                       }
                         
                     if(empty($classCourse)){
                            $errors['class'] = "Please select a class";  
                     }else{
                            $vclass = true;
                               
                            if($classCourse == "1st-5th"){
                                 $subject = $_POST['primary'];
                                 if(empty($subject)){
                                        $errors['subject'] = "Please select a subject ";      
                                 }else{
                                        $vsubject = true;         
                                 }     
                            }else if($classCourse == "6th-10th"){
                                 $subject = $_POST['secondary'];
                                  if(empty($subject)){
                                          $errors['subject'] = "Please select a subject ";      
                                  }else{
                                          $vsubject = true;         
                                  }               
                            }else{
                                  $subject = $_POST['higher-secondary'];
                                  if(empty($subject)){
                                         $errors['subject'] = "Please select a subject ";      
                                   }else{
                                         $vsubject = true;         
                                   } 
                           }
                     }
               }else{
                          $boardUni = $_POST['uni'];
                          $classCourse = $_POST['course'];
                              
                          if(empty($boardUni)){
                                $errors['board'] = "Please select a University";                
                          }else{
                                $vboard = true;     
                          }
                          
                          if(empty($classCourse)){
                                $errors['class'] = "Please select a course";
                          }else{
                                $vclass = true;
                                 
                                if($classCourse == "BCA"){
                                     $subject = $_POST['bca'];
                                            
                                    if(empty($subject)){
                                          $errors['subject'] = "Please select a subject ";      
                                    }else{
                                          $vsubject = true;         
                                    } 
                               }else if($classCourse == "B.Sc"){
                                    $subject = $_POST['bsc'];
                                           
                                     if(empty($subject)){
                                           $errors['subject'] = "Please select a subject ";      
                                     }else{
                                           $vsubject = true;         
                                     } 
                               
                               }else if($classCourse == "B.Com"){
                                     $subject = $_POST['bcom'];
                                             
                                      if(empty($subject)){
                                           $errors['subject'] = "Please select a subject ";      
                                      }else{
                                           $vsubject = true;         
                                      } 
                               
                               }else if($classCourse == "BBA"){
                                     $subject = $_POST['bba'];
                                                
                                      if(empty($subject)){
                                                $errors['subject'] = "Please select a subject ";      
                                      }else{
                                                $vsubject = true;         
                                     } 
                               
                               }else{
                                     $subject = $_POST['mscit'];
                                               
                                     if(empty($subject)){
                                             $errors['subject'] = "Please select a subject ";      
                                     }else{
                                             $vsubject = true;         
                                     } 
                               
                               }
                          
                          }
                             
               
               }
               
                     $pincode =$_POST['pincode'];
                     if(empty($pincode)){
                           $errors['pincode'] = "Please enter pincode";                   
                     }else{
                            if(preg_match('/^[\d]{6}$/',$pincode)){
                                 $vpincode = true; 
                            }else{
                                  $errors['pincode'] = "Please enter a valid 6-digit pincode";         
                            
                            }    
                     }
             }
             
             if($vques && $vclass && $vboard && $vsubject && $vpincode){
             
                    $sql = "Select Id from subjects where Subjects='$subject'";
                    $result = mysqli_query($conn,$sql); 
                       
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                              array_push($filter1,$row["Id"]);    
                               
                        }
                           
                            foreach($filter1 as $val){
                                 $sql = "Select Id from teaching_info where ClassCourse='$classCourse' && BoardUniv ='$boardUni' && Id='$val'";         
                                 $result1 = mysqli_query($conn,$sql);         
                                 if(mysqli_num_rows($result1)>0){
                                  
                                     while($row = mysqli_fetch_array($result1)){
                                          array_push($filter2,$row["Id"]); 
                                                        
                                     }          
                                 }
                            }
                          
                            foreach($filter2 as $val){
                                   $sql = "Select Id from teacher_info where pincode='$pincode' && Id='$val'";         
                                   $result = mysqli_query($conn,$sql);         
                                   if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                             array_push($filter3,$row["Id"]);                
                                         }          
                                   }                   

                            }
                            if(empty($filter1)  || empty($filter2) || empty($filter3)){
                                  $outcome = "No result found";     
                            }else{
                                     foreach($filter3 as $val){
                                           $sql1 = "Select Name, Address, City, Qualification from teacher_info where Id='$val'";             
                                           $sql2 = "Select Image_name from profile_picture where id='$val'";               
                                           $sql3 = "Select Experience from teaching_info where Id='$val'";              
                                     
                                           $result1 = mysqli_query($conn,$sql1);
                                           $result2 = mysqli_query($conn,$sql2);               
                                           $result3 = mysqli_query($conn,$sql3);               
                                                        
                                           if($result1){
                                                while($row = mysqli_fetch_array($result1)){
                                                     array_push($names,$row["Name"]);                     
                                                     $add = $row["Address"]." ".$row["City"];                   
                                                     array_push($address, $add);          
                                                     array_push($quali, $row["Qualification"]);   
                                                }                 
                                           }
                                           if($result2){
                                                    while($row = mysqli_fetch_array($result2)){
                                                         //$pic = "uploads\".$row["Image_name"]; 
                                                         $pic = "uploads/".$row['Image_name'];               
                                                          array_push($profile_pic, $pic);                                
                                                    }                   
                                           
                                           }
                                           
                                           if($result3){
                                                    while($row = mysqli_fetch_array($result3)){
                                                        array_push($exp, $row["Experience"]);                   
                                                    }                   
                                                    $flag = true;                                      
                                           }
                                     
                                     }         
                            }
                                                                           
                    }else{
                         $outcome = "No result found !!!";    
                    }
             
             }
       }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Find a Tutor</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css\enquire.css">
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
<div class="main-container"<?php if($flag){$temp = (count($names)*300)+500;echo "style=\"height: {$temp}px;\"";}?>>
    <div class="content">
        <h2>Your Requirements</h2>
        <form action="enquire.php" method="post">
           
            <label for="question">Q. What type of student you are ?</label><br>
            <input type="radio" name="ques" id="school" value="school" onclick="displayBox()" <?php if (isset($_POST['ques']) && $_POST['ques']=="school") echo "checked";?>><label for="school">School going</label><br>
            <input type="radio" name="ques" id="college" value="college" onclick="displayBox()" <?php if (isset($_POST['ques']) && $_POST['ques']=="college") echo "checked";?>><label for="college">College going</label><br>
           <div class="error"><?php echo $errors['ques'];?></div> 
            <div class="school-box">
            <label for="board">Board</label>
                <select name="board">
                    <option value="">Select</option>
                    <option value="CBSE" <?php if (isset($_POST['board']) && $_POST['board']=="CBSE") echo "selected='selected'";?> >CBSE</option>
                    <option value="ICSE" <?php if (isset($_POST['board']) && $_POST['board']=="ICSE") echo "selected='selected'";?> >ICSE</option>
                    <option value="PSEB" <?php if (isset($_POST['board']) && $_POST['board']=="PSEB") echo "selected='selected'";?> >PSEB</option>
                    <option value="HPSEB" <?php if (isset($_POST['board']) && $_POST['board']=="HPSEB") echo "selected='selected'";?> >HPSEB</option>
                    <option value="Other" <?php if (isset($_POST['board']) && $_POST['board']=="other") echo "selected='selected'";?> >Other</option>
                </select><br>
                <div class="error"><?php echo $errors['board'];?></div>
                <label for="class">Your Class lies in </label>
                <select name="class" id="class" onchange="showClassBox()">
                    <option value="">Select</option>
                    <option value="1st-5th" <?php if (isset($_POST['class']) && $_POST['class']=="1st-5th") echo "selected='selected'";?>>1st-5th</option>
                    <option value="6th-10th" <?php if (isset($_POST['class']) && $_POST['class']=="6th-10th") echo "selected='selected'";?>>6th-10th</option>
                    <option value="11th-12th" <?php if (isset($_POST['class']) && $_POST['class']=="11th-12th") echo "selected='selected'";?>>11th-12th</option>
                </select><br>
                <div class="error"><?php echo $errors['class'];?></div>
            </div>
            
            <div class="college-box">
            <label for="university">University</label>
                <select name="uni">
                    <option value="">Select</option>
                    <option value="PU" <?php if (isset($_POST['Uni']) && $_POST['Uni']=="PU") echo "selected='selected'";?>>Panjab University</option>
                    <option value="CU" <?php if (isset($_POST['Uni']) && $_POST['Uni']=="CU") echo "selected='selected'";?>>Chandigarh University</option>
                    <option value="LPU" <?php if (isset($_POST['Uni']) && $_POST['Uni']=="LPU") echo "selected='selected'";?>>LPU</option>
                    <option value="DU" <?php if (isset($_POST['Uni']) && $_POST['Uni']=="DU") echo "selected='selected'";?>>Delhi University</option>
                    <option value="Other" <?php if (isset($_POST['Uni']) && $_POST['Uni']=="Other") echo "selected='selected'";?>>Other</option>
                </select><br>
                <div class="error"><?php echo $errors['board'];?></div>
                <label for="Course">Course</label>
                <select name="course" onchange="showCourseBox()" id="course">
                <option value="">Select</option>
                <option value="BCA" <?php if (isset($_POST['course']) && $_POST['course']=="BCA") echo "selected='selected'";?>>BCA</option>
                <option value="B.Com" <?php if (isset($_POST['course']) && $_POST['course']=="B.Com") echo "selected='selected'";?>>B.Com</option>
                <option value="B.Sc" <?php if (isset($_POST['course']) && $_POST['course']=="B.Sc") echo "selected='selected'";?>>B.Sc</option>
                <option value="BBA" <?php if (isset($_POST['course']) && $_POST['course']=="BBA") echo "selected='selected'";?>>BBA</option>
                <option value="M.Sc IT" <?php if (isset($_POST['course']) && $_POST['course']=="M.Sc IT") echo "selected='selected'";?>>M.Sc IT</option>
                </select><br>
            <div class="error"><?php echo $errors['subject'];?></div>
            </div>
            
            <div class="primary">
            <label for="primary">Subjects for classes 1st-5th</label>
            <select name="primary" id="">
                    <option value="">Select</option>
                    <option value="Hindi" <?php if (isset($_POST['primary']) && $_POST['primary']=="Hindi") echo "selected='selected'";?> >Hindi</option>
                    <option value="Drawing" <?php if (isset($_POST['primary']) && $_POST['primary']=="Drawing") echo "selected='selected'";?> >Drawing</option>
                    <option value="English" <?php if (isset($_POST['primary']) && $_POST['primary']=="English") echo "selected='selected'";?> >English</option>
                    <option value="Punjabi" <?php if (isset($_POST['primary']) && $_POST['primary']=="Punjabi") echo "selected='selected'";?> >Punjabi</option>
                    <option value="E.V.S" <?php if (isset($_POST['primary']) && $_POST['primary']=="E.V.S") echo "selected='selected'";?> >E.V.S</option>
            </select>
            <div class="error"><?php echo $errors['subject'];?></div>
            </div>
            <div class="secondary">
            <label for="secondary">Subjects for classes 6th-10th</label>
             <select name="secondary" id="">       
                    <option value="">Select</option>
                    <option value="Mathematics" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="Mathematics") echo "selected='selected'";?> >Mathematics</option>
                    <option value="English" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="English") echo "selected='selected'";?> >English</option>
                    <option value="Drawing" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="Drawing") echo "selected='selected'";?> >Drawing</option>
                    <option value="Science" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="Science") echo "selected='selected'";?> >Science</option>
                    <option value="Hindi" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="Hindi") echo "selected='selected'";?> >Hindi</option>
                    <option value="Political" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="Political") echo "selected='selected'";?> >Political</option>
                    <option value="History" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="History") echo "selected='selected'";?> >History</option>
                    <option value="Sanskrit" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="Sanskrit") echo "selected='selected'";?> >Sanskrit</option>
                    <option value="Punjabi" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="Punjabi") echo "selected='selected'";?> >Punjabi</option>
                    <option value="Civics" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="Civics") echo "selected='selected'";?> >Civics</option>
                    <option value="Music" <?php if (isset($_POST['secondary']) && $_POST['secondary']=="Music") echo "selected='selected'";?> >Music</option>
                    <option value="Home Sci." <?php if (isset($_POST['secondary']) && $_POST['secondary']=="Home Sci.") echo "selected='selected'";?> >Home Sci.</option>
             </select>
            <div class="error"><?php echo $errors['subject'];?></div>
            </div>
            <div class="higher-secondary">
            <label for="higher-secondary">Subjects for classes 11th-12th</label>
            <select name="higher-secondary" id="">
                <option value="">Select</option>
                <option value="Mathematics" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Mathematics") echo "selected='selected'";?> >Mathematics</option>
                <option value="Comp. Sci." <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Comp. Sci.") echo "selected='selected'";?> >Comp. Sci.</option>
                <option value="Accountancy" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Accountancy") echo "selected='selected'";?> >Accountancy</option>
                <option value="Economics" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Economics") echo "selected='selected'";?> >Economics</option>
                <option value="Chemistry" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Chemistry") echo "selected='selected'";?> >Chemistry</option>
                <option value="Sociology" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Sociology") echo "selected='selected'";?> >Sociology</option>
                <option value="Statistics" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Statistics") echo "selected='selected'";?> >Statistics</option>
                <option value="Business Studies" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Bussiness Studies") echo "selected='selected'";?> >Business Studies</option>
                <option value="Physics" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Physics") echo "selected='selected'";?> >Physics</option>
                <option value="Physiology" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Physiology") echo "selected='selected'";?> >Physiology</option>
                <option value="Business Law" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Bussiness Law") echo "selected='selected'";?> >Business Law</option>
                <option value="Music" <?php if (isset($_POST['board']) && $_POST['higher-secondary']=="Music") echo "selected='selected'";?> >Music</option>
                <option value="Biology" <?php if (isset($_POST['higher-secondary']) && $_POST[' higher-secondary']=="Biology") echo "selected='selected'";?> >Biology</option>
                <option value="Phy. Edu." <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Phy. Edu.") echo "selected='selected'";?> >Phy. Edu.</option>
                <option value="Taxes" <?php if (isset($_POST['higher-secondary']) && $_POST['higher-secondary']=="Taxes") echo "selected='selected'";?> >Taxes</option>
            </select>
            <div class="error"><?php echo $errors['subject'];?></div>
            </div>
            <div class="bca">
                <label for="bca">Subjects for BCA</label>
                <select name="bca" id="">
                    <option value="">Select</option>
                    <option value="Data Structure" <?php if (isset($_POST['bca']) && $_POST['bca']=="Data Structures") echo "selected='selected'";?> >Data Structures</option>
                    <option value="C (language)" <?php if (isset($_POST['bca']) && $_POST['bca']=="C (language)") echo "selected='selected'";?> >C (language)</option>
                    <option value="VB .NET" <?php if (isset($_POST['bca']) && $_POST['bca']=="VB.NET") echo "selected='selected'";?> >VB .NET</option>
                    <option value="DBMS" <?php if (isset($_POST['bca']) && $_POST['bca']=="DBMS") echo "selected='selected'";?> >DBMS</option>
                    <option value="C++ (language)" <?php if (isset($_POST['bca']) && $_POST['bca']=="C++ (language)") echo "selected='selected'";?> >C++ (language)</option>
                    <option value="PHP" <?php if (isset($_POST['bca']) && $_POST['bca']=="PHP") echo "selected='selected'";?> >PHP</option>
                    <option value="Comp. Organisation" <?php if (isset($_POST['bca']) && $_POST['bca']=="Comp. Organisation") echo "selected='selected'";?> >Comp. Organisation</option>
                    <option value="ISD" <?php if (isset($_POST['bca']) && $_POST['bca']=="ISD") echo "selected='selected'";?> >ISD</option>
                    <option value="Java (language)" <?php if (isset($_POST['bca']) && $_POST['bca']=="Java (language)") echo "selected='selected'";?> >Java (language)</option>
                    <option value="Linux OS" <?php if (isset($_POST['bca']) && $_POST['bca']=="Linus OS") echo "selected='selected'";?> >Linux OS</option>
                    <option value="SPM" <?php if (isset($_POST['bca']) && $_POST['bca']=="SPM") echo "selected='selected'";?> >SPM</option>
                    <option value="HCP" <?php if (isset($_POST['bca']) && $_POST['bca']=="HCP") echo "selected='selected'";?> >HCP</option>
                    <option value="Javascript" <?php if (isset($_POST['bca']) && $_POST['bca']=="Javascript") echo "selected='selected'";?> >Javascript</option>
                    <option value="E-commerce" <?php if (isset($_POST['bca']) && $_POST['bca']=="E-commerce") echo "selected='selected'";?> >E-commerce</option>
                    <option value="Comp. Networks" <?php if (isset($_POST['bca']) && $_POST['bca']=="Comp. Networks") echo "selected='selected'";?> >Comp. Networks</option>
                    <option value="Web development" <?php if (isset($_POST['bca']) && $_POST['bca']=="Web development") echo "selected='selected'";?> >Web development</option>
                </select>
            <div class="error"><?php echo $errors['subject'];?></div>
            </div>
            <div class="bcom">
            <label for="bcom">Subjects for B.Com</label>
                <select name="bcom" id="">
                    <option value="">Select</option>
                    <option value="Accounts" <?php if (isset($_POST['bcom']) && $_POST['bcom']=="Accounts") echo "selected='selected'";?> >Accounts</option>
                    <option value="Commercial Law" <?php if (isset($_POST['bcom']) && $_POST['bcom']=="Commercial Law") echo "selected='selected'";?> >Commercial Law</option>
                    <option value="Business Studies" <?php if (isset($_POST['bcom']) && $_POST['bcom']=="Bussiness Studies") echo "selected='selected'";?> >Business Studies</option>
                    <option value="Macro Economics" <?php if (isset($_POST['bcom']) && $_POST['bcom']=="Macro Economics") echo "selected='selected'";?> >Macro Economics</option>
                    <option value="Indirect Tax" <?php if (isset($_POST['bcom']) && $_POST['bcom']=="Indirect Tax") echo "selected='selected'";?> >Indirect Tax</option>
                    <option value="Company Law" <?php if (isset($_POST['bcom']) && $_POST['bcom']=="Company Law") echo "selected='selected'";?> >Company Law</option>
                    <option value="Micro Economics" <?php if (isset($_POST['bcom']) && $_POST['bcom']=="Micro Economics") echo "selected='selected'";?> >Micro Economics</option>
                    <option value="Human Resource Mang." <?php if (isset($_POST['bcom']) && $_POST['bcom']=="Human  Resource Mang.") echo "selected='selected'";?> >Human Resource Mang.</option>
                    <option value="E-commerce" <?php if (isset($_POST['bcom']) && $_POST['bcom']=="E-commerce") echo "selected='selected'";?> >E-commerce</option>
                    <option value="Direct Tax" <?php if (isset($_POST['bcom']) && $_POST['bcom']=="Direct Tax") echo "selected='selected'";?> >Direct Tax</option>
                </select>
            <div class="error"><?php echo $errors['subject'];?></div>
            </div>
            <div class="bba">
            <label for="bba">Subjects for BBA</label>
                <select name="bba" id="">
                    <option value="">Select</option>
                    <option value="Accounts" <?php if (isset($_POST['bba']) && $_POST['bba']=="Accounts") echo "selected='selected'";?> >Accounts</option>
                    <option value="Commercial Law" <?php if (isset($_POST['bba']) && $_POST['bba']=="Commercial Law") echo "selected='selected'";?> >Commercial Law</option>
                    <option value="Business Studies" <?php if (isset($_POST['bba']) && $_POST['bba']=="Bussiness Studies") echo "selected='selected'";?> >Business Studies</option>
                    <option value="Macro Economics" <?php if (isset($_POST['bba']) && $_POST['bba']=="Macro Economics") echo "selected='selected'";?> >Macro Economics</option>
                    <option value="Indirect Tax" <?php if (isset($_POST['bba']) && $_POST['bba']=="Indirect Tax") echo "selected='selected'";?> >Indirect Tax</option>
                    <option value="Company Law" <?php if (isset($_POST['bba']) && $_POST['bba']=="Companny Law") echo "selected='selected'";?> >Company Law</option>
                    <option value="Micro Economics" <?php if (isset($_POST['bba']) && $_POST['bba']=="Micro Economics") echo "selected='selected'";?> >Micro Economics</option>
                    <option value="Human Resource Mang." <?php if (isset($_POST['bba']) && $_POST['bba']=="Human Resource Mang.") echo "selected='selected'";?> >Human Resource Mang.</option>
                    <option value="E-commerce" <?php if (isset($_POST['bba']) && $_POST['bba']=="E-commerce") echo "selected='selected'";?> >E-commerce</option>
                    <option value="Direct Tax" <?php if (isset($_POST['bba']) && $_POST['bba']=="Direct Tax") echo "selected='selected'";?> >Direct Tax</option> 
                </select>
            <div class="error"><?php echo $errors['subject'];?></div>
            </div>
            <div class="mscit">
                <label for="mscit">Subjects for MSC-IT</label>
                <select name="mscit" id="">
                    <option value="">Select</option>
                    <option value="Adv. Data Structure" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="Adv. Data Structures") echo "selected='selected'";?> >Adv. Data Structures</option>
                    <option value="C (language)" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="C (language)") echo "selected='selected'";?> >C (language)</option>
                    <option value="VB .NET" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="VB.NET") echo "selected='selected'";?> >VB .NET</option>
                    <option value="DBMS" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="DBMS") echo "selected='selected'";?> >DBMS</option>
                    <option value="C++ (language)" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="C++ (language)") echo "selected='selected'";?> >C++ (language)</option>
                    <option value="PHP" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="CBSE") echo "selected='selected'";?> >PHP</option>
                    <option value="Comp. Organisation" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="Comp. Organisation") echo "selected='selected'";?> >Comp. Organisation</option>
                    <option value="ISD" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="ISD") echo "selected='selected'";?> >ISD</option>
                    <option value="Advanced Java (language)" <?php if (isset($_POST['mscit']) && $_POST['board']=="Advanced java (language)") echo "selected='selected'";?> >Advanced Java (language)</option>
                    <option value="Linux OS" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="Linux OS") echo "selected='selected'";?> >Linux OS</option>
                    <option value="SPM" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="SPM") echo "selected='selected'";?> >SPM</option>
                    <option value="HCP" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="HCP") echo "selected='selected'";?> >HCP</option>
                    <option value="Javascript" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="Javascript") echo "selected='selected'";?> >Javascript</option>
                    <option value="E-commerce" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="E-commerce") echo "selected='selected'";?> >E-commerce</option>
                    <option value="Comp. Networks" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="Comp. Networks") echo "selected='selected'";?> >Comp. Networks</option>
                    <option value="Web development" <?php if (isset($_POST['mscit']) && $_POST['mscit']=="Web development") echo "selected='selected'";?> >Web development</option>
                </select>
            <div class="error"><?php echo $errors['subject'];?></div>
            </div>
            <div class="bsc">
                <label for="bsc">Subjects for B.Sc</label>
                <select name="bsc" id="">
                     <option value="">Select</option> 
                    <option value="Inorganic Chemistry" <?php if (isset($_POST['bsc']) && $_POST['bsc']=="Inorganic Chemistry") echo "selected='selected'";?> >Inorganic Chemistry</option>
                    <option value="Organic Chemistry" <?php if (isset($_POST['bsc']) && $_POST['bsc']=="Organic Chemistry") echo "selected='selected'";?> >Organic Chemistry</option>
                    <option value="Plane Geometry" <?php if (isset($_POST['bsc']) && $_POST['bsc']=="Plane Geometery") echo "selected='selected'";?> >Plane Geometry</option>
                    <option value="Mechanics" <?php if (isset($_POST['bsc']) && $_POST['bsc']=="Mechanics") echo "selected='selected'";?> >Mechanics</option>
                    <option value="Physical Chemistry" <?php if (isset($_POST['bsc']) && $_POST['bsc']=="Physical Chemistry") echo "selected='selected'";?> >Physical Chemistry</option>
                    <option value="Electricity & Magnetism" <?php if (isset($_POST['bsc']) && $_POST['bsc']=="Electricity & Magnetism") echo "selected='selected'";?> >Electricity & Magnetism</option>
                    <option value="Mathematics" <?php if (isset($_POST['bsc']) && $_POST['bsc']=="Mathematics") echo "selected='selected'";?> >Mathematics</option>
                    <option value="Physics" <?php if (isset($_POST['bsc']) && $_POST['bsc']=="Physics") echo "selected='selected'";?> >Physics</option>
                </select>
            <div class="error"><?php echo $errors['subject'];?></div>
            </div>
            <label for="pincode">Pincode</label>
            <input type="text" name="pincode"><br>
          <div class="error"><?php echo $errors['pincode'];?></div>   
            <input type="submit" value="Search" name="submit">
            <input type="reset" value="Resest" name="Reset">

        </form>
        <div class="error"><?php echo $outcome;?></div>
           
    </div>

    <?php
           if($flag){
               $no = count($filter3);
               for($i =0 ;$i <= $no-1; $i++){
                     echo "<div class=\"card\">"; 
                     echo "<div class=\"picture\">";   
                     echo "<img src=\"{$profile_pic[$i]}\" alt=\"teachers image\">"; 
                     echo "</div>";   
                     echo "<div class=\"info\">";    
                     echo "<span class=\"detail\"> Name   ".$names[$i]."</span><br><br>";  
                     echo "<span class=\"detail\"> Experience   ".$exp[$i]." years</span><br><br>";  
                     echo "<span class=\"detail\"> Qualification   ".$quali[$i]."</span><br><br>";  
                     echo "<span class=\"detail\"> Address   ".$address[$i]."</span><br><br>";  
                     echo "<a class=\"link\" href=\"profile2.php?Id={$filter3[$i]}\" > view profile </a>";    
                     echo "</div>";             
                     echo "</div>";    
               }
           }
    
    
    ?>


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
<script src="javascript/enquire.js"></script>
</body>
</html>
