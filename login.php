<?php
	require_once 'includes/functions.php';

	if (isset($_SESSION['user']['id'])) redirect(get_url('profile.php'));

	if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['pass']) && !empty($_POST['pass'])) login($_POST);

	$login = '';
	if (isset($_SESSION['login'])) {
		$login = $_SESSION['login'];
		$_SESSION['login'] = '';
	}

	$error = get_error_message();
	$success = get_success_message();

	include_once 'includes/header.php';
?>
	<main class="container">
		<?php show_message($success, 'success'); ?>
		<?php show_message($error); ?>
		<div class="row mt-5">
			<div class="col">
				<h2 class="text-center">Вход в личный кабинет</h2>
				<p class="text-center">Если вы еще не зарегистрированы, то самое время <a href="<?=get_url('register.php')?>">зарегистрироваться</a></p>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-4 offset-4">
				<form action="" method="post">
					<div class="mb-3">
						<label for="login-input" class="form-label">Логин</label>
						<input type="text" class="form-control <?=!empty($error) ? 'is-invalid' : '';?>" id="login-input" name="login" required value="<?=$login?>">
					</div>
					<div class="mb-3">
						<label for="password-input" class="form-label">Пароль</label>
						<input type="password" class="form-control <?=!empty($error) ? 'is-invalid' : '';?>" id="password-input" name="pass" required>
					</div>
					<button type="submit" class="btn btn-primary">Войти</button>
				</form>
			</div>
		</div>
	</main>
<?php
include 'includes/footer.php';
