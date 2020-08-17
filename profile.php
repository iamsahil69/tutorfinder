<?php

//starting session
session_start();

     require("connection.php");
     
     // declaring variables and arrays
     $name = $days = $fact = $Id = $age = $exp = $quali = $spec = $tagline = $class = $duration = $lang = $address = $phn = $email = $fees = $profile_pic = $type = $date  = "";
     $stars=$sum = $i = 0;
     $flag = false;
     $outcome = "";
     $facility = array();   
     $subjects = array();
     $names = $star = $comment = $time = $dates = array();
     $facilities = array(
        1 => "Free demo class for first day",
        2 => "Weekly tests",
        3 => "Monthly tests",
        4 => "Notes (online/offline)",
        5 => "Doubt clearing classes",
        6 => "Revision tests");
        
        
        
        if(isset($_POST["sign-out"])){
        session_unset();
        header("Location:signin.php");
        }
        if(isset($_SESSION['username'])){
        $Id = $_SESSION['id'];
        $name = $_SESSION['username'];
       
              $sql = "Select Name, Age, Address, City, State, Email, PhoneNo, Qualification, Specialization from teacher_info where Id='$Id'";
              $result = mysqli_query($conn,$sql);
              if($result){
                 while($row = mysqli_fetch_array($result)){
                     $name = $row['Name'];
                     $age = $row['Age'];
                     $address = $row['Address']."  ".$row['City']."  ".$row['State'];
                     $email = $row['Email'];
                     $phn = $row['PhoneNo'];
                     $quali = $row['Qualification'];
                     $spec = $row['Specialization'];
                 }  
              }
              
              $sql = "Select Language, Duration, Fees, Experience from teaching_info where Id='$Id'";    
              $result = mysqli_query($conn,$sql);  
              if($result){
              while($row = mysqli_fetch_array($result)){
              $lang = $row['Language'];      
              $fees = $row['Fees'];            
              $duration= $row['Duration'];           
              $exp = $row['Experience'];
              }      
              
              }
              
              
              $sql = "Select ClassCourse, Type, TeachingDays, Tagline, Facilities  from teaching_info where Id='$Id'";
              $result = mysqli_query($conn,$sql);  
              if($result){
                 while($row = mysqli_fetch_array($result)){
                     $class = $row['ClassCourse'];
                     $type= $row['Type'];
                     $days = $row['TeachingDays'];                        
                     $tagline = $row['Tagline'];  
                     $fact = $row['Facilities'];     
                }
                 $facility = explode(",", $fact);
              }
              
              $sql = "Select Subjects from subjects where Id='$Id' ";
              $result = mysqli_query($conn,$sql);
              if($result){
                  while($row = mysqli_fetch_array($result)){
                       array_push($subjects,$row['Subjects']);    
                  }
              }
              
              $sql = "Select Image_name from profile_picture where Id='$Id'";
              $result = mysqli_query($conn,$sql);
              if($result){
                    while($row = mysqli_fetch_array($result)){
                    $profile_pic = "uploads/".$row['Image_name'];    
                    }
              }
              
              $sql = "Select review_stars from teacher_review where Id='$Id'";
              $result = mysqli_query($conn,$sql);  
              if(mysqli_num_rows($result)>0){
                  while($row = mysqli_fetch_array($result)){
                       $sum = $sum + $row['review_stars'];
                       $i++; 
                  } 
                $stars = round($sum/$i);  
              }
              
              
        }
        
        
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher's Profile</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
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
    <h3><?php if(isset($_SESSION['username'])){ echo "Hi, ".$name; }?></h3> 
    </div>
    <div class="button">
    <form action="profile.php" method="post">
    <input type="submit" value="Sign-out" name="sign-out"><i class="fa fa-sign-out" aria-hidden="true"></i>
    </form>
    </div>   
    </div>
    <div class="profile">
    <h3>Profile</h3>
    <div class="pic-info">
        <div class="pic">
            <img src="<?php echo $profile_pic; ?>" alt="Teachers image">
            <div class="stars">
                <?php
                     for($i = 1; $i <= $stars; $i++){
                       echo "<i class=\"fa fa-star\" aria-hidden=\"true\"></i>"; 
                     }  
                ?>
                 
            </div>
        </div>
        <div class="info">    
            <span class="head">Name</span><span class="data"><?php echo $name; ?></span><br><br>
            <span class="head">Age</span><span class="data"><?php echo $age; ?> years</span><br><br>
            <span class="head">Experience</span><span class="data"><?php echo $exp; ?> years</span><br><br>
            <span class="head">Qualification</span><span class="data"><?php echo $quali; ?></span><br><br>
            <span class="head">Specialisation</span><span class="data"><?php echo $spec; ?></span><br><br>
        </div>
    </div>
    <div class="other-info">
    <h3>Tagline</h3>
        <p class="tagline">
            <?php echo $tagline; ?>
        </p>
    <h3>Teaching information</h3>
    <h4>Classes he/she can teach</h4>
        <span><?php echo $class; ?></span><br><br>
    <h4> Subjects he/she can teach</h4>
        <ul class="subjects">
            <?php
            foreach($subjects as $val){
            echo "<li>".$val."</li>";
            }
            ?>
        </ul>
    <h4>Teaching Days</h4> 
        <span><?php echo $days; ?></span><br><br>
        <h4>Duration of class</h4> 
        <span><?php echo $duration; ?> hours</span><br><br>
        <h4>Language of Teaching</h4> 
        <span><?php echo $lang; ?></span><br><br>
        <h4>Facilities he/she will provide</h4> 
        <ul class="facilities">
            <?php 
               foreach($facility as $val){
                 echo "<li>".$facilities[$val]."</li>";
               }  
            ?>
        </ul>
        
        <h3>Contacts</h3>
        <i class="fa fa-map-marker" aria-hidden="true"></i><span> <?php echo $address; ?></span> <br>
        <i class="fa fa-mobile" aria-hidden="true"></i><span> <?php echo $phn; ?></span><br>
        <i class="fa fa-envelope" aria-hidden="true"></i><span><?php echo $email; ?></span>
            </p>
        <a href="#">Reserve Class</a>
        <span class="fee">Fees <?php echo $fees; ?><i class="fa fa-inr" aria-hidden="true"></i></span>
         </div>
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
    
</body>
</html>