<?php
	require_once 'includes/functions.php';
	if (!$_SESSION['user']['id']) header('Location: /');

	$links = get_user_links($_SESSION['user']['id']);

	$success = '';
	if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
		$success = $_SESSION['success'];
		$_SESSION['success'] = '';
	}

	$error = '';
	if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
		$error = $_SESSION['error'];
		$_SESSION['error'] = '';
	}

	include 'includes/header.php';
?>
	<main class="container">
		<?php if (!empty($success)) { ?>
			<div class="alert alert-success alert-dismissible fade show mt-3" role="alert"><?=$success?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php } ?>
		<?php if (!empty($error)) { ?>
			<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert"><?=$error?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php } ?>
		<div class="row mt-5">
			<?php if ($links) { ?>
				<table class="table table-striped">
					<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Ссылка</th>
						<th scope="col">Сокращение</th>
						<th scope="col">Переходы</th>
						<th scope="col">Действия</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($links as $key => $link) { ?>
						<tr data-id="<?=$link['id']?>">
							<th scope="row"><?=$key + 1;?></th>
							<td><a href="<?=$link['long_link']?>" target="_blank"><?=$link['long_link']?></td>
							<td class="short-link"><?=HOST . "/{$link['short_link']}"?></td>
							<td><?=$link['views']?></td>
							<td>
								<a href="#" class="btn btn-primary btn-sm copy-btn" title="Скопировать в буфер" data-clipboard-text="<?=HOST . "/{$link['short_link']}"?>"><i class="bi bi-files"></i></a>&nbsp;
								<a href="includes/edit.php?id=<?=$link['id']?>" class="btn btn-warning btn-sm" title="Редактировать"><i class="bi bi-pencil"></i></a>&nbsp;
								<a href="includes/delete.php?id=<?=$link['id']?>" class="btn btn-danger btn-sm" title="Удалить"><i class="bi bi-trash"></i></a>
							</td>
						</tr>
					<?php	} ?>
					</tbody>
				</table>
			<?php } else { ?>
				<div class="col">
					<h3 class="text-center">У вас пока нет добавленных ссылок</h3>
				</div>
			<?php } ?>
		</div>
	</main>
<?php
include 'includes/profile_footer.php';
