<?php
unset($_COOKIE['id']);
unset($_COOKIE['login']);
setcookie('id', '', -600000, '/');
setcookie('login', '', -600000, '/');
$home_url = "http://" . $_SERVER['SERVER_NAME'];
 header('Location: ' . $home_url. "/signup.ru");
?>
