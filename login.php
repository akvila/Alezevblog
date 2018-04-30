<?php
include_once 'config/config.php';
/* Процесс входа в систему пользователя, проверяет, существует ли пользователь и пароль. */

// Escape email to protect against SQL injections
$username = $mysqli->escape_string($_POST['username']);
$result = $mysqli->query("SELECT * FROM users WHERE username='$username'");

if ( $result->num_rows == 0 ){ // Пользователь не существует
    //echo "Пользователь с этим логином не существует!";
    //header("location: error.php");
    $data['errors'] = 'Пользователь с этим логином не существует.';
    echo json_encode($data);  
}
else { // Пользователь существует
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        session_start();
        $_SESSION['logged_user'] = $user['username'];
        $_SESSION['logged_type_user'] = $user['type_user'];

        //echo "Вы зашли!";
        //header("location: profile.php");
        //echo json_encode(array('errors' => false, 'type' => $user['type_user']));
        $data['login_in'] = 'Вы зашли.';
        $data['type'] = $user['type_user'];
        echo json_encode($data);
    }
    else {
        //echo "Вы ввели неверный пароль, повторите попытку!";
        //header("location: error.php");
        // $data['login_error'] = 'Вы ввели неверный пароль, повторите попытку.';
        // echo json_encode($data); 
        $data['errors'] = 'Вы ввели неверный пароль, повторите попытку.';
        echo json_encode($data);
    }
}

