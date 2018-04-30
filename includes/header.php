<?php include_once 'config/config.php'; ?>
<?php include_once 'lib/Database.php'; ?>
<?php include_once 'lib/format_helper.php'; ?>
<?php 
	
	ini_set('display_errors',1);
	error_reporting(E_ALL);

	session_start();

	//Create Db Object для все файлов
	$db = new Database();
	//Creaty Query
	$query = "SELECT * FROM categories";
	//Run Query
	$categories_all = $db->select($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Александр Князев">
	<meta name="description" content="<?php echo $description; ?>">
	<meta name="keywords" content="<?php echo $keywords; ?>">
	<link rel="shortcut icon" href="includes/favicon.ico">
	<link rel="stylesheet" href="includes/css/style.css">
</head>
<body>
	<header>
		<div class="header-content">
			<a href="index.php" class="logo"><span class="first-letter">A</span>lezev<p><span class="logo-circle-orange"></span><span class="logo-circle-blue"></span><span class="logo-circle-green"></span>Blog</p></a>
			<nav class="menu-box">
				<ul>
					<li><a href="category.php?id=1" class="link-nav">Html</a></li>
					<li><a href="category.php?id=2" class="link-nav">Css</a></li>
					<li><a href="category.php?id=3" class="link-nav">JavaScript</a></li>
					<?php
						if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']  == true) {
					?>
					<li><a href="logout.php" class="logout-button">Выйти</a></li>
					<?php
					}else {
					?>
					<li><a href="#" class="login-button">Логин</a></li>
					<?php
					}
					?>
					<div class="toggle-icon">
						<div class="top-bar"></div>
						<div class="center-bar"></div>
						<div class="bottom-bar"></div>
					</div>
				</ul>
			</nav>
		</div>

		<div class="form-wrapper">
			<div class="form">
				<div class="error-msg">
					<span>Неверный логин или пароль.</span>
				</div>
				<div id="login">
					<h4>Авторизация</h4>

					<form action="" method="post" autocomplete="off" id="form_login">
				        
				        <div class="field-wrap">
				        	<input type=text name="username" pattern="[A-Za-z0-9_-]{1,15}" placeholder="Логин" required autocomplete="off" class="form-reg">
				    	</div>
				    	
				    	<div class="field-wrap">
				    		<input type="password" name="password" pattern="[A-Za-z0-9_-]{1,15}" placeholder="Пароль" required autocomplete="off" class="form-reg">
				    	</div>

				    	<p class="register"><a href="#">Регистрация</a></p>

				    	<!-- <p class="forgot"><a href="#">Забыли пароль?</a></p> -->
				    	
				    	<input type="submit" name="login" class="btn" value="Вход">
				    </form>
				</div> <!-- end login -->

				<div id="signup">
					<div class="reg-msg"></div>
            		<div class="regerror-msg" id="recaptchaError"></div>
					<h4>Регистрация</h4>
					
					<form action="" method="post" autocomplete="off" id="form_reg">
         
			        	<div class="field-wrap">
			            	<input type="text" name='username' placeholder="Логин" required autocomplete="off" class="reg_username form-reg">
			            </div>
			        
			        	<div class="field-wrap">
			            	<input type="email" name='email' placeholder="Почта" required autocomplete="off" class="reg_useremail form-reg">
			        	</div>
			          
			        	<div class="field-wrap">
			        		<input type="password" name='password' placeholder="Пароль" required autocomplete="off" class="reg_password form-reg">
			        	</div>

						<!-- <div class="field-wrap">
			        		<div class="g-recaptcha" data-sitekey=""></div>
						</div> -->

			        	<p class="login-in"><a href="#">Авторизация</a></p>

			        	<input type="submit" name="register" class="btn" value="Зарегистрироваться">
			        </form>
				</div>
			</div> <!-- end form -->
		</div> <!-- end form-wrapper -->
	</header>
	<div class="wrapper">
		<div class="content">