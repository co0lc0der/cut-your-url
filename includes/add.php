<?php
require_once 'functions.php';

if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['link']) && !empty($_POST['link'])) {
	if (add_link($_POST['user_id'], $_POST['link'])) {
		$_SESSION['success'] = 'Ссылка успешно добавлена';
	} else {
		$_SESSION['error'] = 'Во время добавления ссылки что-то пошло не так';
	}
}

redirect(get_url('profile.php'));
