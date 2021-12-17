<?php
if(isset($_COOKIE['user']) && $_COOKIE['user'] == '5aa7e63c1b22'){
    echo 'flag{why_u_no_7he_p@55w0RD_5aa7e63c1b22}';
}
else{
    header("Location: /");
    exit();
}
