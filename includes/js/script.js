//авторизация
jQuery(document).on('submit','#form_login', function(event){
    event.preventDefault();
    
    jQuery.ajax({
        url: 'login.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function(){
            $('.error-msg').hide();
        }
    })

    .done(function(data) {
        console.log(data);
        if(!data.errors){
            if(data.type == 'Administrator') {
                location.href = 'index.php';
            } else if(data.type == 'User') {
                location.href = 'index.php';
            }
        } else {
            $('#form_login').trigger('reset');
            $('.error-msg').fadeIn(800);
        }
    })

    .fail(function(d) {
        console.log(d.responseText);
    })

    .always(function() {
        console.log("complete");
    });    
}); //конец авторизации

$(document).ready(function() {
    //форма аторизаци, регистрации
    $(".form-wrapper").click( function(event) {
        if( $(event.target).closest(".form").length ) 
        return;
        $(".form-wrapper").fadeOut();
        $('.error-msg').fadeOut();
        $('.reg-msg').fadeOut();
        $('.regerror-msg').fadeOut();
        event.stopPropagation();
    });

    $(".login-button").click(function () {
        $(".form-wrapper").show();
    });

    $(".register").click(function () {
        $("#login").hide();
        $('.error-msg').hide();
        $("#signup").show();
    });

    $(".login-in").click(function () {
        $("#signup").hide();
        $('.error-msg').hide();
        $("#login").show();
    });

    //логотип
    $(".logo").mouseover(function() {
        $(this).find(".first-letter").css("color","#FF1E21");
        $(this).find(".logo-circle-orange").css("background-color","#FF974C");
        $(this).find(".logo-circle-blue").css("background-color","#34A7EE");
        $(this).find(".logo-circle-green").css("background-color","#5BA378FF");
        }).mouseout(function() {
            $(this).find(".first-letter").css("color","black");
            $(this).find(".logo-circle-orange").css("background-color","#FF5500");
            $(this).find(".logo-circle-blue").css("background-color","#2980b9");
            $(this).find(".logo-circle-green").css("background-color","#71CB95FF");
    });

    //навигация для width 960
    $(".toggle-icon").click(function() {
        $(this).toggleClass("active");
        $(".sidebar").slideToggle("active");
    });

    //кнопка наверх
    $('.button-top').click(function() { 
        $('body,html').animate( {
            scrollTop:0 
        },800);
    });

});

//регистрация
jQuery(document).on('submit','#form_reg', function(event){
    event.preventDefault();
    
    var output = $('#output'); // блок вывода информации
    
    username = $(".reg_username").val();
    password = $(".reg_password").val();
    useremail = $(".reg_useremail").val();
    
    jQuery.ajax({
        url: 'register.php',
        type: 'POST',
        dataType: 'json', // тип ожидаемых данных в ответе
        data: {reg_username: username, reg_password: password, reg_useremail: useremail}, // данные, которые передаем на сервер
        beforeSend: function(){ // Функция вызывается перед отправкой запроса
            //output.text('Запрос отправлен. Ждите ответа.');
            $('.reg-msg').hide();
            $('.regerror-msg').hide();
      },
      error: function(data, text, error){ // отслеживание ошибок во время выполнения ajax-запроса
        output.text('Хьюстон, У нас проблемы! ' + text + ' | ' + error);
      },
      complete: function(){ // функция вызывается по окончании запроса
        //output.append('<p>Запрос полностью завершен!</p>');
      },
      success: function(data){ // функция, которая будет вызвана в случае удачного завершения запроса к серверу
        if(!data.regerror){
            $('.reg-msg').html(data.status).show();
        } else if(!data.status) {
            $('.regerror-msg').html(data.regerror).show();
            $(':password').val('');
        }
      }
    });
    
}); //конец регистрации