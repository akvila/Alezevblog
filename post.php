<?php include_once 'config/config.php'; ?>
<?php include_once 'lib/Database.php'; ?>
<?php 
	
	$id = isset($_GET['id']) ? $_GET['id'] : null; 

	$page = $_GET["id"];

	if (empty($id[0])) {
        header('Location: index.php');
    }

	//Run Query
	$result = $mysqli->query("SELECT * FROM article WHERE id = ".$id);
	$post = $result->fetch_assoc();
	if ($result->num_rows > 0) {
	} else {
		header('Location: 404.php');
	}
	$title = $post['title'];
	$description = $post['description'];
	$keywords = $post['tags'];
	
?>
<?php include_once 'includes/header.php'; ?>
<?php
	// $id = isset($_GET['id']) ? $_GET['id'] : null; 
	// //$id = (empty($_GET["id"]) || !ereg("^[0-9]+$", $_GET["id"]) || $_GET["id"] == 0) ? err() : $id = $_GET["id"]; 
	// //$id_category = $_GET['id'];

	// $page = $_GET["id"];

	// if (empty($id[0])) {
 //        header('Location: index.php');
 //    }

 //    if (() == '404') { 
 //    	header("HTTP/1.0 404 Not Found"); 
 //    	header('Location: 404.html');
 //    	exit;
	// }

	//Creaty Query
	//$query = "SELECT * FROM article WHERE id = ".$id;

	// //Run Query
	// $result = $mysqli->query("SELECT * FROM article WHERE id = ".$id);
	// //$post = $db->select($query)->fetch_assoc();
	// $post = $result->fetch_assoc();
	// if ($result->num_rows > 0) {
	// }else {
	// 	header('Location: 404.php');
	// }

	$result_n = $mysqli->query("SELECT article.*, categories.name FROM article 
			INNER JOIN categories 
			ON article.category = categories.id 
			WHERE article.id = ".$id);
	$res = $result_n->fetch_assoc();
?>
		<article class="post-block">
			<div class="category-menu">
				<a href="index.php">Главная</a><span>/</span>
			
				<a href="category.php?id=<?php echo $res['category']; ?>"><?php echo $res['name']; ?></a><span>/</span>
			
				<a href="#"><?php echo shortenTitle($post['title']); ?></a>
			</div>
			<div class="post-thumbs">
				<a href=""><img src="" alt=""></a>
			</div>
			<div class="post-content">
				<h1 class="post-title"><?php echo $post['title']; ?></h1>
				<p class="post-text"><?php echo $post['body']; ?></p>
			</div>
		</article>
<?php include_once 'includes/footer.php'; ?>