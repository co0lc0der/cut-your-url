<?php
	require_once 'includes/functions.php';
	if (!logged_in()) redirect();

	$error = get_error_message();
	$success = get_success_message();
	$links = get_user_links($_SESSION['user']['id']);

	include_once 'includes/header_profile.php';
?>
	<main class="container">
		<?php show_message($success, 'success'); ?>
		<?php show_message($error); ?>
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
							<td class="short-link"><?=get_url($link['short_link'])?></td>
							<td><?=$link['views']?></td>
							<td>
								<a href="#" class="btn btn-primary btn-sm copy-btn" title="Скопировать в буфер" data-clipboard-text="<?=get_url($link['short_link'])?>"><i class="bi bi-files"></i></a>&nbsp;
								<a href="<?=get_url("includes/edit.php?id={$link['id']}")?>" class="btn btn-warning btn-sm" title="Редактировать"><i class="bi bi-pencil"></i></a>&nbsp;
								<a href="<?=get_url("includes/delete.php?id={$link['id']}")?>" class="btn btn-danger btn-sm" title="Удалить"><i class="bi bi-trash"></i></a>
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
