<?php

session_start();
include("./presentation/components.php");
include("./presentation/layout.php");
include("./validations/validations.php");
include("./presentation/contact.php");
include("./presentation/thinks.php");
include("./presentation/register.php");
include("./presentation/login.php");
include("./presentation/home.php");
include("./presentation/about.php");
include("./sessionManager/session_manager.php");


$requested_page = getRequestedPage();
$data = processRequest($requested_page);
showResponsePage($data);


/**
 * 
 *  getRequestedPage
 * 
 */

function getRequestedPage()
{
    $requested_type = $_SERVER['REQUEST_METHOD'];
    if ($requested_type == 'POST') {
        $requested_page = getPostVar('page', 'home');
    } else {
        $requested_page = getUrlVar('page', 'other');
    }
    return $requested_page;
}

function getPostVar($key, $default = '')
{
    return getArrayVar($_POST, $key, $default);
}
function getArrayVar($array, $key, $default = '')
{
    return isset($array[$key]) ? $array[$key] : $default;
}

function getUrlVar($key, $default = 'other')
{
    $nbrArgs = count(array_keys($_GET));
    if ($nbrArgs == 0) return 'home';
    return  $nbrArgs == 1 ? filter_input(INPUT_GET, $key) : $default;
}

/**
 * 
 * 
 * processRequest($requested_page)
 * 
 */
function processRequest($requested_page)
{
    switch ($requested_page) {
        case 'contact':
            $data = validateContact();
            if ($data['validForm']) {
                $requested_page = 'thinks';
            }
            break;
        case 'register':
            $data = validateRegister();
            if ($data['validForm']) {
                $requested_page = 'login';
            }
            break;
        case 'login':
            $data = validateLogin();
            if ($data['validForm']) {
                $requested_page = 'home';
            }
            break;
        case 'logout':
            do_user_logout();
            $requested_page = 'home';
            break;
    }
    $data['page'] = $requested_page;
    return $data;
}

/**
 * 
 * showResponsePage
 * 
 */

function showResponsePage($data)
{

    switch ($data['page']) {
        case 'home':
            echo_html_document(array("title" => "Home", "script" => "", "style" => "css/stylesheet.css"),  showHomeBody());
            break;
        case 'about':
            echo_html_document(array("title" => "about", "script" => "", "style" => "css/stylesheet.css"), showAboutBody());
            break;
        case 'contact':
            echo_html_document(array("title" => "contact", "script" => "", "style" => "css/stylesheet.css"), ShowContactForm($data));
            break;
        case 'register':
            echo_html_document(array("title" => "Register", "script" => "", "style" => "css/stylesheet.css"), ShowRegisterForm($data));
            break;
        case 'login':
            echo_html_document(array("title" => "Log in", "script" => "", "style" => "css/stylesheet.css"), showLoginForm($data));
            break;
        case 'thinks':
            echo_html_document(array("title" => "Log in", "script" => "", "style" => "css/stylesheet.css"), showContactThinks($data));
            break;
        default:
            echo $data['page'] . ' URL is niet geldig';
    }
}
