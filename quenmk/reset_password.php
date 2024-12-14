<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/text.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2></h2>
        <p></p>
        <button onclick="closePopup()">Ok</button>
    </div>
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
// Kết nối cơ sở dữ liệu
require '../api/connect.php'; // Tải thư viện PHPMailer


// Kiểm tra nếu có token trong URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Kiểm tra token hợp lệ và chưa hết hạn
    $query = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND token_expiry > NOW()");
    $query->bind_param("s", $token);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Token hợp lệ, hiển thị form đổi mật khẩu
        echo '
        
        
        
               <form class="my-form" action="#" method="POST" id="passwordForm"> 
                <input type="hidden" name="token" value="' . htmlspecialchars($token) . '">

                   <div class="login-welcome-row"> 
                       <a href="text.html" title="Logo"><img src="../assets/logo.png" alt="Logo" class="logo"></a> 
                       <h1>Nhập mật khẩu mới &#x1F44F; </h1> 
                       <p>Vui lòng nhập thông tin của bạn!</p>
                   </div> 
                   <div class="input__wrapper"> 
                       <input type="password" id="password" name="password" class="input__field" required >
                       <div id="eye">
                            <i class="far fa-eye" onclick="eye()"></i>
                        
                        </div>
                        <span id="passStrength"></span>
                       <label for="email" class="input__label">Mật khẩu mới:</label> 
                       <!--svg--> 
                       
                   </div> 
           
                   <button type="submit"class="my-form__button" onclick="mk()"> Đổi mật khẩu</button> 
           </form>
              
              
              
              ';

             
    } else {
        echo "<script>openPopup('Liên kết không hợp lệ hoặc đã hết hạn.','');</script>";
        echo "<script>
        setTimeout(function() {
                        window.location.href = 'http://localhost/duan/dangnhap.php';
        }, 5000);
        </script>";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
<script>


let passwordInput = document.getElementById('password');
let passwordInput1 = document.getElementById('repassword');
let eyeIcon1 = document.getElementById('eye1');
let eyeIcon = document.getElementById('eye');
function eye(){
    eyeIcon.addEventListener('click', function() {
        let type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    
        // Thay đổi biểu tượng mắt
        eyeIcon.innerHTML = type === 'password' ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>';
    });
} 


function textmk(){
    let passStrength = document.getElementById("passStrength");

    password.addEventListener("input", function() {
    if (password.value.length < 6 ) {
    
        passStrength.textContent = "Mật khẩu yếu";
        passStrength.style.color = "red";
    } else if (password.value.length < 8) {
    
        passStrength.textContent = "Mật khẩu vừa";
        passStrength.style.color = "orange";
    }
    else {
    
        passStrength.textContent = "Mật khẩu mạnh";
        passStrength.style.color = "green";
    }
    });
}

function mk() {
    $('#passwordForm').submit(function(e) {
        e.preventDefault();
        let password = document.getElementById('password').value;
  

         let passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    

        if (password === "") {
            openPopup('Lỗi', 'Vui lòng điền đầy đủ thông tin.');
        
            return;
        }

        

        else if(!passwordPattern.test(password)) {
            openPopup('Lỗi',"Mật khẩu phải chứa ít nhất 1 chữ cái, 1 số và 1 ký tự đặc biệt và có ít nhất 8 ký tự!");
            
            return;
        }
        this.submit(); 
    });

    
       

}
    

   

document.addEventListener("DOMContentLoaded", function() {
    textmk();
    
});

</script>

<?php
include_once("reset_password_process.php");

?>
</body>
</html>
