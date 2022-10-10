<?php

$requested_page = getRequestedPage();
showResponsePage($requested_page);


function getRequestedPage()
{
    $requested_type = $_SERVER['REQUEST_METHOD'];
    if ($requested_type == 'POST') {
        $requested_page = getPostVar('page','home');
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
    $nbrArgs=count(array_keys($_GET));
    if($nbrArgs==0)return 'home';
    return  $nbrArgs== 1 ? filter_input(INPUT_GET, $key) : $default;
}

function showResponsePage($request_page)
{

    switch ($request_page) {
        case 'home':
            echo_html_document(array("title" => "Home", "script" => "", "style" => "css/stylesheet.css"), 'showBodyHomeContent');
            break;
        case 'about':
            echo_html_document(array("title" => "about", "script" => "", "style" => "css/stylesheet.css"), 'showBodyAboutContent');
            break;
        case 'contact':
            echo_html_document(array("title" => "contact", "script" => "", "style" => "css/stylesheet.css"), 'showBodyContactContent');
            break;
        default : error_message('URL is niet geldig');
            
    }
}



function echo_html_document($head, $body)
{
    echo '<!DOCTYPE html>
    <html><head>' . 
    echoHead($head) . PHP_EOL;
    echo '</head>
    <body class="main">';
    echo_html_body($body) . PHP_EOL;
    echo '</body>
    </html>';
}

function echoHead($head)
{
    echo '
<script src="' . $head['script'] . '"></script>
<link rel="stylesheet" href="' . $head['style']  . '">
<title>' .  $head['title'] . '</title>
';
}


function echo_html_body($pageBody)
{
    showBodyHeader();
    $pageBody();
    showFooter();
}
function showBodyHeader()
{
    echo '
    <div class="head">
      <ul class="navLijst">
        <li class="navElement"><a href="./index.php?page=home"> HOME</a></li>
        <li class="navElement"><a href="./index.php?page=about"> ABOUT</a></li>
        <li class="navElement"><a href="./index.php?page=contact"> CONTACT</a></li>
      </ul>
    </div>';
}
function showFooter()
{
    echo '<div class="footer">
    <div>
      &nbsp; &copy; 2022, Abdel
    </div>
  </div>';
}
function showBodyHomeContent()
{
    include('./home.php');
}
function showBodyAboutContent()
{
    include('./about.php');
}
function showBodyContactContent()
{
    include('./contact.php');
}

function error_message($message)
{
    echo '<h2 style="color:red;">' . $message . '<h2>';
}

