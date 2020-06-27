<?php
    $error="";
    if($_POST){
       // $link = mysqli_connect("localhost","root","","secretdiary");
    

        if(!$_POST['email']){
            $error.="Email address is required!<br>";
            //echo "email,   ";
        }
        if(!$_POST['password']){
            $error.="Password is required!<br>";
           // echo "password  ";
        }
        if($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
            $error.="The email address is invalid.<br>";
        }
        if($error!=""){
            $error = '<div class="alert alert-danger col-sm-8 centered" role="alert">'.$error.'</div>';
        }else{
            $link = mysqli_connect("localhost","root","","secretdiary");
            if(!$link){
                echo "Not connected to the server";
            }
            if( mysqli_connect_error()){
                die("error!");
            }
            $query = "SELECT id FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1 ";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result)>0){
                $error = "The email address is taken.";
            } else{

                       // "  VALUES (' ','  ' ) "
                
               // $query = `INSERT INTO users (email, password) VALUES ( ${ mysqli_real_esc } )`                

                $query = "INSERT INTO users (email, password) VALUES ('". mysqli_real_escape_string($link, $_POST['email']) ."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
                if(!mysqli_query($link, $query)){
                    $error = "Couldn't sign up, try again later";
                }else{
                    $error = '<div class="alert alert-success col-sm-8 centered" role="alert">Sign up successfully</div>';
                    header("refresh:4; url=textArea.php");
                }
            }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documen23t</title>
    <link rel="stylesheet"  href="css.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    
</head>
<body>

        <div class="container" style="border: 5px solid green;  width:500px;">
            <h1 style="color: white;">Secret Diary</h1>
            <p id="any" style="color: white;">Store your thoughts permanently and securely</p>
            <div><?php echo $error; ?></div>
            <form method="POST">
                <div class="form-group">
                    <label id="userStateLabel" style="color: white;" for="emailInput">Interested? Sign up now!</label>
                    <input name="email" type="email" class="form-control col-sm-8 centered" id="emailInput">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control col-sm-8 centered" id="passwordInput">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label style="color: white;" class="form-check-label centered" for="rememberMe">Stay logged in</label>
                </div>
                <button id="submitButton" type="submit" class="btn btn-success">Sign up!</button>
                <p><a id="userStateLink" href="#">Log in</a></p>
            </form>
        </div>


    <script src="JavaScript.js"></script>

</body>
</html>