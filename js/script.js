let loginForm = document.querySelector(".my-form"); 
loginForm.addEventListener("submit", (e) => { 
    e.preventDefault(); 
    let email = document.getElementById("email"); 
    let password = document.getElementById("password"); 
    console.log("Email:", email.value); 
    console.log("Password:", password.value); 
});

function openPopup(title, message) {
    popup.querySelector('h2').innerText = title;
    popup.querySelector('p').innerText = message;
    popup.style.display = 'block';
    overlay.style.display = 'block';
}
function closePopup() {
        popup.style.display = 'none';
        overlay.style.display = 'none';
}

 function showlogi() {
    let popup = document.getElementById('popup');
    let overlay = document.getElementById('overlay');

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    if (email === "" || password === "") {
        openPopup('Vui lòng điền đầy đủ thông tin.', '');
        return;
    }
    $(document).ready(function() {
        $('#loginform').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: $(this).serialize(),
                success: function(response) {
                
                   
                    if (response === 'success') {
                        openPopup('Đăng nhập Thành công','');
                        window.location.href = 'index.php';
                    } else {
                        openPopup('lỗi','');
                    }
                }
            });
        });
    });
   
  
}
function showss() {
    let popup = document.getElementById('popup');
    let overlay = document.getElementById('overlay');
    let ht = document.getElementById('ht').value;
    let taiKhoan = document.getElementById('tk').value;
    let email = document.getElementById('email').value;
    let sdt = document.getElementById('sdt').value;
    let diaChi = document.getElementById('dc').value;
    let password = document.getElementById('password').value;
    let rePassword = document.getElementById('repassword').value;
    let role = document.getElementById('role').value;

    let passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    let sdttest = /^0\d{3}\d{3}\d{3}$/;
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (taiKhoan === "" || email === "" || sdt === "" || diaChi === "" || password === "" || rePassword === "") {
        openPopup('Lỗi', 'Vui lòng điền đầy đủ thông tin.');
        return;
    }

    

    else if(!passwordPattern.test(password)) {
        openPopup('Lỗi',"Mật khẩu phải chứa ít nhất 1 chữ cái, 1 số và 1 ký tự đặc biệt và có ít nhất 8 ký tự!");
        return;
    }

    else if(!sdttest.test(sdt)) {
        openPopup('Lỗi',"10 số 0xxx-xxx-xxx!");
        return;
    }

    else if (!emailPattern.test(email)) {
        openPopup('Lỗi',"Địa chỉ email không hợp lệ!(xxx@gmail.com)");
        return;
    }

    else if (password !== rePassword) {
        openPopup('Lỗi',"Mật khẩu và xác nhận mật khẩu không khớp!");
        return;
    }
    
    $(document).ready(function() {
    
        $('#registerForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: $(this).serialize(),
                success: function(response) {
                    if(response === 'dangky'){
                        openPopup('Đăng ký thành công','')
                    }
                    else if(response === 'kotc'){
                        openPopup('tài khoản đã tồn tại','')
                    }
                    
                    
                }
            });
        });
    
       
    });

    
}

function themuser1() {
    let popup = document.getElementById('popup');
    let overlay = document.getElementById('overlay');
    let ht = document.getElementById('ht').value;
    let taiKhoan = document.getElementById('tk').value;
    let email = document.getElementById('email').value;
    let sdt = document.getElementById('sdt').value;
    let diaChi = document.getElementById('dc').value;
    let password = document.getElementById('password').value;
    let rePassword = document.getElementById('repassword').value;
    let role = document.getElementById('role').value;

    let passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    let sdttest = /^0\d{3}\d{3}\d{3}$/;
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (taiKhoan === "" || email === "" || sdt === "" || diaChi === "" || password === "" || rePassword === "") {
        openPopup('Lỗi', 'Vui lòng điền đầy đủ thông tin.');
        return;
    }

    

    else if(!passwordPattern.test(password)) {
        openPopup('Lỗi',"Mật khẩu phải chứa ít nhất 1 chữ cái, 1 số và 1 ký tự đặc biệt và có ít nhất 8 ký tự!");
        return;
    }

    else if(!sdttest.test(sdt)) {
        openPopup('Lỗi',"10 số 0xxx-xxx-xxx!");
        return;
    }

    else if (!emailPattern.test(email)) {
        openPopup('Lỗi',"Địa chỉ email không hợp lệ!(xxx@gmail.com)");
        return;
    }

    else if (password !== rePassword) {
        openPopup('Lỗi',"Mật khẩu và xác nhận mật khẩu không khớp!");
        return;
    }
    
    $(document).ready(function() {
    
        $('#registerForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: $(this).serialize(),
                success: function(response) {
                    
                    if(response === 'dangky'){
                        openPopup('Thêm user thành công','')
                    }
                    else if(response === 'kotc'){
                        openPopup('tài khoản đã tồn tại','')
                    }
                    
                    
                }
            });
        });
    
       
    });

    
}
    

   

   



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
function eye1(){
    eyeIcon1.addEventListener('click', function() {
        let type1 = passwordInput1.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput1.setAttribute('type', type1);
    
        // Thay đổi biểu tượng mắt
        eyeIcon1.innerHTML = type1 === 'password' ? '<i class="far fa-eye"></i>' : '<i class="far fa-eye-slash"></i>';
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


document.addEventListener("DOMContentLoaded", function() {
    textmk();
    
});
 