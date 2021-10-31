<?php
	require_once 'includes/functions.php';

	if (!logged_in()) redirect();

	if (!isset($_GET['link']) || empty($_GET['link'])) redirect('profile.php');
	$short_link = $_GET['link'] ?? '';

	$link = get_link_info($short_link);
	if (empty($link) || !is_owner_link($link['id'])) redirect('profile.php');

	include_once 'includes/header_profile.php';
?>
<main class="container">
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Редактирование ссылки</h2>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-4 offset-4">
			<form action="<?=get_url('includes/edit.php')?>" method="post">
				<div class="mb-3">
					<label for="link-input" class="form-label">Новая ссылка</label>
					<input type="text" class="form-control" id="link-input" name="new_link" required value="<?=$link['long_link']?>">
				</div>
				<input type="hidden" name="link_id" value="<?=$link['id']?>">
				<button type="submit" class="btn btn-warning" disabled>Редактировать</button>
			</form>
		</div>
	</div>
</main>
<script>
	const button = document.querySelector('.btn-warning');
  document.querySelector('#link-input').addEventListener('input', () => {
    button.disabled = false;
	});
</script>
<?php
include 'includes/footer.php';
