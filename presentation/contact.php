<?php


function ShowContactForm($data)
{
  return '<div class="contact ">
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
