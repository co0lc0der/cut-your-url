<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
	header('Location: /profile.php');
	die;
}

require_once 'functions.php';

delete_link($_GET['id']);
$_SESSION['success'] = 'Ссылка успешно удалена';
header('Location: /profile.php');
die;
