<?php
function ShowContactForm($data)
{
 $formElements = h1('Contact') .  p('vul dit formulier in ') . hr();
  $formElements .= buildFormElementsFromData($data);
  $formElements .= input($type = 'hidden', $id = 'page', $value = 'contact', $name = 'page', $class = '', $content = '', '');
  $formElements .= input($type = 'submit', $id = 'submit', $value = 'sturen', $name = 'submit', $class = 'submit','', '');
  $formContainer = div('container', $formElements);
  $formC = form('contactForm', 'index.php', 'POST', $formContainer);
  $contact =  div('contact', $formC);
  return  $contact;
}
function buildFormElementsFromData($data)
{
  //print_r( $data);
  $formElements = '';
  foreach ($data['formFields'] as $key) {
    
    switch ($data[$key]['type']) {
      case 'select':
        $formElements .= label($key, '', '', $data[$key]['label']);
        for ($i = 0; $i < sizeof($data[$key]['options']); $i++)
          $data[$key]['options'][$i]['selected'] = ($data['aanhef']['value'] == $data[$key]['options'][$i]['value'] ? 'selected' : '');
        $formElements .= select('', $key, 'inputText', 'required', $data[$key]['options']);
        break;
      case 'text':
        $formElements .= label($key, '', '',  $data[$key]['label']);
        $formElements .= span('errSapn', $data[$key]['error']);
        $formElements .= input($data[$key]['type'], $key, $data[$key]['value'], $key, $class = 'inputText', $content = '','' ,  $data[$key]['placeholder']);
        break;
      case 'email':
        $formElements .= label($key, '', '',  $data[$key]['label']);
        $formElements .= span('errSapn', $data[$key]['error']);
        $formElements .= input($data[$key]['type'], $key, $data[$key]['value'], $key, $class = 'inputText', $content = '', '' , $data[$key]['placeholder']);
        break;
      case 'radio':
        $spn = span('errSapn', $data[$key]['error']);
        $formElements .= label($key, '', '',  $data[$key]['label'] . '  ' . $spn);
        foreach ($data[$key]['options'] as $opt => $val) {
         //echo "opt = " . $opt . "  ###val = " . $val . '   ####key = ' .  $key . '  ####data val = ' . $data[$key]['value']  . '<BR>';
          $rad = input('radio', $key . $opt, $value = $opt, $name = $key, $class = '', $content = $val, ($data[$key]['value'] == $opt ? 'checked' : ''));
          $formElements .= label($key . $val, '', '', $rad);
        }
        break;
        case 'textarea' : 
          $spn = span('errSapn', $data[$key]['error']);
          $formElements .= label($key, '', '',  $data[$key]['label'] .  ' ' . $spn );
          $formElements .=textarea($class = 'BerichtInput', $id = $key, $name = 'bericht', $message = $data['message']['value']);
        break;
          default : echo $data[$key]['type'] . "==default <BR>";
    }
  }
  return  $formElements;
}
