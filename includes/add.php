<?php
require_once 'functions.php';
if (!logged_in()) redirect();

if (isset($_POST['link']) && !empty($_POST['link'])) {
	if (add_link($_SESSION['user']['id'], $_POST['link'])) {
		$_SESSION['success'] = 'Ссылка успешно добавлена';
	} else {
		$_SESSION['error'] = 'Во время добавления ссылки что-то пошло не так';
	}
}

redirect(get_url('profile.php'));
