<?php
$title = "Редактировать статью"; 
include_once 'includes/header.php'; ?>

<?php 

	if(!isset($_SESSION['logged_user'])){
    header("Location: index.php");
    exit;
 	}

	$id = $_GET['id'];

	//Creaty Query
	$query = "SELECT * FROM article WHERE id = ".$id;

	//Run Query
	$post = $db->select($query)->fetch_assoc();

	$query = "SELECT * FROM categories";
	//Run Query
	$categories = $db->select($query);

	//обновление записи
	if (isset($_POST['submit'])) {
	$title 		= mysqli_real_escape_string($db->link, $_POST['title']);
	$body 		= mysqli_real_escape_string($db->link, $_POST['body']);
	$category 	= mysqli_real_escape_string($db->link, $_POST['category']);

	$description 	= mysqli_real_escape_string($db->link, $_POST['description']);
	$tags 	= mysqli_real_escape_string($db->link, $_POST['tags']);

	if ($title == '' || $body == '' || $category == '' || $description == '' || $tags == '') {
		$errors = 'Пожалуйста, заполните все обязательные поля.';
	} else {
		$query = "UPDATE article SET title = '$title', body = '$body', category = '$category', description = '$description', tags = '$tags' WHERE id =".$id;

		$update_row = $db->update($query);
		}
	}

	//удаление записи
	if (isset($_POST['delete'])) {
		$query = "DELETE FROM article WHERE id = ".$id;
		$delete_row = $db->delete($query);
	}
?>

<article class="admin-block">
<h4>Редактировать статью</h4>
<form method="post" action="edit_post.php?id=<?php echo $id;?>">
	<div class="field-wrap">
		<label>Post Title</label>
		<input type="text" name="title" class="form-control" placeholder="Введите заголовок 50 до 60 символов" value="<?php echo $post['title'];?>">
	</div>
	<div class="field-wrap">
		<label>Post Body</label>
		<textarea name="body" rows="8" class="form-control" placeholder="Введите статью">
			<?php echo $post['body'];?>
		</textarea>
	</div>
	<div class="field-wrap">
		<label>Post Description</label>
		<input type="text" name="description" class="form-control" placeholder="Введите описание страницы 150 до 160 символов" value="<?php echo $post['description'];?>">
	</div>
	<div class="field-wrap">
		<label>Post Keywords</label>
		<input type="text" name="tags" class="form-control" placeholder="Введите ключевые слова через запятую 1-2" value="<?php echo $post['tags'];?>">
	</div>
	<div class="field-wrap">
		<label>Category</label>
		<select name="category" class="form-control">
			<?php while($row = $categories->fetch_assoc()) :?>
				<?php if($row['id'] == $post['category']) {
					$selected = 'selected';
				} else {
					$selected = '';
				}
				?>
			<option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['name']; ?></option>
		<?php endwhile; ?>
		</select>
	</div>
	<div class="adm-nav">
		<input type="submit" name="submit" class="btn" value="Изменить">
		<a href="admin.php">Закрыть</a>
		<input type="submit" name="delete" class="btn btn-danger" value="Удалить">
	</div>
</form>
</article>

<?php include_once 'includes/footer.php'; ?>