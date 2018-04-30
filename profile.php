<?php 
$title = "Профиль";
include_once 'includes/header.php'; ?>

<?php 

	if(!isset($_SESSION['logged_user'])){
    header("Location: index.php");
    exit;
 	}
?>

<div class="profile">
	<p>Добро пожаловать <?php echo $_SESSION['logged_user'];?> </p>
</div>

<?php include_once 'includes/footer.php'; ?>