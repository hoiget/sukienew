
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/qltk.css">
    <style>
          .tabcontent {
      display: none;
    }
    .tablink{
       background-color:white;
       border:none;
       color:black;
    }  

a{
color:black;
text-decoration:none;
}
a:hover{
color:blue;
}
.huy:hover{
color:red;
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
    <center><button class="open-modal-btn">Thêm User</button></center><br><br>

<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <form class="my-form" id="registerForm" action="./api/api.php" method="post">
            <input type="hidden" name="action" value="themuser">
            <div class="login-welcome-row">
                <h1>Thêm user &#x1F44F;</h1>
            </div>
            <div class="form-grid">
                <div class="input__wrapper">
                    <label for="taikhoan" class="input__label">Tài khoản:</label>
                    <input type="text" id="tk" name="tk" class="input__field" placeholder="Tài khoản" required>
                    <div id="icon">
                <i class="far fa-user"></i>
            </div>
                </div>
                <div class="input__wrapper">
                    <label for="ht" class="input__label">Họ tên:</label>
                    <input type="text" id="ht" name="ht" class="input__field" placeholder="Your name" required>
                    <div id="icon">
                <i class="fas fa-envelope"></i>
            </div>
                </div>
                <div class="input__wrapper">
                    <label for="email" class="input__label">Email:</label>
                    <input type="email" id="email" name="email" class="input__field" placeholder="Your Email" required>
                    <div id="icon">
                <i class="fas fa-envelope"></i>
            </div>
                </div>
                <div class="input__wrapper">
                    <label for="sdt" class="input__label">Số điện thoại:</label>
                    <input type="text" id="sdt" name="sdt" class="input__field" placeholder="Your Phone" required>
                    <div id="icon">
                <i class="fas fa-phone"></i>
            </div>
                </div>
                <div class="input__wrapper">
                    <label for="sdt" class="input__label">Địa chỉ:</label>
                    <input type="text" id="dc" name="dc" class="input__field" placeholder="Your address" required>
                    <div id="icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
                </div>
                <div class="input__wrapper">
                    <label for="password" class="input__label">Mật khẩu:</label>
                    <input id="password" name="password" type="password" class="input__field" placeholder="Your Password" required>
                    <div id="eye">
                <i class="far fa-eye" onclick="eye()"></i>
            
            </div>
            <span id="passStrength"></span>
              </div>
                <div class="input__wrapper">
                    <label for="password" class="input__label">Nhập lại mật khẩu:</label>
                    <input id="repassword" type="password" class="input__field" placeholder="Your Password" required>
                    <div id="eye1">
                <i class="far fa-eye" onclick="eye1()"></i>
            </div>
                </div>
                <div class="input__wrapper">
                    <label for="role" class="input__label">Role:</label>
                    <select id="role" name="role" class="input__field">
                        <option value="guest">Khách hàng</option>
                        <option value="dvtc">Đơn vị tổ chức</option>
                        <option value="employee">Nhân viên</option>
                    </select>
                </div>
            </div>
            <button type="submit" onclick="themuser1()" id="sub" class="my-form__button">Thêm</button>
        </form>
    </div>
</div>

    <script src="./js/dangn.js"></script>
<center>
  <div class="tb">
    <button  class="tablink" onclick="openTab(event, 'dvtc')">Đơn vị tổ chức</button>
    <button class="tablink" onclick="openTab(event, 'employee')">Nhân Viên</button>
    <button class="tablink" onclick="openTab(event, 'guest')">Khách Hàng</button>
  </div>
  </center>
  <div id="guest" class="tabcontent" style="display: block;">
<div id="khach"></div>
</div>
<div id="dvtc" class="tabcontent">
<div id="dv"></div>
</div>
<div id="employee" class="tabcontent">
<div id="nv"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./js/model.js"></script>
  <script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}
    $(document).ready(function() {
        
        guest();
       dvtc();
       employee();
         
   });
        
  </script>
</body>
</html>