<?php include 'includes/header.php'; ?>
	<main class="container">
		<div class="row mt-5">
			<div class="col-4 offset-4">
				<form>
					<div class="mb-3">
						<label for="login-input" class="form-label is-valid">Логин</label>
						<input type="text" class="form-control" id="login-input" required>
						<div class="valid-feedback">Все ок</div>
					</div>
					<div class="mb-3">
						<label for="password-input" class="form-label">Пароль</label>
						<input type="password" class="form-control is-invalid" id="password-input" required>
						<div class="invalid-feedback">А тут не ок</div>
					</div>
					<button type="submit" class="btn btn-primary">Войти</button>
				</form>
			</div>
		</div>
	</main>
<?php
include 'includes/footer.php';
