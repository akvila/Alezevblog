<?php 
$title 		 = "AlezevBlog - Блог веб-разработчиков HTML, CSS, JS и PHP";
$description = "Описание";
$keywords    = "Ключевые слова";
include_once 'includes/header.php'; ?>
<?php 
	
	//Create Db Object
	//$db = new Database();

	//Creaty Query
	$query = "SELECT * FROM article ORDER BY id DESC";
	//Run Query
	$posts = $db->select($query);
?>

<?php 
$on_page = 6;

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
$query = "SELECT id, title, body, date FROM article ORDER BY date DESC LIMIT $start_from, $on_page";
$res = mysqli_query($mysqli, $query);
?>

<?php if($posts) : ?>
	<?php while($row = mysqli_fetch_assoc($res)) : ?>
		<article class="single-block">
			
			<div class="post-content">
				<div class="post-date">
					<span class="date-down"><?php echo format_date_day($row['date']); ?></span>
					<span><?php echo format_date_year($row['date']); ?></span>
				</div>
				<h1><a href="post.php?id=<?php echo urlencode($row['id']) ?>"><?php echo shortenTitle($row['title']); ?></a></h1>
				<p><?php echo shortenText($row['body']); ?></p>
				<a href="post.php?id=<?php echo urlencode($row['id']) ?>" class="read-more">Читать далее</a>
			</div>

		</article>
	<?php endwhile; ?>
<?php else : ?>
	<p class="blank">Нет статей</p>
<?php endif; ?>
		<div class="nav-page">
			<ul class="pagination">
				<?php for ($page = 1; $page <= $num_pages; $page++) { ?>
					<li><a href="index.php?page=<?php echo $page;?>"><?php echo $page;?></a></li>
				<?php } ?>
			</ul>
		</div>
<?php include_once 'includes/footer.php'; ?>