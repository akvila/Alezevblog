<?php 
$title = "Админ панель";
include_once 'includes/header.php'; ?>

<?php

	//session_start();

	if(!isset($_SESSION['logged_user'])){
    header("Location: index.php");
    exit;
 	}

	//Creaty Query
	// $query = "SELECT article.*, categories.name FROM article 
	// 			INNER JOIN categories 
	// 			ON article.category = categories.id
	// 			ORDER BY article.id DESC";
	//Run Query
	//$posts = $db->select($query);

	$query = "SELECT * FROM categories
				ORDER BY categories.id DESC";
	//Run Query
	$categories = $db->select($query);
?>

<?php 
$on_page = 5;

$query = "SELECT COUNT(*) FROM article";
$res = mysqli_query($mysqli, $query);
$count_records = mysqli_fetch_row($res);
$count_records = $count_records[0];

// Получаем количество страниц
// Делим количество записей на количество новостей на странице
// и округляем в большую сторону
$num_pages = ceil($count_records / $on_page);

// Текущая страница из GET-параметра page
// Если параметр не определен, то текущая страница равна 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Если текущая страница меньше единицы, то страница равна 1
if ($current_page < 1 && $current_page = (string)$_GET['page'])
{
	$current_page = header("Location: 404.php");
}
// Если текущая страница больше общего количества страница, то
// текущая страница равна количеству страниц
elseif ($current_page > $num_pages)
{
    $current_page = header("Location: 404.php");
}

// Начать получение данных от числа (текущая страница - 1) * количество записей на странице
$start_from = ($current_page - 1) * $on_page;

// Формат оператора LIMIT <ЗАПИСЬ ОТ>, <КОЛИЧЕСТВО ЗАПИСЕЙ>
$query = "SELECT article.*, categories.name FROM article 
			INNER JOIN categories 
			ON article.category = categories.id 
			ORDER BY date DESC LIMIT $start_from, $on_page";
$res = mysqli_query($mysqli, $query);
?>

<article class="admin-block">
<h4>Админ панель</h4>

<?php if (isset($_GET['msg'])) : ?>
	<div class="alerts"><?php echo htmlentities($_GET['msg']); ?></div>
<?php endif; ?>

	<table class="adm-table">
		<tr>
			<th>Post ID</th>
			<th>Post Title</th>
			<th>Category</th>
			<!-- <th>Author</th> -->
			<th>Date</th>
			<th>Edit</th>
			<th>Description</th>
			<th>Keywords</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($res)) : ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><a href="post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
			<td><?php echo $row['name']; ?></td>
			<!-- <td><?php //echo $row['author']; ?></td> -->
			<td><?php echo format_date($row['date']); ?></td>
			<td><a href="edit_post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['tags']; ?></td>
		</tr>
		<?php endwhile; ?>
	</table>
	<div class="nav-page">
			<ul class="pagination">
				<?php for ($page = 1; $page <= $num_pages; $page++) { ?>
					<li><a href="admin.php?page=<?php echo $page;?>"><?php echo $page;?></a></li>
				<?php } ?>
			</ul>
		</div>
	<table class="adm-table">
		<tr>
			<th>Category ID</th>
			<th>Category Name</th>
		</tr>
		<?php while($row = $categories->fetch_assoc()) : ?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><a href="edit_category.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
		</tr>
		<?php endwhile; ?>
	</table>
</article>

<?php include_once 'includes/footer.php'; ?>