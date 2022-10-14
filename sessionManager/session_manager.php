<?php

function user_login($user){
    if(!isset($_SESSION))session_start();
    $_SESSION['sid']=session_id();
    $_SESSION['email']=$user['email'];
    $_SESSION['naam'] = $user['naam'];

}

function do_user_logout(){
    if(!isset($_SESSION))session_start();
    session_unset();
    session_destroy();
}

function is_user_logged_in(){
    return isset($_SESSION['email']);
}
function get_logged_user_name(){
return $_SESSION['naam'];
}
function get_logged_user(){
    return findUserByEmail($_SESSION['email']);
}