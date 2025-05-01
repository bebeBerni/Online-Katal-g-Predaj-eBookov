<?php
require_once('_inc/classes/Database.php');
require_once('_inc/classes/Authenticate.php');

$db = new Database();
$auth = new Authenticate($db);

$auth->logout();

header("Location: login.php");
exit;
?>