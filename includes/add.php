<?php
if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['link']) && !empty($_POST['link'])) {
	require_once 'functions.php';

	if (add_link($_POST['user_id'], $_POST['link'])) {
		$_SESSION['success'] = 'Ссылка успешно добавлена';
	} else {
		$_SESSION['message'] = 'Во время добавления ссылки что-то пошло не так';
	}
}

header('Location: /profile.php');
die;
