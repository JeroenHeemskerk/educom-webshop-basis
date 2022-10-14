<?php

//include('sharedPhpFunction.php');
//showLoginContent();

/*
function showLoginContent()
{
    $data = validateFormLogin();


    if ($data['validForm']) {
        $usersData = getDataFromFile('users/users.txt');
        if (checkEmailPassword($usersData, $data['email']['value'], $data['wachtwoord']['value']) == 1) {
            header("location:index.php?page=home");
        } else {
            $data['email']['error'] = ' email of wachtwoord is niet Correct';
            showLoginForm($data);
        }
    } else {
        showLoginForm($data);
    }
}


function validateFormLogin()
{

    $data = array(
        'validForm' => false,
        'email' => array('value' => '', 'error' => ''),
        'wachtwoord' => array('value' => '', 'error' => ''),

    );

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data['validForm'] = true;
        $data = setupData($data, 'email', $_POST['email'], '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/');
        $data = setupData($data, 'wachtwoord', $_POST['wachtwoord'], '/.{2,100}/');
    }

    return $data;
}

*/
//====================================//



function showLoginForm($data)
{
    return '
<div class="register" >
<form action="index.php" method="POST" style="border:1px solid #ccc">
  <div class="container">
    <h1>Sign Up</h1>
    <p>vul uw inlog gegevens in </p>
    <hr>
    <label for="email"><b>Email </b><span class="errSapn">' . $data['email']['error'] . '</span></label>
    <input class="inputText" type="text" placeholder="Vul je Email in" name="email" value="' . $data['email']['value'] . '">

    <label for="psw"><b>Password</b><span class="errSapn">' . $data['wachtwoord']['error'] . '</span></label>
    <input class="inputText" type="password" placeholder="vul je wachtwoord in" name="wachtwoord" value="' . $data['wachtwoord']['value'] . '">

    <input type="hidden" id="page" name="page" value="login" />
    <div class="clearfix">
      <input class="submit" type="submit" class="signupbtn" value="Log In">
    </div>
  </div>
</form>
</div>
';
}
