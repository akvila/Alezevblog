<?php 
	include_once 'config/config.php';

	ini_set('display_errors',1);
	error_reporting(E_ALL);

	$id = isset($_GET['id']) ? $_GET['id'] : null; 

	if (empty($id[0])) {
        header('Location: index.php');
    }

	//Check URL FOr Category
	if(isset($_GET['id'])){
		if (!$category = (int)$_GET['id']) {
			header('Location: 404.php');
		} else {

		}	

		//Creaty Query
		// $query = "SELECT * FROM article WHERE category = ".$category." ORDER BY id DESC";
		$result = $mysqli->query("SELECT * FROM article 
				INNER JOIN categories 
				ON article.category = categories.id
				WHERE category = ".$category." ORDER BY article.id DESC");
		//Run Query
		$posts = $result->fetch_assoc();
		if ($result->num_rows > 0) {
		} else {
			header('Location: 404.php');
		}
	} else {
		//Creaty Query
		$result = $mysqli->query("SELECT * FROM article ORDER BY id DESC");
		//Run Query
		$posts = $result->fetch_assoc();;
	}
	$titleCtg 	 = " категория";
	$title 		 = $posts['name'].$titleCtg;
	$description = "Описание";
	$keywords    = "Ключевые слова";
?>
<?php include_once 'includes/header.php'; ?>

<?php 
$on_page = 6;

$query = "SELECT COUNT(*) FROM article WHERE category = ".$category." ORDER BY date DESC";
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
    $current_page = $num_pages;
}

// Начать получение данных от числа (текущая страница - 1) * количество записей на странице
$start_from = ($current_page - 1) * $on_page;

// Формат оператора LIMIT <ЗАПИСЬ ОТ>, <КОЛИЧЕСТВО ЗАПИСЕЙ>
$query = "SELECT * FROM article WHERE category = ".$category." ORDER BY category = ".$category.", date DESC LIMIT $start_from, $on_page";
$res = mysqli_query($mysqli, $query);
?>

<?php if($posts) : ?>
	<?php while($row = mysqli_fetch_assoc($res))  : ?>
		<article class="single-block">
			
			<div class="post-content">
				<div class="post-date">
					<span class="date-down"><?php echo format_date_day($row['date']); ?></span>
					<span><?php echo format_date_year($row['date']); ?></span>
				</div>
				<h1><a href="post.php?id=<?php echo urlencode($row['id']) ?>"><?php echo shortenTitle($row['title']); ?></a></h1>
				<p class="post-text"><?php echo shortenText($row['body']); ?></p>
				<a href="post.php?id=<?php echo urlencode($row['id']) ?>" class="read-more">Читать далее</a>
			</div>

		</article>
	<?php endwhile; ?>

		<div class="nav-page">
			<ul class="pagination">
				<?php for ($page = 1; $page <= $num_pages; $page++) { ?>
					<li><a href="category.php?id=<?php echo $category; ?>&page=<?php echo urlencode($page);?>"><?php echo $page;?></a></li>
				<?php } ?>
			</ul>
		</div>
	
<?php else : ?>
	<p class="blank">В этой категории нет статей.</p>
<?php endif; ?>
<?php include_once 'includes/footer.php'; ?>