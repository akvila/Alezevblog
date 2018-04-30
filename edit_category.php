<?php 
$title = "Редактировать категорию"; 
include_once 'includes/header.php'; ?>

<?php 

	if(!isset($_SESSION['logged_user'])){
    header("Location: index.php");
    exit;
 	}

	$id = $_GET['id'];

	//Creaty Query
	$query = "SELECT * FROM categories WHERE id = ".$id;

	//Run Query
	$category = $db->select($query)->fetch_assoc();

	$query = "SELECT * FROM categories";
	//Run Query
	$categories = $db->select($query);

	//обновить запись
	if (isset($_POST['submit'])) {
	$name 		= mysqli_real_escape_string($db->link, $_POST['name']);

	if ($name == '') {
		$errors = 'Пожалуйста, заполните все обязательные поля.';
	} else {
		$query = "UPDATE categories SET name = '$name' WHERE id =".$id;

		$update_row = $db->update($query);
		}
	}

	//удаление записи
	if (isset($_POST['delete'])) {
		$query = "DELETE FROM categories WHERE id = ".$id;
		$delete_row = $db->delete($query);
	}


?>

<article class="admin-block">
<h4>Отредактировать категорию</h4>
<form method="post" action="edit_category.php?id=<?php echo $id;?>">
	<div class="field-wrap">
		<label>Category Name</label>
		<input type="text" name="name" class="form-control" placeholder="Введите название категории" value="<?php echo $category['name'];?>" />
	</div>
	<div class="adm-nav">
		<input type="submit" name="submit" class="btn" value="Изменить">
		<a href="admin.php">Закрыть</a>
		<input type="submit" name="delete" class="btn btn-danger" value="Удалить">
	</div>
</form>
</article>

<?php include_once 'includes/footer.php'; ?>