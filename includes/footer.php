</div>
		<?php
			if(isset($_SESSION['logged_type_user']) && $_SESSION['logged_type_user'] == 'Administrator') {
		?>
		<aside class="sidebar menu-sidebar">
			<h3>Меню</h3>
			<ul>
				<li><a href="profile.php">Профиль</a></li>
				<li><a href="admin.php">Админ панель</a></li>
				<li><a href="add_post.php">Добавить статью</a></li>
				<li><a href="add_category.php">Добавить категорию</a></li>
				<li><a href="logout.php">Выход</a></li>
			</ul>
		</aside>
		<?php	
			}
		?>

		<?php
			if(isset($_SESSION['logged_type_user']) && $_SESSION['logged_type_user'] == 'User'){
		?>
		<aside class="sidebar menu-sidebar">
			<h3>Меню</h3>
			<ul>
				<li><a href="profile.php">Профиль</a></li>
				<li><a href="logout.php">Выход</a></li>
			</ul>
		</aside>			
		<?php	
			}
		?>

		<aside class="sidebar">
			<h3>Категории</h3>
			<?php if($categories_all) : ?>
			<ul>
				<?php while($row = $categories_all->fetch_assoc()) : ?>
					<li><a href="category.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
				<?php endwhile; ?>
			</ul>
			<?php else : ?>
				<p>Нету категорий</p>
			<?php endif; ?>
		</aside>
		<footer>
			<div class="line-bottom"></div>
			<div class="footer-copyright">
				<p>© Александр Князев, 2017-2018</p>
				<p>Все самое интересное справочники, примеры, заметки и не только для упрощение и помощи веб-разработки.</p>
			</div>
			<div class="button-top">
				<div class="pointer-left"></div>
				<div class="pointer-right"></div>
			</div>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="includes/js/script.js"></script>
	<script src="includes/js/tinymce/js/tinymce/tinymce.min.js"></script> 
	<script>
		tinymce.init({
		  selector: 'textarea',
		  height: 500,
		  theme: 'modern',
		  plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
		  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
		  image_advtab: true,
		 });
	</script>
	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>
</html>