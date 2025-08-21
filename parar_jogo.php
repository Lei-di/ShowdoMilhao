<?php
session_start();
$_SESSION['status'] = 'fim';
header('Location: area_jogo.php');
exit;
?>