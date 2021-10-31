<?php
require_once 'functions.php';

if (isset($_GET['id']) && !empty($_GET['id'])) delete_link($_GET['id']);

redirect(get_url('profile.php'));
