<?php
include("./dataAccessObject/user_repository.php");

function doesEmailExist($emil)
{
    return findUserByEmail($emil) == null ? false : true;
}


function authenticateUser($email,$password)
{
    $user=findUserByEmail($email);
    if(strcmp($user['password'],$password)==0){
        return $user;
    }
    return null;
}


function storeUser($user)
{
    saveUser($user);
    return 1;
}
