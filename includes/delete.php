<?php
require_once 'functions.php';
if (!logged_in()) redirect();

if (isset($_GET['id']) && !empty($_GET['id'])) {
	if (is_owner_link($_GET['id'])) delete_link($_GET['id']);
}

redirect(get_url('profile.php'));
