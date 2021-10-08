<?php
require_once 'config.php';

function get_url($page = '') {
	return HOST . $page;
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

function db_query($query, $exec = false) {
	if ($exec) {
		return db()->exec($query);
	} else {
		return db()->query($query);
	}
}

function get_users_count() {
	return db_query("SELECT COUNT(`id`) as `num` FROM `users`;")->fetchColumn();
}

function get_links_count() {
	return db_query("SELECT COUNT(`id`) as `num` FROM `links`;")->fetchColumn();
}

function get_views_count() {
	return db_query("SELECT SUM(`views`) FROM `links`;")->fetchColumn();
}

function get_link_info($url) {
	return db_query("SELECT * FROM `links` WHERE `short_link` = '$url' LIMIT 1;")->fetch();
}

function update_views($url) {
	return db_query("UPDATE `links` SET `views` = `views` + 1 WHERE `short_link` = '$url' LIMIT 1;", true);
}

function get_user_info($login) {
	return db_query("SELECT * FROM `users` WHERE `login` = '$login' LIMIT 1;")->fetch();
}

function login($auth_data) {
	if (empty($auth_data) || !isset($auth_data['login']) || !isset($auth_data['pass'])) return false;

	$user = get_user_info($auth_data['login']);

	if (empty($user)) {
		$_SESSION['login'] = $auth_data['login'];
		$_SESSION['message'] = "Пользователь '{$auth_data['login']}' не найден";
		header('Location: /login.php');
		die;
	}

	if (password_verify($auth_data['pass'], $user['pass'])) {
		$_SESSION['user'] = $user;

		$_SESSION['message'] = '';
		header('Location: /profile.php');
		die;
	} else {
		$_SESSION['login'] = $auth_data['login'];
		$_SESSION['message'] = 'Неверный пароль';
		header('Location: /login.php');
		die;
	}
}

function add_user($login, $pass) {
	$hash = password_hash($pass, PASSWORD_DEFAULT);
	return db_query("INSERT INTO `users` (`id`, `login`, `pass`) VALUES (NULL, '$login', '$hash');", true);
}

function register_user($auth_data) {
	if (empty($auth_data) || !isset($auth_data['login']) || !isset($auth_data['pass']) || !isset($auth_data['pass2'])) return false;

	$user = get_user_info($auth_data['login']);
	$_SESSION['login'] = $auth_data['login'];

	if (!empty($user)) {
		$_SESSION['message'] = "Пользователь '{$auth_data['login']}' уже существует";
		header('Location: /register.php');
		die;
	}

	if ($auth_data['pass'] !== $auth_data['pass2']) {
		$_SESSION['message'] = "Пароли не совпадают";
		header('Location: /register.php');
		die;
	}

	if (add_user($auth_data['login'], $auth_data['pass'])) {
		$_SESSION['success'] = 'Регистрация прошла успешно!';
		header('Location: /login.php');
		die;
	}

	return true;
}

function get_user_links($user_id) {
	return db_query("SELECT * FROM `links` WHERE `user_id` = '$user_id'")->fetchAll();
}

function delete_link($link_id) {
	return db_query("DELETE FROM `links` WHERE `id` = $link_id LIMIT 1;", true);
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

function add_link($user_id, $link) {
	$short_link = generate2(URL_CHARS);
	return db_query("INSERT INTO `links` (`id`, `user_id`, `short_link`, `long_link`) VALUES (NULL, $user_id, '$short_link', '$link');", true);
}
