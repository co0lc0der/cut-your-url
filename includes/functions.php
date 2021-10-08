<?php
require_once 'config.php';

function get_url($page = '') {
	return HOST . $page;
}

function db() {
	try {
		return new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=utf8",
			DB_USER,
			DB_PASS,
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
