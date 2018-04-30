<?php 
$title = "Добавить статью";
include_once 'includes/header.php'; ?>

<?php 

	if(!isset($_SESSION['logged_user'])){
    header("Location: index.php");
    exit;
 	}

	if (isset($_POST['submit'])) {
	$title 		= mysqli_real_escape_string($db->link, $_POST['title']);
	$body 		= mysqli_real_escape_string($db->link, $_POST['body']);
	$category 	= mysqli_real_escape_string($db->link, $_POST['category']);

	$description 	= mysqli_real_escape_string($db->link, $_POST['description']);
	$tags 	= mysqli_real_escape_string($db->link, $_POST['tags']);

	if ($title == '' || $body == '' || $category == '' || $description == '' || $tags == '') {
		$errors = 'Пожалуйста, заполните все обязательные поля.';
	} else {
		$query = "INSERT INTO article (title, body, category, description, tags) VALUES ('$title', '$body', '$category', '$description', '$tags')";
		$insert_row = $db->insert($query);
	}
}
?>

<?php 
	$query = "SELECT * FROM categories";
	//Run Query
	$categories = $db->select($query);
?>

<article class="admin-block">
<h4>Добавить статью</h4>
<form method="post" action="add_post.php">
	<div class="field-wrap">
		<label>Post Title</label>
		<input type="text" name="title" class="form-control" placeholder="Введите заголовок 50 до 60 символов"/>
	</div>
	<div class="field-wrap">
		<label>Post Body</label>
		<textarea name="body" rows="8" class="form-control" placeholder="Введите статью"></textarea>
	</div>
	<div class="field-wrap">
		<label>Post Description</label>
		<input type="text" name="description" class="form-control" placeholder="Введите описание страницы 150 до 160 символов"/>
	</div>
	<div class="field-wrap">
		<label>Post Keywords</label>
		<input type="text" name="tags" class="form-control" placeholder="Введите ключевые слова через запятую 1-2"/>
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
			<option <?php echo $selected; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
		<?php endwhile; ?>
		</select>
	</div>
	<div class="adm-nav">
		<input type="submit" name="submit" class="btn" value="Добавить">
		<a href="index.php">Закрыть</a>
	</div>
</form>
</article>

<?php include_once 'includes/footer.php'; ?>