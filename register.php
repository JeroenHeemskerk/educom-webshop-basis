<?php

showRegisterContent();

function showRegisterContent()
{
  $data = validateFormRegister();

  if ($data['validForm']) {

    $dataArry = getDataFromFile('users/users.txt');

    if (checkDataArryIfContains($dataArry, 'email', $data['email']['value'])) {
      $data['email']['error'] = 'try other email';
      ShowContactForm($data);
    } else {
      putDataToFile('users/users.txt', $data);
      header("location:index.php?page=home");
    }
  } else {
    ShowContactForm($data);
  }
}
function checkDataArryIfContains($dataArry, $colName, $value)
{
  if (!array_search($value, array_column($dataArry, $colName)) == null) {
    return true;
  } else return false;
}

function getDataFromFile($fileName)
{
  $usersfile = fopen($fileName, "r");
  $fileContent = explode("\n", fread($usersfile, filesize("users/users.txt")));
  fclose($usersfile);

  $data = array();
  if (sizeof($fileContent) > 1) {
    $ColName = explode('|', $fileContent[0]);

    $ColName = array_map(function ($col) {
      preg_match("/\\[(.*?)\\]/", $col, $res);

      return  $res[1];
    }, $ColName);


    for ($lineNum = 1; $lineNum < sizeof($fileContent); $lineNum++) {
      $userDataString = explode('|', $fileContent[$lineNum]);
      $userDataArry = array();
      for ($col = 0; $col < sizeof($userDataString); $col++) {
        $userDataArry += [$ColName[$col] => $userDataString[$col]];
      }

      array_push($data, $userDataArry);
    }
  }
  return $data;
}
function putDataToFile($filename, $data)
{
  $newUser = array($data['email']['value'], $data['naam']['value'], $data['wachtwoord']['value']);
  $fileInput = implode("|", $newUser);
  $usersfile = fopen($filename, "a");
  fwrite($usersfile, "\n");
  fwrite($usersfile, $fileInput);
  fclose($usersfile);
}

function validateFormRegister()
{
  $GLOBALS['validForm'] = true;
  $data = array(
    'validForm' => false,
    'naam' => array('value' => '', 'error' => ''),
    'email' => array('value' => '', 'error' => ''),
    'wachtwoord' => array('value' => '', 'error' => ''),
    'herhaaldWachtwoord' => array('value' => '', 'error' => '')
  );

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data['naam'] = setNaam($_POST['naam']);
    $data['email'] = setEmail($_POST['email']);
    $data['wachtwoord'] = setWachtwoord($_POST['wachtwoord']);
    $data['herhaaldWachtwoord'] = setHerhaaldWachtwoordr($_POST['wachtwoord'], $_POST['herhaaldWachtwoord']);
    $data['validForm'] = $GLOBALS['validForm'];
  }

  return $data;
}


function setNaam($naam)
{
  if (preg_match("/^[1-9a-zA-Z@-_.$]*$/", trim($naam)) && strlen(trim($naam)) >= 2) {
    return array('value' => $naam, 'error' => '');
  } else {
    setValidForm(false);
    return array('value' => $naam, 'error' => 'Naam is niet valid');
  }
}



function setEmail($email)
{
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return array('value' => $email, 'error' => '');
  } else {
    setValidForm(false);
    return array('value' => $email, 'error' => 'Email is niet valid');
  }
}

function setWachtwoord($wachtwoord)
{
  if (preg_match("/^[0-9a-zA-Z' ]*$/", trim($wachtwoord)) && strlen(trim($wachtwoord)) >= 2) {
    return array('value' => $wachtwoord, 'error' => '');
  } else {
    setValidForm(false);
    return array('value' => $wachtwoord, 'error' => 'wachtwoord is niet valid');
  }
}
function setHerhaaldWachtwoordr($wachtwoord, $herhaaldWachtwoord)
{
  if (strcmp($wachtwoord, $herhaaldWachtwoord) == 0) {
    return array('value' => $herhaaldWachtwoord, 'error' => '');
  } else {
    setValidForm(false);
    return array('value' => $herhaaldWachtwoord, 'error' => 'het herhald wachtwoord is niet valid');
  }
}

function setValidForm($value)
{
  $GLOBALS['validForm'] = $value;
}


function ShowContactForm($data)
{
  echo '
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
