<?php
function echo_html_document($head, $body)
{
  echo '<!DOCTYPE html>
    <html><head>' .
    echoHead($head) . PHP_EOL;
  echo '</head>
    <body class="body">';
  echo_html_body($body) . PHP_EOL;
  echo '</body>
    </html>';
}
//don
function echoHead($head)
{
  echo '
<script src="' . $head['script'] . '"></script>
<link rel="stylesheet" href="' . $head['style']  . '">
<title>' .  $head['title'] . '</title>
';
}

//don
function echo_html_body($pageBody)
{
  echo showBodyHeader();
  echo $pageBody;
  showFooter();
}
//don
function showBodyHeader()
{

  $extra_elements_if_user_logged_in = '
  <li class="navElement"><a href="./index.php?page=about"> ABOUT</a></li>
  <li class="navElement"><a href="./index.php?page=logout"> LOGOUT</a></li>';
  $extra_elements_if_user_logged_out = '<li class="navElement"><a href="./index.php?page=register"> REGISTER</a></li>
  <li class="navElement"><a href="./index.php?page=login"> LOGIN</a></li>';
   $extra_elements= is_user_logged_in() ? $extra_elements_if_user_logged_in : $extra_elements_if_user_logged_out;
  $return_str = '<div class="header">
  <ul class="navLijst">
    <li class="navElement"><a href="./index.php?page=home"> HOME</a></li>
    <li class="navElement"><a href="./index.php?page=contact"> CONTACT</a></li>' .
    $extra_elements .
    '</ul>
    </div>';
    echo $return_str;

}
//don
function showFooter()
{
  echo '<div class="footer">
    <div>
      &nbsp; &copy; 2022, Abdel
    </div>
  </div>';
}
