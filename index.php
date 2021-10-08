<?php
	if(isset($_GET['url']) && !empty($_GET['url'])) {
		require_once 'includes/functions.php';

		$url = strtolower(trim($_GET['url']));
		$link = get_link_info($url);

		if (empty($link)) {
			http_response_code(404);
			header('Location: 404.php');
			die;
		}

		update_views($url);
		header('Location: ' . $link['long_link']);
		die;
	}

	include 'includes/header.php';
?>
<main class="container">
	<?php if (!isset($_SESSION['user']['id'])) { ?>
		<div class="row mt-5">
			<div class="col">
				<h2 class="text-center">Необходимо <a href="<?=get_url('/register.php')?>">зарегистрироваться</a> или <a href="<?=get_url('/login.php')?>">войти</a> под своей учетной записью</h2>
			</div>
		</div>
	<?php } ?>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Пользователей в системе: <?=get_users_count()?></h2>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Ссылок в системе: <?=get_links_count()?></h2>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Всего переходов по ссылкам: <?=get_views_count()?></h2>
		</div>
	</div>
</main>
<?php
include 'includes/footer.php';
