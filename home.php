<?php
$redirectUrl = "http://www.tryterior.com/404.html";
header("HTTP/1.0 404 Not Found");
header("Location: $redirectUrl");
exit;
?>