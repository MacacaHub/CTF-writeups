<?php
    session_start();
    $flag = 'flag{Ohhh_u_p45s_the_W4F!!!!}';
    
    if(!isset($_SESSION['username'])){
        header('Location:login.php');
        exit();
    }
    
    echo 'Hello, ' . $_SESSION['username'] . '<br>';
    
    if($_SESSION['username'] == 'admin'){
        echo $flag;
    }
    else{
        echo 'no flag for you';
    }
?>