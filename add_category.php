<?php
$title = "Добавить категорию"; 
include_once 'includes/header.php'; ?>

<?php

	if(!isset($_SESSION['logged_user'])){
    header("Location: index.php");
    exit;
 	}

	if (isset($_POST['submit'])) {
	$name 		= mysqli_real_escape_string($db->link, $_POST['name']);

	if ($name == '') {
		$errors = 'Пожалуйста, заполните все обязательные поля.';
	} else {
		$query = "INSERT INTO categories (name) VALUES ('$name')";
		$update_row = $db->update($query);
	}
}
?>

<article class="admin-block">
<h4>Добавить категорию</h4>
<form method="post" action="add_category.php">
	<div class="field-wrap">
		<label>Category Name</label>
		<input type="text" name="name" class="form-control" placeholder="Введите название категории"/>
	</div>
	<div class="adm-nav">
		<input type="submit" name="submit" class="btn" value="Добавить">
		<a href="index.php">Закрыть</a>
	</div>
</form>
</article>

<?php include_once 'includes/footer.php'; ?>