<?php
session_start();
session_destroy();
require_once './commons/utils.php';
header('location: ' . $siteUrl . 'login.php');

?>