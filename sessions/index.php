<?php

    session_start();
    if($_SESSION['email']){
        echo"You're logged in!";
        header("refresh: 5; url=../index.php");
    }

?>