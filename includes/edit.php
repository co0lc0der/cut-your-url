<?php
require_once 'functions.php';
if (!logged_in()) redirect();

if (isset($_POST['link_id']) && !empty($_POST['link_id']) && isset($_POST['new_link']) && !empty($_POST['new_link'])) {
	$link_id = $_POST['link_id'];
	if (is_owner_link($link_id)) edit_link($link_id, $_POST['new_link']);
}

redirect(get_url('profile.php'));
