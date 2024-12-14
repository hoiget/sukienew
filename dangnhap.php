<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/text.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #f9f9f9;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    max-width: 400px;
    width: 300px;
    text-align: center;
    z-index: 9999;
}

.popup h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 10px;
}

.popup p {
    color: #666;
    font-size: 16px;
    margin-bottom: 20px;
}

.popup button {
    padding: 8px 20px;
    background: #007bff;
   
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9998;
}

</style>

</head>
<body>
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2></h2>
        <p></p>
        <button onclick="closePopup()">Ok</button>
</div>
    
   <form class="my-form" id="loginform" action="./api/api.php" method="post"> 
   <input type="hidden" name="action" value="login">
        <div class="login-welcome-row"> 
            <a href="text.html" title="Logo"><img src="./assets/logo.png" alt="Logo" class="logo"></a> 
            <h1>Chào mừng trở lại &#x1F44F; </h1> 
            <p>Vui lòng nhập thông tin của bạn!</p>
        </div> 
        <div class="input__wrapper"> 
            <input type="email" id="email" name="email" class="input__field" placeholder="Your Email" required >
            <div id="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <label for="email" class="input__label">Email:</label> 
            <!--svg--> 
            
        </div> 
        <div class="input__wrapper"> 
            <input id="password" name="password" type="password" class="input__field" placeholder="Your Password"  required>
            <div id="eye">
                <i class="far fa-eye" onclick="eye()"></i>
            </div>
    
            <label for="password" class="input__label"> Mật khẩu </label> 
            <!-- svg -->
        </div> 

        <button type="submit" onclick="showlogi()" class="my-form__button"> Đăng nhập </button> 
        <div class="socials-row"> 
      
            <a href="<?php echo htmlspecialchars($loginUrl); ?>" title="Use Google"> 
            <img src="./assets/geo.png" width="25px" height="25px" alt="Google">Đăng nhập bằng google </a> 
          

        </div>
        <div class="my-form__actions"> 
            <div class="my-form__row"> 
                <span>Chưa có tài khoản?</span> 
                <a href="dangky.php" title="Create Account"> Đăng ký </a> OR
                <a href="quenmk.php" title="Create Account"> Quên mật khẩu </a>
            </div> 
            <a href="index.php" title="Trang chủ">Quay lại Trang chủ </a> 
            <div id="message"></div>
        </div> 
        
   

    
    </form> 
    <script src="./js/script.js"></script>
   
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    
</body>
</html>