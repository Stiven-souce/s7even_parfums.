<?php
require_once __DIR__ . '/../includes/config.php';
unset($_SESSION['admin_autenticado']);
session_destroy();
header('Location: login.php');
exit;
