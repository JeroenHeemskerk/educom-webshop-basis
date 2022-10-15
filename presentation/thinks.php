<?php

function showContactThinks($data)
{
  $divContent = h1('we nemen contact zo snel mogelijk met u op');
  foreach ($data['formFields'] as $key) {
    $left= div('elementBlock',$key);
    $right = div('elementBlock',$data[$key]['value']);
    $divContent .=div('gegevensElement', $left . $right);
  }
  $echoVal = div($class = 'content', $content = $divContent);
  return $echoVal;
}
