<?php

showContactContent();

function showContactContent()
{
  $data = validateContact();
  if ($data['validForm']) {
    showContactThinks($data);
  } else {
    ShowContactForm($data);
  }
}

function validateContact()
{
  $GLOBALS['validForm'] = true;
  $data = array(
    'validForm' => false,
    'aanhef' => array('value' => '', 'error' => ''),
    'naam' => array('value' => '', 'error' => ''),
    'email' => array('value' => '', 'error' => ''),
    'telefoon' => array('value' => '', 'error' => ''),
    'communicatievoorkeur' => array('value' => '', 'error' => ''),
    'message' => array('value' => '', 'error' => '')
  );

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data['aanhef'] = setAanhef($_POST['aanhef']);
    $data['naam'] = setNaam($_POST['naam']);
    $data['email'] = setEmail($_POST['email']);
    $data['telefoon'] = settelefoon($_POST['telefoon']);
    $data['communicatievoorkeur'] = setCommunicatievoorkeur($_POST['communicatievoorkeur']);
    $data['message'] = setmessge($_POST['bericht']);
    $data['validForm'] = $GLOBALS['validForm'];
  }

  return $data;
}



function setAanhef($aanhef)
{
  if (strlen($aanhef) >= 0) {
    return array('value' => $aanhef, 'error' => '');
  } else {
    setValidForm(false);
    return array('value' => $aanhef, 'error' => 'aanhef is niet valid');
  }
}


function setNaam($naam)
{
  if (preg_match("/^[a-zA-Z' ]*$/", trim($naam)) && strlen(trim($naam)) >= 2) {
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



function settelefoon($telefoon)
{

  if (preg_match("/^\+*[0-9]*$/", trim($telefoon)) && strlen(trim($telefoon)) > 9) {
    return array('value' => $telefoon, 'error' => '');
  } else {
    setValidForm(false);
    return array('value' => $telefoon, 'error' => 'telefoon is niet valid');
  }
}



function setmessge($message)
{

  if (strlen(trim($message)) > 3) {
    return array('value' => $message, 'error' => '');
  } else {
    setValidForm(false);
    return array('value' => $message, 'error' => 'message is niet valid');
  }
}



function setCommunicatievoorkeur($communicatievoorkeur)
{
  if ($communicatievoorkeur) {
    return array('value' => $communicatievoorkeur, 'error' => '');
  } else {
    setValidForm(false);
    return array('value' => $communicatievoorkeur, 'error' => 'communicatievoorkeur is niet valid');
  }
}



function setValidForm($value)
{
  $GLOBALS['validForm'] = $value;
}



function ShowContactForm($data)
{
  echo '
  <div class="content">
      <h1>Contact</h1>

      <div class="formDiv">
        <label for="contactForm"> Neem contact met ons</label>
        <form class="formulier" id="contactForm" action="index.php" method="POST">
          <div class="aanhefDiv">
            <label for="aanhef"> Aanhef</label>
            <select id="aanhef" name="aanhef" required>
              <option value="dhr" >Dhr.</option>
              <option value="mvr">Mvr.</option>
            </select>
          </div>
          <div class="naamDiv">
            <label for="naam">naam : </label>
            <input  class="naamInput" type="text" id="naam" name="naam" value="' .  $data['naam']['value'] . '" placeholder="jouw naam" />
            <span class="errSapn" style="color:red">' .  $data['naam']['error'] . '</span>
          </div>
          <div class="emailDIv">
            <label for="email">email : </label>
            <input class="emailInput" type="email" id="email" name="email" value="' .  $data['email']['value'] . '" placeholder="jouw email" />
            <span class="errSapn">' .  $data['email']['error'] . '</span>
          </div>
          <div class="TelDiv">
            <label for="telefoon">Tel : </label>
            <input class="telInput" type="tel" id="telefoon" name="telefoon" value="' .  $data['telefoon']['value'] . '" placeholder="jouw telefoon" />
            <span class="errSapn">' .  $data['telefoon']['error'] . '</span>
          </div>
          <div class="communicatievoorkeurDiv">
            <label for="communicatievoorkeur">wat is jouw communicatievoorkeur?
            </label>
            <br />
            <input class="communicatievoorkeurInput" type="radio" checked id="communicatievoorkeurEmail" name="communicatievoorkeur" value="email" />
            <label for="communicatievoorkeurEmail">Email</label>
            
            <input type="radio" id="communicatievoorkeurTel" name="communicatievoorkeur" value="Telefoon" />
            <label for="communicatievoorkeurTel">Telefoon</label>
          </div>
          <span class="errSapn">' .  $data['communicatievoorkeur']['error'] . '</span>
          <div class="berichtDiv">
            <label for="bericht">
              Laat ons weten waarover je contact wil opnemen</label>
            <br />
            <textarea class="BerichtInput" id="bericht" name="bericht" rows="4" cols="50">
            ' .  $data['message']['value'] . '
            </textarea></br>
            <span class="errSapn">' .  $data['message']['error'] . '</span>
          </div>
          <input type="hidden" id="page" name="page" value="contact" />
          <div class="SubmetDiv">
            <input class="submitInput" type="submit" value="Sturen" />
          </div>
          
        </form>
      </div>
    </div>
  ';
}

function showContactThinks($data)
{
  $echoVal="<div class='content'>
  <h1>we nemen contact zo snel mogelijk met u op</h1>
  <h3>U gegevens zijn : </h3>";
foreach($data as $key => $element){
  if($key!='validForm')
  $echoVal = $echoVal . '<div class="gegevensElement">
  <div class="elementBlock">'.  $key . '</div>
  <div class="elementBlock">'.  $element['value'] . '</div>
</div>';
}
  $echoVal = $echoVal . "</div>";
  echo $echoVal;
  
}
