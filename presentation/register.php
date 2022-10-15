<?php

function ShowRegisterForm($data)
{
  $formElements= '';
  foreach($data as $key  => $value){
    if(in_array($key , array('naam','email', 'wachtwoord', 'herhaaldWachtwoord'))){
    $spn = span($class='errSapn', $content= $value['error']);
    $formElements.=label($for = $key, $id = '', $class = '',b($value['label']) . $spn);
    $formElements.=input($type = $value['type'], $id = '', $value = $value['value'],  $name = $key, $class = 'inputText', $content = '', '', $placeholder = '');
  }}
  $container = h1('Sign Up'). p('vul jouw inlog gegevens in') . hr() .
  $formElements . 
  input($type = 'hidden', $id = 'page', $value = 'register', $name = 'page', $class = '', $content = '', '', $placeholder = '') . 
  div($class = 'clearfix', $content= input($type = 'submit', $id = '', $value = 'sturen', $name = '', $class = 'submit', $content = '', '', $placeholder = ''));

  $form=form($id = '', $action = 'index.php', $method = 'POST',div( $class ='container' ,$content =$container));
  $register = div($class = 'register', $content = $form);
  return $register;
   
}
