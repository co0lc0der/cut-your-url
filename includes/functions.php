<?php
require_once 'config.php';

function get_url($page = '') {
	return HOST . "/$page";
}

function redirect($link = HOST) {
	header("Location: $link");
	die;
}

function db() {
	try {
		return new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=utf8",
			DB_USER, DB_PASS,
			[
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]
		);
	} catch (PDOException $e) {
		die($e->getMessage());
	}
}

function db_query($sql = "", $fields = []) {
	if (empty($sql)) return false;

	$result = db()->prepare($sql);
	if ($fields) {
		$result->execute($fields);
	} else {
		$result->execute();
	}

	return $result;
}

function get_users_count() {
	return db_query("SELECT COUNT(`id`) FROM `users`;")->fetchColumn();
}

function get_links_count() {
	return db_query("SELECT COUNT(`id`) FROM `links`;")->fetchColumn();
}

function get_views_count() {
	return db_query("SELECT SUM(`views`) FROM `links`;")->fetchColumn();
}

function get_link_info($url) {
	if (empty($url)) return [];

	return db_query("SELECT * FROM `links` WHERE `short_link` = ?;", [$url])->fetch();
}

function update_views($url) {
	if (empty($url)) return false;

	return db_query("UPDATE `links` SET `views` = `views` + 1 WHERE `short_link` = ?;", [$url]);
}

function get_user_info($login) {
	if (empty($login)) return [];

	return db_query("SELECT * FROM `users` WHERE `login` = :login;", ['login' => $login])->fetch();
}

function login($auth_data) {
	if (empty($auth_data) || !isset($auth_data['login']) || empty($auth_data['login']) || !isset($auth_data['pass']) || empty($auth_data['pass'])) {
		$_SESSION['error'] = "Логин или пароль не может быть пустым";
		redirect(get_url('login.php'));
	}

	$user = get_user_info($auth_data['login']);

	if (empty($user)) {
		$_SESSION['login'] = $auth_data['login'];
		$_SESSION['error'] = "Пользователь '{$auth_data['login']}' не найден";
		redirect(get_url('login.php'));
	}

	if (password_verify($auth_data['pass'], $user['pass'])) {
		$_SESSION['user'] = $user;

		$_SESSION['error'] = '';
		redirect(get_url('profile.php'));
	} else {
		$_SESSION['login'] = $auth_data['login'];
		$_SESSION['error'] = 'Неверный пароль';
		redirect(get_url('login.php'));
	}
}

function add_user($login, $pass) {
	$password = password_hash($pass, PASSWORD_DEFAULT);

	return db_query("INSERT INTO `users` (`id`, `login`, `pass`) VALUES (NULL, ?, ?);", [$login, $password]);
}

function register_user($auth_data) {
	if (empty($auth_data) || !isset($auth_data['login']) || empty($auth_data['login']) || !isset($auth_data['pass']) || !isset($auth_data['pass2'])) return false;

	$user = get_user_info($auth_data['login']);
	$_SESSION['login'] = $auth_data['login'];

	if (!empty($user)) {
		$_SESSION['error'] = "Пользователь '{$auth_data['login']}' уже существует";
		redirect(get_url('register.php'));
	}

	if ($auth_data['pass'] !== $auth_data['pass2']) {
		$_SESSION['error'] = "Пароли не совпадают";
		redirect(get_url('register.php'));
	}

	if (add_user($auth_data['login'], $auth_data['pass'])) {
		$_SESSION['success'] = 'Регистрация прошла успешно!';
		redirect(get_url('login.php'));
	}

	return true;
}

function get_user_links($user_id) {
	if (empty($user_id)) return [];

	return db_query("SELECT * FROM `links` WHERE `user_id` = ?;", [$user_id])->fetchAll();
}

function delete_link($id) {
	if (empty($id)) return false;

	$_SESSION['success'] = 'Ссылка успешно удалена';
	return db_query("DELETE FROM `links` WHERE `id` = ?;", [$id]);
}

function generate1($template, $length = 8) {
	$numChars = strlen($template);
	$string = '';
	for($i = 0; $i < $length; $i++){
		$string .= substr($template, random_int(1, $numChars) - 1, 1);
	}
	return $string;
}

function generate2($template, $length = 8) {
	$string = str_shuffle($template);
	$numChars = strlen($template);
	if ($length <= $numChars) {
		$string = substr($string, random_int(0, $numChars - $length), $length);
		//} else {
		//	$string = substr($template, rand(1, $numChars) - 1, $length);
	}
	return $string;
}

function generatePasswd($numAlpha = 6, $numNonAlpha = 2) {
	$listAlpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$listNonAlpha = ',;:!?.$/*-+&@_+;./*&?$-!,';
	return str_shuffle(
		substr(str_shuffle($listAlpha), 0, $numAlpha) .
		substr(str_shuffle($listNonAlpha), 0, $numNonAlpha)
	);
}

function generate_string($size = 6) {
	$new_string = str_shuffle(URL_CHARS);
	return substr($new_string, 0, $size);
}

function add_link($user_id, $link) {
	$short_link = generate_string();
	return db_query("INSERT INTO `links` (`id`, `user_id`, `long_link`, `short_link`, `views`) VALUES (NULL, ?, ?, ?, '0');", [$user_id, $link, $short_link]);
}
