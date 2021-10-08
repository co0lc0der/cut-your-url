<?php
	require_once 'includes/functions.php';

	if (isset($_SESSION['user']['id'])) header('Location: /profile.php');

	if (isset($_POST['login']) && isset($_POST['pass'])) login($_POST);

	include 'includes/header.php';

	$login = '';
	$error = '';
	$success = '';
	if (isset($_SESSION['login'])) {
		$login = $_SESSION['login'];
		$_SESSION['login'] = '';
	}
	if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
		$error = $_SESSION['message'];
		$_SESSION['message'] = '';
	}
	if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
		$success = $_SESSION['success'];
		$_SESSION['success'] = '';
	}
?>
	<main class="container">
		<?php if (!empty($success)) { ?>
			<div class="alert alert-success mt-3" role="alert"><?=$success?></div>
		<?php } ?>
		<div class="row mt-5">
			<div class="col">
				<h2 class="text-center">Вход в личный кабинет</h2>
				<p class="text-center">Если вы еще не зарегистрированы, то самое время <a href="<?=get_url('/register.php')?>">зарегистрироваться</a></p>
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
						<?php if (!empty($error)) { ?>
							<div class="invalid-feedback"><?=$error?></div>
						<?php } ?>
					</div>
					<button type="submit" class="btn btn-primary">Войти</button>
				</form>
			</div>
		</div>
	</main>
<?php
include 'includes/footer.php';
