<?php
require_once ('_inc/classes/Authenticate.php');
require_once ('_inc/classes/Database.php');
require_once ('partials/header.php');

$db = new Database();
$auth = new Authenticate($db);

$auth->requireUser(); 
?>
<h1>Welcome, User!</h1>