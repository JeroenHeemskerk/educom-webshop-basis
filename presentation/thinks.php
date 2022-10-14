<?php

function showContactThinks($data)
{
  $echoVal = "<div class='content'>
  <h1>we nemen contact zo snel mogelijk met u op</h1>
  <h3>U gegevens zijn : </h3>";
  foreach ($data as $key => $element) {
    if ($key != 'validForm'&& $key != 'page')
      $echoVal = $echoVal . '<div class="gegevensElement">
  <div class="elementBlock">' .  $key . '</div>
  <div class="elementBlock">' .  $element['value'] . '</div>
</div>';
  }
  $echoVal = $echoVal . "</div>";
  return $echoVal;
}
