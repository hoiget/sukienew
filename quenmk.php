<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="./css/text.css">
    
</head>
<body>
   
<div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2></h2>
        <p></p>
        <button onclick="closePopup()">Ok</button>
    </div>
    <form class="my-form" action="#" method="POST"> 
        <div class="login-welcome-row"> 
            <a href="text.html" title="Logo"><img src="./assets/logo.png" alt="Logo" class="logo"></a> 
            <h1>Quên mật khẩu &#x1F44F; </h1> 
            <p>Vui lòng nhập thông tin của bạn!</p>
        </div> 
        <div class="input__wrapper"> 
            <input type="email" id="email" name="email" class="input__field" placeholder="Your Email" required >
            <div id="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <label for="email" class="input__label">Nhập email của bạn:</label> 
            <!--svg--> 
            
        </div> 

        <button type="submit"class="my-form__button"> Gửi yêu cầu</button> 


</form>
<script>
    const popup = document.querySelector('#popup'); // Sử dụng ID hoặc selector phù hợp
const overlay = document.querySelector('#overlay'); // Đảm bảo overlay cũng được gán đúng

function openPopup(title, message) {
    if (popup) {
        popup.querySelector('h2').innerText = title;
        popup.querySelector('p').innerText = message;
        popup.style.display = 'block';
    } else {
        console.error('Không tìm thấy popup trong DOM.');
    }


    if (overlay) {
        overlay.style.display = 'block';
    } else {
        console.error('Không tìm thấy overlay trong DOM.');
    }
}

function closePopup() {
    if (popup) {
        popup.style.display = 'none';
    }
    if (overlay) {
        overlay.style.display = 'none';
    }
}

</script>
<?php 
include_once("./quenmk/forgot_password_process.php");

?>
</body>
</html>
