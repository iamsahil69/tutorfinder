<?php 
    //starting session
    session_start();

    //including connection file
    require("connection.php");
        
    //variables declaration    
        $error = "";
        $errors = array("username" => "", "password" => ""); 
        $id = "";
        $user="";
        $username = "";
        $pwd="";
        $vuser = $vpwd = false;
    //it will run when user submits the form
    if(isset($_POST['SignIn'])){

        //taking data from input fields
        $user = trim($_POST['username']);
        $pwd = trim($_POST['pwd']);


        //validating data taken from input fields
        if(empty($user)){
            $errors["username"] = "You cannot leave username empty";
        }else{
            if(preg_match('/^[a-z\d@]{5,12}$/i',$user)){
                $vuser = true;
            }else{ 
                $errors["username"] = "username must be 5-12 characters alphanumeric and can contain @";
            }
        }

        if(empty($pwd)){
            $errors["password"] = "You cannot leave password empty";
        }else{
            if(preg_match('/^[\w@]{8,12}$/',$pwd)){
                $vpwd = true;
            }else{
                $errors["password"] = "Password must be 8-12 characters alphanumeric and can contain @ _ ";
            }
        }



        //
        if($vuser && $vpwd){
            $sql = "SELECT * FROM login WHERE user_name=\"$user\" AND password=\"$pwd\";";
            $result = mysqli_query($conn,$sql);
           // echo mysqli_num_rows($result);
                if(mysqli_num_rows($result) == 0){
                    $error = "Either username or password is incorrect ";
                }else{
                   
                    while($row = mysqli_fetch_array($result)){
                        $id = $row['id'];  
                        $username = $row['user_name'];   
                    }
                    echo $id;
                    $sql = "SELECT * FROM profile_picture WHERE id=\"$id\";";
                    $result2 = mysqli_query($conn,$sql);
                    if(mysqli_num_rows($result2)>0){
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $username;
                        header("Location:profile.php?id=$id");
                    }else{
                        $_SESSION['id'] = $id;
                        $_SESSION['username'] = $username;
                        header("Location:registration.php?id=$id");
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
    <title>Sign In</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css\signin.css">
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
                <li><a href="signin.php" class="active" title="SignIn for Tutors">SignIn</a></li>
                <li><a href="signup.php" title="Signup for Tutors">SignUp</a></li>
            </ul>

        </div>
        
</div>
<div class="form">
        <div class="form-container">
                <i id="user" class="fa fa-sign-in" aria-hidden="true"></i>
            <form action="signin.php" method="POST">
                <i class="fa fa-user" aria-hidden="true"></i><input type="text" name="username" placeholder="Username" value="<?php echo $user;?>"><br>
                <div class="error"><?php echo $errors['username'];?></div>
                <i class="fa fa-key" aria-hidden="true"></i>  <input type="password" name="pwd" placeholder="Password" value="<?php echo $pwd;?>"><br>
                <div class="error"><?php echo $errors['password'];?></div>
                <input type="submit" value="Sign In" name="SignIn">
                <div class="user-error"><?php echo $error;?></div>
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