<?php
session_start();
session_destroy();
// Giriş sayfasına yönlendir:
header('Location: index.html');
?>