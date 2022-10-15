<?php



function showLoginForm($data)
{
    $formElements = '';
    foreach ($data['formFields'] as $element) {
        $spn = span($class = 'errSapn', $content = $data[$element]['error']);
        $formElements .= label($for = $element, $id = '', $class = '', b($data[$element]['label']) . $spn);
        $formElements .= input($type = $data[$element]['type'], $id = '', $value = $data[$element]['value'],  $name = $element, $class = 'inputText', $content = '', '', $placeholder = $value = $data[$element]['label']);
    }
    return div(
        $class = 'register',
        form(
            $id = '', $action = 'index.php',$method = 'POST',
            $content = 
            div( $class = 'container',
                h1('Sign Up') .
                    p('vul jouw inlog gegevens in') .
                    hr() .
                    $formElements .
                    input($type = 'hidden', $id = 'page', $value = 'login', $name = 'page', $class = '', $content = '', '', $placeholder = '') .
                    div($class = 'clearfix',  $content = input($type = 'submit', $id = '', $value = 'Login', $name = '', $class = 'submit', $content = '', '', $placeholder = ''))
            )
        )
    );

   
}
