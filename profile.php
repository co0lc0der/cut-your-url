<?php
	include 'includes/header.php';
?>
	<main class="container">
		<div class="row mt-5">
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
				<tr>
					<th scope="row">1</th>
					<td><a href="https://ya.ru" target="_blank">https://ya.ru</a></td>
					<td class="short-link">http://red.loc/kjjfdh</td>
					<td>34</td>
					<td>
						<a href="#" class="btn btn-primary btn-sm copy-btn" title="Скопировать в буфер" data-clipboard-text="http://red.loc/kjjfdh"><i class="bi bi-files"></i></a>
						<a href="#" class="btn btn-warning btn-sm" title="Редактировать"><i class="bi bi-pencil"></i></a>
						<a href="#" class="btn btn-danger btn-sm" title="Удалить"><i class="bi bi-trash"></i></a>
					</td>
				</tr>
				<tr>
					<th scope="row">2</th>
					<td><a href="https://google.ru" target="_blank">https://google.ru</a></td>
					<td class="short-link">http://red.loc/ke05nls</td>
					<td>42</td>
					<td>
						<a href="#" class="btn btn-primary btn-sm copy-btn" title="Скопировать в буфер" data-clipboard-text="http://red.loc/ke05nls"><i class="bi bi-files"></i></a>
						<a href="#" class="btn btn-warning btn-sm" title="Редактировать"><i class="bi bi-pencil"></i></a>
						<a href="#" class="btn btn-danger btn-sm" title="Удалить"><i class="bi bi-trash"></i></a>
					</td>
				</tr>
				<tr>
					<th scope="row">3</th>
					<td><a href="https://vk.com" target="_blank">https://vk.com</a></td>
					<td class="short-link">http://red.loc/jfiwms7</td>
					<td>64</td>
					<td>
						<a href="#" class="btn btn-primary btn-sm copy-btn" title="Скопировать в буфер" data-clipboard-text="http://red.loc/jfiwms7"><i class="bi bi-files"></i></a>
						<a href="#" class="btn btn-warning btn-sm" title="Редактировать"><i class="bi bi-pencil"></i></a>
						<a href="#" class="btn btn-danger btn-sm" title="Удалить"><i class="bi bi-trash"></i></a>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
	</main>
<?php
include 'includes/profile_footer.php';
