<?php 

    //including connection file
    require("connection.php");

    //variables declaration
        $flag=0;
        $user = "";
        $username_error = "";
        $pwd = "";
        $email = "";
        $vuser = $vemail = $vpwd = false;
        $email_error = "";
        $errors = array("username" => "", "email" => "", "password" => "");


    //script that will run when user submits the form
    if(isset($_POST['Signup'])){


        //taking values from input fields

        $user = trim($_POST['username']);
        $email = trim($_POST['email']);
        $pwd = trim($_POST['pwd']);


        //validating data from input fields
        
        if(empty($user)){
            $errors["username"] = "You cannot leave username empty";
        }else{
            if(preg_match('/^[a-z\d@]{5,12}$/i',$user)){
                $vuser = true;
            }else{
                
                $errors["username"] = "username must be 5-12 characters alphanumeric and can containe @";
            }
        }


        if(empty($email)){
            $errors["email"]="You cannot leave email empty";
        }else{
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                $vemail = true;
            }else{
                $flag=1;
                $email_error = "Please enter a valid email address";
            }
        }


        if(empty($pwd)){
            $errors["password"]="You cannot leave password empty";
        }else{
            if(preg_match('/^[\w@]{8,12}$/',$pwd)){
                $vpwd = true;
            }else{
                $errors["password"] = "Password must be 8-12 characters alphanumeric and can contain @ _ ";
            }
        }


        //putting data into database if data is correct
        if($vuser && $vemail && $vpwd){
            $sql="SELECT * FROM login WHERE user_name='$user';";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                $flag=1;
                $username_error = "Username is already taken";
            }else{
                $sql = "INSERT INTO LOGIN(id,user_name,email_id,password) VALUES('default','$user','$email','$pwd');";
                $result = mysqli_query($conn,$sql);
                    if($result){
                        header("Location:result.php");
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
    <title>Sign Up</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css\signup.css">
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
                <li><a href="signin.php" title="SignIn for Tutors">SignIn</a></li>
                <li><a href="signup.php" title="Signup for Tutors" class="active">SignUp</a></li>
            </ul>

        </div>
        
</div>
<div class="form">
      <div class="form-container">
      <i id="user" class="fa fa-user-plus" aria-hidden="true"></i>
    <form action="signup.php" method="POST">
      <i class="fa fa-user" aria-hidden="true"></i><input type="text" name="username" placeholder="Username" value="<?php echo $user;?>"><br>
        <div class="error"><?php if($flag==1){echo $username_error;}else{echo $errors["username"];}?></div>
        <i class="fa fa-envelope" aria-hidden="true"></i><input type="Email" name="email" placeholder="Email" value="<?php echo $email;?>"><br>
        <div class="error"><?php if($flag==1){echo $email_error;}else{echo $errors["email"];}?></div>
        <i class="fa fa-key" aria-hidden="true"></i>  <input type="password" name="pwd" placeholder="Password" value="<?php echo $pwd;?>"><br>
        <div class="error"><?php echo $errors["password"];?></div>
        <input type="submit" value="Sign up" name="Signup">
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