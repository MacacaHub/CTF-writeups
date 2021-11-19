<?php
    session_start();
    $flag = 'flag{foods_for_big_meow_hacker}';
    
    if(!isset($_SESSION['username'])){
        header('Location:login.php');
        exit();
    }
    
    echo 'Hello, ' . $_SESSION['username'] . '<br>';
    
    if($_SESSION['username'] == 'hacker_meow'){
        echo $flag;
    }
    else{
        echo 'no flag for you';
    }
?>