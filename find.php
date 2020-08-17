<?php

      require("connection.php");
$name = $pincode = $email = $no_result = $Id =  "";
$vname = $vpincode = $vemail = false;
$errors = array("name" => "", "pincode" => "", "email" => "");

if(isset($_POST['submit'])){
    
    //Taking input from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pincode = $_POST['pincode'];

    //validating name
    if(empty($name)){
        $errors["name"] = "You cannot leave Name empty";
    }else{
        if(preg_match('/^[a-z ]+$/i',$name)){
            $vname = true;
        }else{
            $errors["name"] = "You can use only Characters";
        }
    }

    //validating email
    if(empty($email)){
        $errors["email"] = "You cannot leave Email empty";
    }else{
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $vemail = true;
        }else{
            $errors["email"] = "Please enter a valid email-id";
        }
    }

    //validating pincode
    if(empty($pincode)){
        $errors["pincode"] = "You cannot leave Pincode empty";
     }else{
         if(preg_match('/^[\d]{6}$/',$pincode)){
            $vpincode = true;
         }else{
            $errors["pincode"] = "Please enter a valid 6 digit pincode";
         }
    }

    if($vname && $vemail && $vpincode){
        $sql = "Select Id from teacher_info where Name='$name' && Email='$email' && Pincode='$pincode'";
        $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result) > 0){
               while($row = mysqli_fetch_array($result)){
                   $Id = $row['Id'];
               } 
               header("Location:review.php?Id=$Id");
    }else{
          $no_result = "No such record found!!!";
    }
}
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Find a tutor to Review</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css\find.css">
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
    <div class="form-container">
        <h2>Find the Teacher</h2>
        <h4>Teacher Details</h4>
        <form action="find.php" method="POST">
        <label for="name">Name</label> <br>   
        <input type="text" name="name" value="<?php echo $name;?>"><br>
        <div class="error"><?php echo $errors['name'];?></div>
        <label for="email">E-mail</label><br>
        <input type="email" name="email" value="<?php echo $email;?>"><br>
        <div class="error"><?php echo $errors['email'];?></div>
        <label for="pincode">Pincode</label><br>
        <input type="text" name="pincode" value="<?php echo $pincode;?>"><br>
        <div class="error"><?php echo $errors['pincode'];?></div>
        <input type="submit" value="Search" name="submit">
        <input type="reset" value="Reset" name="reset">

        </form>
         <div class="error"><?php echo $no_result;?></div>
         
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