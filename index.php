<?php
    session_start();
    $_SESSION['username']="rob";
    echo $_SESSION['username'];
    $email=$password="";
    if($_POST){
        if(!$_POST["email"])
            echo"Enter email<br>";
        else
            if($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) == false)
                echo"Invalid email address<br>";
            else
                $email=$_POST["email"];
        if(!$_POST["password"])
            echo"Enter password<br>";
        else
            $password=$_POST["password"];

        if($email && $password){
            print_r($_POST);

            $link = mysqli_connect("localhost","root","","firstData");
            if( mysqli_connect_error())
                die("error!");

            $query = "SELECT email FROM users WHERE email='".mysqli_real_escape_string($link,$email)."'";
            
            //$query = " INSERT INTO users (email, password) VALUES ( ";
            $result = mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0){
                echo"this email is already taken!<br>";
            }
            else{
                $query="INSERT INTO users (email, password) VALUES ('".mysqli_real_escape_string($link,$email)."','".mysqli_real_escape_string($link,$password)."')";
                if(mysqli_query($link,$query)){
                    $_SESSION['email'] = $_POST['email'];
                    header("Location: sessions/index.php");
                }

                else
                    echo"Not inserted !!!!!!!!!!<br>";
            }

        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">

        Email: <input type="email" id="email" name="email"><br><br>
        Password: <input type="password" id="password" name="password">
        <button type="submit">Go</button>
    </form>
</body>
</html>