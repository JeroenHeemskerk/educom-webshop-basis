<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="contact.css" />
</head>

<body>
  <?php
  $aanhef = '';
  $naam = '';
  $email = '';
  $telefoonNumer = '';
  $voorkeurCommunicatie = '';
  $message = '';
  $naamErr = '';
  $emailErr = '';
  $telefoonNumerErr = '';
  $voorkeurCommunicatieErr = '';
  $messageErr = '';
  $errCont = 0;
  $bedanktBericht = '';

  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errCont == 0;

    //aanhef
    $aanhef = $_POST['aanhef'];
    //naam
    if (isset($_POST['naam'])) {

      if (preg_match("/^[a-zA-Z' ]*$/", trim($_POST['naam'])) && strlen(trim($_POST['naam'])) >= 2) {
        $naam = trim($_POST['naam']);
      } else {
        $naamErr = 'naam is niet correct';
        $errCont++;
      }
    } else {
      $naamErr = 'wat is jouw naam?';
      $errCont++;
    }

    //Email 
    if (isset($_POST['email'])) {

      if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = trim($_POST['email']);
      } else {
        $emailErr = 'Email is niet correct';
        $errCont++;
      }
    } else {
      $emailErr = 'wat is jouw Email?';
      $errCont++;
    }
    //telefoon 
    if (isset($_POST['telefoon'])) {

      if (preg_match("/^\+*[0-9]*$/", trim($_POST['telefoon']))&& strlen(trim($_POST['telefoon']))>9) {
        $telefoonNumer = trim($_POST['telefoon']);
      } else {
        $telefoonNumerErr = 'telefoon is niet correct';
        $errCont++;
      }
    } else {
      $telefoonNumerErr = 'wat is jouw telefoon?';
      $errCont++;
    }

    //bericht

    if (isset($_POST['bericht'])) {
      if (strlen(trim($_POST['bericht'])) > 3) {
        $message = trim($_POST['bericht']);
      } else {
        $messageErr = 'voeg een bericht toe';
        $errCont++;
      }
    } else {
      $messageErr = 'voeg een bericht toe';
      $errCont++;
    }



    if (isset($_POST['communicatievoorkeur'])) {
      $voorkeurCommunicatie =  $_POST['communicatievoorkeur'];
    } else {
      $voorkeurCommunicatieErr = 'kies een communicatie voorkeur';
      $errCont++;
    }
    if ($errCont > 0) {
      echo $errCont . "errors";
    } else {
      $bedanktBericht =  $aanhef . ' ' .  $naam . ' we nemen zo snel contact met u op  via uw ' . $voorkeurCommunicatie;

      $aanhef = '';
      $naam = '';
      $email = '';
      $telefoonNumer = '';
      $voorkeurCommunicatie = '';
      $message = '';
      $naamErr = '';
      $emailErr = '';
      $telefoonNumerErr = '';
      $voorkeurCommunicatieErr = '';
      $messageErr = '';
    }
  }

  ?>
  <div class="main">
    <nav class="head">
      <ul>
        <li><a href="./index.html"> HOME</a></li>
        <li><a href="./about.html"> ABOUT</a></li>
        <li><a href="./contact.php"> CONTACT</a></li>
      </ul>
    </nav>
    <h1 class="message"><?php echo $bedanktBericht  ?> </h1>
    <h1>Contact</h1>
    
    <div class="content"></div>
    <div class="formDiv">
      <label for="contactForm"> Neem contact met ons</label>
      <form class="formulier" id="contactForm" action="contact.php" method="POST">
        <div class="aanhefDiv">
          <label for="aanhef"> Aanhef</label>
          <select id="aanhef" name="aanhef" required>
            <option value="dhr">Dhr.</option>
            <option value="mvr">Mvr.</option>
          </select>
        </div>
        <div class="naamDiv">
          <label for="naam">naam : </label>
          <input class="naamInput" type="text" id="naam" name="naam" value="<?php echo $naam;  ?>" placeholder="jouw naam" />
          <span class="errSapn" style="color:red"><?php echo $naamErr;  ?></span>
        </div>
        <div class="emailDIv">
          <label for="email">email : </label>
          <input class="emailInput" type="email" id="email" name="email" value="<?php echo $email;  ?>" placeholder="jouw email" />
          <span class="errSapn"><?php echo $emailErr;  ?></span>
        </div>
        <div class="TelDiv">
          <label for="telefoon">Tel : </label>
          <input class="telInput" type="tel" id="telefoon" name="telefoon" value="<?php echo $telefoonNumer;  ?>" placeholder="jouw telefoon" />
          <span class="errSapn"><?php echo $telefoonNumerErr; ?></span>
        </div>
        <div class="communicatievoorkeurDiv">
          <label for="communicatievoorkeur">wat is jouw communicatievoorkeur?
          </label>
          <br />
          <input class="communicatievoorkeurInput" type="radio" id="communicatievoorkeurEmail" name="communicatievoorkeur" value="email" />
          <label for="communicatievoorkeurEmail">Email</label>

          <input type="radio" id="communicatievoorkeurTel" name="communicatievoorkeur" value="Telefoon" />
          <label for="communicatievoorkeurTel">Telefoon</label>
        </div>
        <span class="errSapn"><?php echo $voorkeurCommunicatieErr;  ?></span>
        <div class="berichtDiv">
          <label for="bericht">
            Laat ons weten waarover je contact wil opnemen</label>
          <br />
          <textarea class="BerichtInput" id="bericht" name="bericht" rows="4" cols="50">
          <?php echo $message;  ?>
            </textarea></br>
          <span class="errSapn"><?php echo $messageErr;  ?></span>
        </div>
        <div class="SubmetDiv">
          <input class="submitInput" type="submit" value="Sturen" />
        </div>
      </form>
    </div>
    <div class="footer">
      <footer>
        <p>&copy; 2022, Abdel</p>
      </footer>
    </div>
  </div>
</body>

</html>