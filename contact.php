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
    $data['validForm']=true;
    $data=setupData($data,'aanhef',$_POST['aanhef'],'/^dhr$|^mvr$/');
    $data=setupData($data,'naam',$_POST['naam'],'/^[a-zA-Z-_\']{1,60}$/');
    $data=setupData($data,'email',$_POST['email'],'/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/');
    $data=setupData($data,'telefoon',$_POST['telefoon'],'/^0[1-9][0-9]{8}$|^\+[1-9][0-9][1-9][0-9]{8}$/');
    $data=setupData($data,'message',$_POST['bericht'],'/.{2,1000}/');
    $data=setupData($data,'communicatievoorkeur',$_POST['communicatievoorkeur'],'/^email$|^Telefoon$/');
    
   
  }

  return $data;
}


function setupData($data,$colnaam,$value='',$expression){
  if(preg_match($expression, trim($value))){
    $data[$colnaam]['value']=$value;
  }else {
    $data['validForm']=false;
    $data[$colnaam]['error']=$colnaam . ' is niet correct';
  }
  return $data;
}


function ShowContactForm($data)
{
  echo '<div class="contact ">
  <form style="border:1px solid #ccc" id="contactForm" action="index.php" method="POST">
      <div class="container">
          <h1>Contact</h1>
          <p> vul dit formulier in </p>
          <hr>
          <label for="aanhef"> Aanhef</label>
          <select class="inputText" id="aanhef" name="aanhef" required>
              <option value="dhr" ' . ($data['aanhef']['value']=='dhr'? 'selected': '') . '>Dhr.</option>
              <option value="mvr" ' . ($data['aanhef']['value']=='mvr'? 'selected': '') . '>Mvr.</option>
          </select>

          <label for="naam">naam : </label><span class="errSapn" style="color:red">' . $data['naam']['error'] . '</span>
          <input class="inputText" type="text" id="naam" name="naam" value="' .  $data['naam']['value'] . '" placeholder="jouw naam" />
          
          


          <label for="email">email : <span class="errSapn">' . $data['email']['error'] . '</span></label>
          <input class="inputText" type="text" id="email" name="email" value="' .  $data['email']['value'] . '" placeholder="jouw email" />
          
          

          <label for="telefoon">Tel : <span class="errSapn">' . $data['telefoon']['error'] . '</span></label>
          <input class="inputText" type="tel" id="telefoon" name="telefoon" value="' .  $data['telefoon']['value'] . '" placeholder="jouw telefoon" />
          

          <label for="communicatievoorkeur">wat is jouw communicatievoorkeur?
          <span class="errSapn">' . $data['communicatievoorkeur']['error'] . '</span>
          <br />
          <label for="communicatievoorkeurEmail">
          <input  type="hidden" ' . ($data['communicatievoorkeur']['value']? '': 'checked') . ' id="communicatievoorkeurEmail" name="communicatievoorkeur" value="" />
          <input  type="radio" ' . ($data['communicatievoorkeur']['value']=='email'? 'checked': '') . ' id="communicatievoorkeurEmail" name="communicatievoorkeur" value="email" />Email
          </label>
          <label for="communicatievoorkeurTel">
          <input  type="radio" ' . ($data['communicatievoorkeur']['value']=='Telefoon'? 'checked': '') . '  id="communicatievoorkeurTel" name="communicatievoorkeur" value="Telefoon" />Telefoon
          </label>
          
          
          <br />
          <label for="bericht">
              Laat ons weten waarover je contact wil opnemen. <span class="errSapn">' . $data['message']['error'] . '</span>
              </br>
          <textarea class="BerichtInput" id="bericht" name="bericht" rows="4" cols="50">
          ' .  $data['message']['value'] . '
          </textarea></label></br>
          

          <input type="hidden" id="page" name="page" value="contact" />

          <input class="submit" type="submit" value="Sturen">

      </div>
  </form>

</div>
  ';
}

function showContactThinks($data)
{
  $echoVal = "<div class='content'>
  <h1>we nemen contact zo snel mogelijk met u op</h1>
  <h3>U gegevens zijn : </h3>";
  foreach ($data as $key => $element) {
    if ($key != 'validForm')
      $echoVal = $echoVal . '<div class="gegevensElement">
  <div class="elementBlock">' .  $key . '</div>
  <div class="elementBlock">' .  $element['value'] . '</div>
</div>';
  }
  $echoVal = $echoVal . "</div>";
  echo $echoVal;
}
