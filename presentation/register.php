<?php

function ShowRegisterForm($data)
{
  return '
<div class="register" >
<form action="index.php" method="POST" style="border:1px solid #ccc">
  <div class="container">
    <h1>Sign Up</h1>
    <p>vul uw inlog gegevens in </p>
    <hr>
    <label for="naam"><b>Naam. </b> <span class="errSapn">' . $data['naam']['error'] . '</span></label>
    <input class="inputText" type="text" placeholder="Vul je naam in" name="naam" value="' . $data['naam']['value'] . '">

    <label for="email"><b>Email </b><span class="errSapn">' . $data['email']['error'] . '</span></label>
    <input class="inputText" type="text" placeholder="Vul je Email in" name="email" value="' . $data['email']['value'] . '">

    <label for="psw"><b>Password</b><span class="errSapn">' . $data['wachtwoord']['error'] . '</span></label>
    <input class="inputText" type="password" placeholder="vul je wachtwoord in" name="wachtwoord" value="' . $data['wachtwoord']['value'] . '">

    <label for="psw-repeat"><b>herhaal wachtwoord Password</b><span class="errSapn">' . $data['herhaaldWachtwoord']['error'] . '</span></label>
    <input class="inputText" type="password" placeholder="herhaal je wachtwoord" name="herhaaldWachtwoord" value="' . $data['herhaaldWachtwoord']['value'] . '">
    <input type="hidden" id="page" name="page" value="register" />
    <div class="clearfix">
      <input class="submit" type="submit" class="signupbtn" value="Sturen">
    </div>
  </div>
</form>
</div>
';
}
