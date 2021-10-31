<?php
	require_once 'includes/functions.php';

	if (isset($_SESSION['user']['id'])) redirect(get_url('profile.php'));

	if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['pass2'])) register_user($_POST);

	include 'includes/header.php';

	$login = '';
	if (isset($_SESSION['login'])) {
		$login = $_SESSION['login'];
		$_SESSION['login'] = '';
	}

	$error = '';
	if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
		$error = $_SESSION['error'];
		$_SESSION['error'] = '';
	}
?>
	<main class="container">
		<?php if (!empty($error)) { ?>
			<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert"><?=$error?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php } ?>
		<div class="row mt-5">
			<div class="col">
				<h2 class="text-center">Регистрация</h2>
				<p class="text-center">Если у вас уже есть логин и пароль, <a href="<?=get_url('login.php')?>">войдите на сайт</a></p>
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
					<div class="mb-3">
						<label for="password-input2" class="form-label">Пароль еще раз</label>
						<input type="password" class="form-control <?=!empty($error) ? 'is-invalid' : '';?>" id="password-input2" name="pass2" required>
					</div>
					<button type="submit" class="btn btn-primary">Зарегистрироваться</button>
				</form>
			</div>
		</div>
	</main>
<?php
include 'includes/footer.php';
