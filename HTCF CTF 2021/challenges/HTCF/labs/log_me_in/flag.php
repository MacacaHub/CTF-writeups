<?php
    session_start();
    $flag = 'flag{u_are_sql_m4ster!}';
    
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