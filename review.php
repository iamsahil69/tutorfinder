<?php
  
      require("connection.php");
      
      $teacherName = $Address = $Exp = $tagline = $outcome = "";
      $Id = $profile_pic = $userName = $email = $stars = $comment = "";
      $vname = $vemail = $vstars = $vcomment = false;
      $errors = array( "Name" => "", "Email" => "", "stars" => "", "comment" => "");
      
      // Getting teachers data
      $Id = $_GET['Id'];
      
      $sql = "Select Name, Address from teacher_info where Id='$Id' ";
      $result = mysqli_query($conn,$sql);
      if($result){
           while($row = mysqli_fetch_array($result)){
              $teacherName = $row['Name'];
              $Address = $row['Address'];
             // $Exp = $row['Experience'];
              
           }
          $sql = "Select Tagline, Experience from teaching_info where Id='$Id'";
          $result = mysqli_query($conn,$sql);
          if($result){
              while($row = mysqli_fetch_array($result)){
                  $tagline = $row['Tagline'];
                  $Exp = $row['Experience'];
              
              }
              
             $sql = "Select image_name, Type from profile_picture where Id='$Id'";
                $result = mysqli_query($conn,$sql);
                if($result){
                while($row = mysqli_fetch_array($result)){
                $profile_pic = "uploads/".$row['image_name'];
                }
                
            }    
          }
      }
      if(isset($_POST['submit'])){
      
        // Taking data from the form
        $userName = $_POST['name'];
        $email = $_POST['email'];
        $stars = $_POST['stars'];
        $comment = $_POST['comment'];
        
        // validating data
        
        if(empty($userName)){
        $errors['Name'] = "You cannot leave Name empty";        
        }else{
          if(preg_match('/^[a-z ]+$/i', $userName)){
                $vname = true;
          }else{
                $errors['Name'] = "You can only use alphabets";
          }
        }
        
       if(empty($email)){
           $errors['Email'] = "You cannot leave email empty";  
       }  else{
          if(filter_var($email,FILTER_VALIDATE_EMAIL)){
             $vemail = true;
          }else{
          $errors['Email'] = "Please enter a valid email id";  
          }
       }
       
       if(empty($stars)){
         $errors['stars'] = "Please give star rating";
       }else{
          $vstars = true;
       }
        
       if(empty($comment)){
         $errors['comment'] = "Please give a comment";
       }else{
         if(preg_match('/^[\w\d ]+$/', $comment)){
            $vcomment = true;
         }else{
            $errors['comment'] = "You can only use Alphabets, digits, spaces";  
         }
       }
        
        if($vname && $vemail && $vstars && $vcomment){
        
        $sql = "Select * from teacher_review where Email_id='$email'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
         $outcome = "You have already reviewed this teacher";  
        }else{
           $sql = "Insert into teacher_review(id, Stu_name, email_id, review_stars, Comment) Values('$Id', '$userName','$email', '$stars', '$comment')"; 
                   $result = mysqli_query($conn,$sql);
                   if($result){
                      $outcome = " Your feedback recorded successfully !!!";
      
                   }  
        }
        
        
        }
        
        
      }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Review a Teacher</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css\review.css">
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
    <div class="container">
        <div class="profile">
            <div class="pic-info">
                <div class="pic">
                    <img src="<?php echo $profile_pic; ?>" alt="Teachers Image">
                </div>
                <div class="info">
                    <table border="0">
                    <tr><td><span class="head">Name:</span></td><td><span class="data"><?php echo $teacherName; ?></span></td></tr>
                    <tr><td><span class="head">Addess:</span></td><td><span class="data"><?php echo $Address; ?></span></td></tr>
                    <tr><td><span class="head">Experience:</span></td><td><span class="data"><?php echo $Exp." years"; ?></span></td></tr></table>
                    <p><?php echo $tagline; ?></p>
                </div>
            </div>
        </div>
        <h2>Your Details & Review</h2>
        <form action="review.php?Id=<?php echo $Id; ?>" method="POST">
            <label for="name">Name</label><br>
            <input type="text" name="name" value="<?php $userName;?>"><br>
            <div class="error"><?php echo $errors['Name'];?></div>
                     
            <label for="email">Email</label><br>
            <input type="email" name="email" value="<?php echo $email;?>"><br>
            <div class="error"><?php echo $errors['Email'];?></div>
                     
            <label for="stars">No. of stars</label>
            <select name="stars" id="stars" onchange="changeStar()">
                <option value="">Select</option>
                <option value="1" <?php if (isset($_POST['stars']) && $_POST['stars']=="1") echo "selected='selected'";?>>1</option>
                <option value="2" <?php if (isset($_POST['stars']) && $_POST['stars']=="2") echo "selected='selected'";?>>2</option>
                <option value="3" <?php if (isset($_POST['stars']) && $_POST['stars']=="3") echo "selected='selected'";?>>3</option>
                <option value="4" <?php if (isset($_POST['stars']) && $_POST['stars']=="4") echo "selected='selected'";?>>4</option>
                <option value="5" <?php if (isset($_POST['stars']) && $_POST['stars']=="5") echo "selected='selected'";?>>5</option>
            </select>
            <i class="fa fa-star" aria-hidden="true" id="star1"></i>
            <i class="fa fa-star" aria-hidden="true" id="star2"></i>
            <i class="fa fa-star" aria-hidden="true" id="star3"></i>
            <i class="fa fa-star" aria-hidden="true" id="star4"></i>
            <i class="fa fa-star" aria-hidden="true" id="star5"></i>
            <br>
            <div class="error"><?php echo $errors['stars'];?></div>
                     
            <label for="comment">Comment</label><br>
            <textarea name="comment" cols="30" rows="3"><?php if(isset($_POST['comment'])) { 
            echo htmlentities ($_POST['comment']); }?></textarea><br>
            <div class="error"><?php echo $errors['comment'];?></div>
                     
            <input type="submit" value="Submit" name="submit">
            <input type="reset" value="Reset" name="reset">
        <div class="error"><?php echo $outcome;?></div>
        
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
<script src="javascript/review.js"></script>
</body>
</html>