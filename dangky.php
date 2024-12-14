<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/text.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>
<body>
    

    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2></h2>
        <p></p>
        <button onclick="closePopup()">Ok</button>
    </div>
   <form class="my-form" id="registerForm" action="./api/api.php" method="post"> 
   <input type="hidden" name="action" value="register">
        <div class="login-welcome-row"> 
            <a href="dangky.php" title="Logo"><img src="./assets/logo.png" alt="Logo" class="logo"></a> 
            <h1>Đăng ký tài khoản &#x1F44F; </h1> 
            <p>Vui lòng nhập thông tin của bạn!</p>
        </div> 
        <div class="input__wrapper"> 
            <input type="text" id="tk" name="tk" class="input__field" placeholder="Tài khoản"   required >
            <div id="icon">
                <i class="far fa-user"></i>
            </div>
            <label for="taikhoan" class="input__label">Tài khoản:</label> 
            <!--svg--> 
            
        </div> 
        <div class="input__wrapper"> 
            <input type="text" id="ht" name="ht" class="input__field"  placeholder="Your name" required >
            <div id="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <label for="ht" class="input__label">Họ tên:</label> 
            <!--svg--> 
            
        </div> 
        <div class="input__wrapper"> 
            <input type="email" id="email" name="email" class="input__field"  placeholder="Your Email" required >
            <div id="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <label for="email" class="input__label">Email:</label> 
            <!--svg--> 
            
        </div> 

        <div class="input__wrapper"> 
            <input type="text" id="sdt" name="sdt" class="input__field" placeholder="Your Phone"   required >
            <div id="icon">
                <i class="fas fa-phone"></i>
            </div>
            <label for="sdt" class="input__label">Số điện thoại:</label> 
            <!--svg--> 
            
        </div> 
        <div class="input__wrapper"> 
            <input type="text" id="dc" name="dc" class="input__field" placeholder="Your address" required >
            <div id="icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <label for="sdt" class="input__label">Địa chỉ:</label> 
            <!--svg--> 
            
        </div> 
        <div class="input__wrapper"> 
            <input id="password" name="password" type="password" class="input__field" placeholder="Your Password"   required>
            
            <div id="eye">
                <i class="far fa-eye" onclick="eye()"></i>
            
            </div>
            <span id="passStrength"></span>
            
            <label for="password" class="input__label"> Mật khẩu: </label> 
 
        </div> 
        <div class="input__wrapper"> 
            <input id="repassword" type="password" class="input__field" placeholder="Your Password"   required>
            <div id="eye1">
                <i class="far fa-eye" onclick="eye1()"></i>
            </div>
            <label for="password" class="input__label"> Nhập lại mật khẩu: </label> 
            <!-- svg -->
        </div> 
        <div class="input__wrapper"> 
            <select id="role" name="role">
                <option value="guest">Khách hàng</option>
                <option value="dvtc">Đơn vị tổ chức</option>
               
            </select>
          
            <label for="role" class="input__label">Role:</label> 
            <!--svg-->  
        </div> 
        <button type="submit" onclick="showss()" id="sub" class="my-form__button"> Đăng ký </button> 
       
        <div class="my-form__actions"> 
            <div class="my-form__row"> 
                <span>Bạn đã có tài khoản?</span> 
                <a href="dangnhap.php" title="Sign in"> Đăng nhập </a> 
            </div> 
        </div> 
    </form> 
    <script src="./js/script.js"></script>
    
    
</body>
</html>