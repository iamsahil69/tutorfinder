<?php
   //starting session
   session_start();

   $name = "";
   $id = "";
   $error = "";
    //    for valid input
    $vname = $vage = $vgender = $vaddress = $vcity = $vstate = $vpincode = false;
    $vhq = $vspl = $vemail = $vphn = $vprofile = false; 
    //    Array for errors
    $errors = array(
        "Name" => "" ,
        "Age" => "",
        "Gender" => "",
        "Address"=>"",
        "City" => "",
        "State" => "",
        "HQ" => "",
        "Spl" => "",
        "Email" => "",
        "Phn" => "",
        "Profile" => "",
        "Pincode" => ""
    );
    $Name = $Age = $Gender = $Address = $City = $State = "";
    $Pincode = $Email = $HQ = $Phn = $Spl = $Profile = $newFileName = "";
    $fileName = $fileExt = $fileSize = $tmpAdd = $fileType = $fileDestination = "";
   if(isset($_POST["sign-out"])){
       session_unset();
       header("Location:signin.php");
   }
   if(isset($_SESSION['username'])){
       $id = $_SESSION['id'];
       $name = $_SESSION['username'];

       if(isset($_POST['submit'])){

            //Taking input from form
            $Name = $_POST["name"];
            $Age = $_POST["age"];
            $Gender = $_POST["gender"];
            $Address = $_POST["address"];
            $City = $_POST["city"];
            $State = $_POST["state"];
            $Pincode = $_POST["pincode"];
            $HQ = $_POST["HQ"];
            $Spl = $_POST["spl"];
            $Email = $_POST["email"];
            $Phn = $_POST["phn"];
            $Profile = $_FILES["profile"];
           
            //validating Name
            if(empty($Name)){
                $errors["Name"] = "You cannot leave Name empty";
            }else{
                if(preg_match('/^[a-z ]+$/i',$Name)){
                    $vname = true;
                }else{
                    $errors["Name"] = "You can use only Characters";
                }
            }

            //validating Gender
             if(empty($Gender)){
                $errors["Gender"] = "Please choose your gender";
            }else{
                $vgender = true;
            }

            //validating Age
             if(empty($Age)){
                $errors["Age"] = "You cannot leave Age empty";
            }else{
                if(preg_match('/^(1[89]|[2-5]\d)$/',$Age)){
                    $vage = true;
                }else{
                    $errors["Age"] = "Age can be between 18-59 years";
                }
            }

            //validating Address
             if(empty($Address)){
                $errors["Address"] = "You cannot leave Address empty";
            }else{
                if(preg_match('/^[a-z\d\.\s\-\,]+$/i',$Address)){
                    $vaddress = true;
                }else{
                    $errors["Address"] = "Please enter a valid address";
                }
            }

            //validating City
             if(empty($City)){
                $errors["City"] = "You cannot leave City empty";
            }else{
                if(preg_match('/^[a-z ]+$/i',$City)){
                    $vcity = true;
                }else{
                    $errors["City"] = "Please enter a valid City name"; 
                }
            }

            //validating State
             if(empty($State)){
                $errors["State"] = "You cannot leave State empty";
            }else{
                if(preg_match('/^[a-z ]+$/i',$State)){
                    $vstate = true;
                }else{
                    $errors["State"] = "Please enter a valid state name";
                }    
            }

            //validating Pincode
             if(empty($Pincode)){
                $errors["Pincode"] = "You cannot leave pincode empty";
             }else{
                 if(preg_match('/^[\d]{6}$/',$Pincode)){
                    $vpincode = true;
                 }else{
                    $errors["Pincode"] = "Please enter a valid 6 digit pincode";
                 }
             }

            //validating Higher qualification
             if(empty($HQ)){
                $errors["HQ"] = "Please select your higher education";
            }else{
                $vhq = true;
            }

            //validating Secialization
             if(empty($Spl)){
                $errors["Spl"] = "You cannot leave Specialization empty";
            }else{
                if(preg_match('/^[a-z ]+$/i',$Spl)){
                    $vspl = true;
                }else{
                    $errors["Spl"] = "Please enter a valid specialization";
                }             
            }

            //validating Email
             if(empty($Email)){
                $errors["Email"] = "You cannot leave email empty";
            }else{
                if(filter_var($Email,FILTER_VALIDATE_EMAIL)){
                    $vemail = true;
                }else{
                    $errors["Email"] = "Please enter a valid email-id";
                }
            }

            //validating Phone No
             if(empty($Phn)){
                $errors["Phn"] = "You cannot leave Phone No. empty";
            }else{
                if(preg_match('/^[\d]{10}$/',$Phn)){
                    $vphn = true;
                   
                }else{
                    $errors["Phn"] = "Please enter a valid 10 digit Phone No.";
                }
                
            }
            //validating Profile Picture
             if(empty($Profile["name"])){
                $errors["Profile"] = "Please Select your profile picture";
             }else{
                $allowed = array("jpeg","jpg","png"); 
                $fileName = $Profile["name"];
                $fileNameArr = explode(".",$fileName);
                $fileExt = strtolower(end($fileNameArr));
                if(!in_array($fileExt,$allowed)){
                    $errors["Profile"] = "Only jpeg jpg and png files are allowed";
                }else{
                    $fileSize = $Profile["size"];
                    $tmpAdd = $Profile["tmp_name"];
                    $fileType = $Profile["type"];
                    $newFileName = reset($fileNameArr).$id.".".$fileExt;
                    $fileDestination = "uploads/".$newFileName;
                    $vprofile = true;
                    
                 }
                }
                if($vname && $vage && $vgender && $vaddress && $vcity && $vstate && $vpincode && $vemail && $vphn && $vprofile && $vhq && $vspl){
                    require("connection.php");
                    $sql = "INSERT INTO teacher_info(id, Name, Gender, Age, Address, City, State, Pincode, Email , PhoneNo, Qualification, Specialization) VALUES($id,'$Name','$Gender',$Age,'$Address','$City','$State','$Pincode','$Email', $Phn ,'$HQ','$Spl')";
                    if(mysqli_query($conn,$sql)){
                        if(move_uploaded_file($tmpAdd,$fileDestination)){
                            $sql = "INSERT INTO profile_picture(id, image_name, Type, Size)VALUES('$id','$newFileName','$fileType','$fileSize')";
                            if(mysqli_query($conn,$sql)){
                               header("Location:Registration2.php");
                            }else{
                                echo "Profile data not uploaded successfully";
                            }
                        }else{
                            echo "profile not uploaded successfully";
                        }
                    }else{
                        echo "Data uploaded due to technical error Try again later";
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
    <title>Registration Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/registration.css">
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
        <h2>Basic Information</h2>
        <div class="error"><?php echo $error;?></div>
        <form id="basic_info" action="registration.php" method="POST" enctype="multipart/form-data">
            <label>Name</label><br>
            <input type="text" name="name" value="<?php echo $Name;?>"><br>
            <div class="error"><?php echo $errors['Name'];?></div>
            <label>Gender</label><br>
            <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender']=="Male") echo "checked";?> value="Male" id="Male"><label for="Male">Male</label><br>
            <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender']=="Female") echo "checked";?>  value="Female" id="Female"><label for="Female">Female</label><br>
            <div class="error"><?php echo $errors['Gender'];?></div>
            <label>Age</label><br>
            <input type="number" name="age" value="<?php echo $Age;?>"><br>
            <div class="error"><?php echo $errors['Age'];?></div>
            <label>Address</label><br>
            <textarea name="address" id="" cols="30" rows="10" value="<?php echo $Address;?>"> </textarea><br>
            <div class="error"><?php echo $errors['Address'];?></div>
            <label>City</label><br>
            <input type="text" name="city" value="<?php echo $City;?>"><br>
            <div class="error"><?php echo $errors['City'];?></div>
            <label>State</label><br>
            <input type="text" name="state" value="<?php echo $State;?>"><br>
            <div class="error"><?php echo $errors['State'];?></div>
            <label>Pincode</label><br>
            <input type="text" name="pincode" value="<?php echo $Pincode;?>"><br>
            <div class="error"><?php echo $errors['Pincode'];?></div>
            <label>Highest Qualification</label>
            <select name="HQ" id="">
                <option value="">Select</option>
                <option <?php if (isset($_POST['HQ']) && $_POST['HQ']=="12th") echo "selected='selected'";?> value="12th">12th</option>
                <option <?php if (isset($_POST['HQ']) && $_POST['HQ']=="Graduate") echo "selected='selected'";?>value="Graduate">Graduate</option>
                <option <?php if (isset($_POST['HQ']) && $_POST['HQ']=="Post-Graduate") echo "selected='selected'";?> value="Post-Graduate">Post-Graduate</option>
            </select><br>
            <div class="error"><?php echo $errors['HQ'];?></div>
            <label>Specialization</label><br>
            <input type="text" name="spl" value="<?php echo $Spl ;?>"><br>
            <div class="error"><?php echo $errors['Spl'];?></div>
            <label>Email</label><br>
            <input type="email" name="email" max="255" value="<?php echo $Email;?>"><br>
            <div class="error"><?php echo $errors['Email'];?></div>
            <label>Phone No.</label><br>
            <input type="text" name="phn" value="<?php echo $Phn;?>"><br>
            <div class="error"><?php echo $errors['Phn'];?></div>
            <label>Profile Picture</label>
            <input type="file" name="profile"><br><br>
            <div class="error"><?php echo $errors['Profile'];?></div>
            <input type="submit" name="submit" value="Submit">&nbsp &nbsp
            <input type="reset" value="Reset" name="Reset">           
           
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
    
</body>
</html>
