<?php
include_once 'config/config.php';

$useremail = mysqli_real_escape_string($mysqli, $_POST["reg_useremail"]);
$username  = mysqli_real_escape_string($mysqli, $_POST["reg_username"]);
$password  = mysqli_real_escape_string($mysqli, $_POST["reg_password"]);
$password  = password_hash($password, PASSWORD_DEFAULT);


//проверка полей на заполнение
if (empty($_POST["reg_useremail"])) {
    $data['regerror'] = 'Заполните поле почта.'; 
    echo json_encode($data);
    exit();
} else if (empty($_POST["reg_username"])) {
    $data['regerror'] = 'Заполните поле логин.'; 
    echo json_encode($data);
    exit();     
} else if (empty($_POST["reg_password"])) {
    $data['regerror'] = 'Заполните поле пароль.'; 
    echo json_encode($data);
    exit(); 
} //Регулярные вырожения
  else if (!preg_match("|^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$|", $_POST['reg_useremail'])) {
    $data['regerror'] = 'Некорректный адрес электронной почты.';
    echo json_encode($data);
    exit();    
} else if (!preg_match("|^[aA-zZ0-9]{4,18}$|", $_POST['reg_username'])) {
    $data['regerror'] = 'Ваш логин должен состоять из 4-18 латинских символов.';
    echo json_encode($data);
    exit();
} else if (!preg_match("|^[aA-zZ0-9]{6,18}$|", $_POST['reg_password'])) {
    $data['regerror'] = 'Ваш пароль должен состоять из 6-18 латинских символов.';
    echo json_encode($data);
    exit();      
} else if(!empty($_POST["reg_fullname"]) || !empty($_POST["reg_username"]) || !empty($_POST["reg_password"]) || !empty($_POST["reg_useremail"])){
    $new_query = ("INSERT INTO users (username, password, email) VALUES ('$username','$password','$useremail')");
    
    //проверка email на занятость
    $new_query = ("SELECT * FROM users WHERE email='" . $useremail . "'");
    $res = mysqli_query($mysqli, $new_query);
    if (mysqli_num_rows($res) != 0) {
    $data['regerror'] = 'Адрес электронной почты уже занят';
    echo json_encode($data);  
    exit();
    }
    //проверка логина на занятость
    $new_query = ("SELECT * FROM users WHERE username='" . $username . "'");
    $res = mysqli_query($mysqli, $new_query);
    // Если есть уже есть то ошибка
    if (mysqli_num_rows($res) != 0) {
    $data['regerror'] = 'Этот уже логин занят';
    echo json_encode($data);  
    exit();
    } else {
    //создаем аккаунт    
    $new_query = ("INSERT INTO users (username, password, email) VALUES ('$username','$password','$useremail')");
    
    if (mysqli_query($mysqli, $new_query)) {
            $data['status'] = 'Ваш аккаунт успешно создан.'; 
            echo json_encode($data);
        }  
    }
    
}