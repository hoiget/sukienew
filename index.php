
<?php


session_start();


// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['email'])) {
   echo "";
}else{
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    $email = $_SESSION['email'];
    $hoten=$_SESSION['hoten'];
              $sdt = $_SESSION['phone_number'];
              $dia_chi = $_SESSION['address'];
              $user_id = $_SESSION['id'];
}

// Người dùng đã đăng nhập, hiển thị thông tin của người dùng

        ?>
        <script>
    var sessionId = <?php echo json_encode($user_id); ?>;

</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon">
   
    <link rel="stylesheet" href="./css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/bell.css">
    <link rel="stylesheet" href="./css/toggle.css">


</head>
<body>
<?php
 if (!isset($_SESSION['email'])) {
   echo"";
}else{
if($role=='employee'){
    
?>

    <div class="notification-container">
            <span class="notification-bell">🔔</span>
            <span class="notification-dot"></span>
            <div class="notification-list"></div>
        </div>

        <script>

const bell = document.querySelector('.notification-bell'); 
const list = document.querySelector('.notification-list');
const dot = document.querySelector('.notification-dot');

// Hàm kiểm tra có thông báo mới từ API đầu tiên
const fetchNotifications1 = async () => {
    try {
        const response = await fetch('./api/api.php?action=get_notifications');
        const notifications1 = await response.json();

        // Nếu có thông báo, hiển thị chấm đỏ
        if (notifications1.length > 0) {
            dot.style.display = 'block';
        }

        return notifications1; // Trả về thông báo từ API 1
    } catch (error) {
        console.error('Error fetching notifications1:', error);
        return []; // Trả về mảng rỗng trong trường hợp có lỗi
    }
};

// Hàm kiểm tra có thông báo mới từ API thứ hai
const fetchNotifications2 = async () => {
    try {
        const response = await fetch('./api/api.php?action=get_notifications12');
        const notifications2 = await response.json();

        // Nếu có thông báo, hiển thị chấm đỏ
        if (notifications2.length > 0) {
            dot.style.display = 'block';
        }

        return notifications2; // Trả về thông báo từ API 2
    } catch (error) {
        console.error('Error fetching notifications2:', error);
        return []; // Trả về mảng rỗng trong trường hợp có lỗi
    }
};

// Hàm kết hợp dữ liệu từ cả hai API và hiển thị
const displayNotifications = async () => {
    const notifications1 = await fetchNotifications1(); // API đầu tiên
    const notifications2 = await fetchNotifications2(); // API thứ hai

    // Gộp dữ liệu từ cả hai API
    const allNotifications = [...notifications1, ...notifications2];

    // Đổ dữ liệu vào danh sách
    list.innerHTML = allNotifications.map(item =>{
    return Number(item.thongbao) === 0
            ? `
            <div class="notification-item">
                <a href="index.php?ht" style="text-decoration:none;color:black">
                    ${item.username || ''}: ${item.Noidung || ''}
                </a>
            </div>
            `
            : `
            <div class="notification-item">
                <a href="index.php?nhanve" style="text-decoration:none;color:black">
                    Có order chưa xác nhận
                </a>
            </div>
            `;
}).join('');
};

// Đánh dấu thông báo đã đọc và ẩn chấm đỏ khi tất cả đã đọc
const markNotificationsRead = async () => {
    await fetch('./api/api.php?action=mark_read'); // Đánh dấu thông báo đã đọc trong cơ sở dữ liệu
    dot.style.display = 'none'; // Ẩn chấm đỏ khi tất cả thông báo đã được đánh dấu là đã đọc
};

// Xử lý sự kiện khi nhấn chuông
bell.addEventListener('click', async () => {
    list.style.display = list.style.display === 'block' ? 'none' : 'block';
    await displayNotifications(); // Hiển thị thông báo từ cả hai API
    await markNotificationsRead(); // Đánh dấu tất cả thông báo là đã đọc
});

// Kiểm tra thông báo mới từ cả hai API mỗi 30 giây
setInterval(displayNotifications, 30000);

// Kiểm tra ngay khi tải trang
displayNotifications();



    </script>

    
<?php
}
if($role=='guest'){

?>
<div class="notification-container">
            <span class="notification-bell">🔔</span>
            <span class="notification-dot"></span>
            <div class="notification-list"></div>
        </div>

        <script>
   const bell = document.querySelector('.notification-bell'); 
const list = document.querySelector('.notification-list');
const dot = document.querySelector('.notification-dot');

// Hàm kiểm tra có thông báo mới từ API đầu tiên
const fetchNotifications1 = async () => {
    try {
        const response = await fetch('./api/api.php?action=get_notificationskh');
        const notifications1 = await response.json();

        // Nếu có thông báo, hiển thị chấm đỏ
        if (notifications1.length > 0) {
            dot.style.display = 'block';
        }

        return notifications1; // Trả về thông báo từ API 1
    } catch (error) {
        console.error('Error fetching notifications1:', error);
        return []; // Trả về mảng rỗng trong trường hợp có lỗi
    }
};

// Hàm kiểm tra có thông báo mới từ API thứ hai
const fetchNotifications2 = async () => {
    try {
        const response = await fetch('./api/api.php?action=get_notificationskh12');
        const notifications2 = await response.json();

        // Nếu có thông báo, hiển thị chấm đỏ
        if (notifications2.length > 0) {
            dot.style.display = 'block';
        }

        return notifications2; // Trả về thông báo từ API 2
    } catch (error) {
        console.error('Error fetching notifications2:', error);
        return []; // Trả về mảng rỗng trong trường hợp có lỗi
    }
};

// Hàm kết hợp dữ liệu từ cả hai API và hiển thị
const displayNotifications = async () => {
    const notifications1 = await fetchNotifications1(); // API đầu tiên
    const notifications2 = await fetchNotifications2(); // API thứ hai

    // Gộp dữ liệu từ cả hai API
    const allNotifications = [...notifications1, ...notifications2];

    // Đổ dữ liệu vào danh sách
    list.innerHTML = allNotifications.map(item =>{
    return Number(item.thongbao) === 1
            ? `
            <div class="notification-item">
                <a href="index.php?xemhotro" style="text-decoration:none;color:black">
                    ${item.username || ''}: ${item.Traloi || ''}
                </a>
            </div>
            `
            : `
            <div class="notification-item">
                <a href="index.php?xemve" style="text-decoration:none;color:black">
                    Có order đã xác nhận ! vui lòng thanh toán
                </a>
            </div>
            `;
}).join('');
};

// Đánh dấu thông báo đã đọc và ẩn chấm đỏ khi tất cả đã đọc
const markNotificationsRead = async () => {
    await fetch('./api/api.php?action=mark_readkh'); // Đánh dấu thông báo đã đọc trong cơ sở dữ liệu
    dot.style.display = 'none'; // Ẩn chấm đỏ khi tất cả thông báo đã được đánh dấu là đã đọc
};

// Xử lý sự kiện khi nhấn chuông
bell.addEventListener('click', async () => {
    list.style.display = list.style.display === 'block' ? 'none' : 'block';
    await displayNotifications(); // Hiển thị thông báo từ cả hai API
    await markNotificationsRead(); // Đánh dấu tất cả thông báo là đã đọc
});

// Kiểm tra thông báo mới từ cả hai API mỗi 30 giây
setInterval(displayNotifications, 30000);

// Kiểm tra ngay khi tải trang
displayNotifications();


    </script>
<?php
}}
?>
<?php
if (!isset($_SESSION['email'])) {}
else{
    if($role == 'guest' ||$role == 'dvtc' || $role == 'employee' || $role == 'admin'){
?>
<input type="checkbox" id="toggle" />
<label for="toggle" class="toggle-label"></label>
<?php
}}
?>


  <script>
    // Function to set the theme
    function setTheme(isDark) {
      if (isDark) {
        document.body.classList.add('dark-mode');
        document.body.classList.remove('light-mode');
        localStorage.setItem('theme', 'dark');
      } else {
        document.body.classList.add('light-mode');
        document.body.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light');
      }
    }

    // Restore theme on page load
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme === 'dark') {
      document.body.classList.add('dark-mode');
      document.getElementById('toggle').checked = true;
    } else {
      document.body.classList.add('light-mode');
    }

    // Add event listener to toggle
    document.getElementById('toggle').addEventListener('change', function () {
      setTheme(this.checked);
    });
  </script>
    <div class="primary-nav">

        <button href="#" class="hamburger open-panel nav-toggle">
    <span class="screen-reader-text">Menu</span>
    </button>
    
        <nav role="navigation" class="menu">
    
            <a href="#" class="logotype">LOGO <span><img width="30px" height="30px" src="./assets/logo.png"></span></a>
    
            <div class="overflow-container">
    
                <ul class="menu-dropdown">

    <li class="menu-hasdropdown">
<?php
if (!isset($_SESSION['email'])) {
    echo' <a href="dangnhap.php">Đăng nhập</a><span class="icon"><i class="fas fa-sign-in-alt"></i></span>
    
    <label title="toggle menu" for="settings">
<span class="downarrow"><i class="fa fa-caret-down"></i></span>
</label>
    <input type="checkbox" class="sub-menu-checkbox" id="settings" />

    <ul class="sub-menu-dropdown">
        
    </ul>
</li>';
 }else{
 if($role =="guest"){
                       echo' <a href="#">'.$username.'</a><span class="icon"><i class="fas fa-user"></i></span>
    
                        <label title="toggle menu" for="settings">
            <span class="downarrow"><i class="fa fa-caret-down"></i></span>
          </label>
                        <input type="checkbox" class="sub-menu-checkbox" id="settings" />
    
                        <ul class="sub-menu-dropdown">
                            <li><a href="index.php?ttcn"><span class="icon"><i class="fas fa-user"></i></span>Thông tin cá nhân</a></li>
                            <li><a href="index.php?xemhotro"><span class="icon"><i class="fas fa-headset"></i></span>Gửi hỡ trợ</a></li>
                            <li><a href="index.php?xemve"><span class="icon"><i class="fas fa-ticket-alt"></i></span>Xem vé</a></li>
                            <li><a href="index.php?xemdiem"><span class="icon"><i class="fas fa-star"></i></span>Xem tích điểm</a></li>
                            <li><a href="index.php?xemthanhtoan"><span class="icon"><i class="fas fa-credit-card"></i></span>Xem thanh toán</a></li>

                            <li><a href="logout.php"><span class="icon"><i class="fas fa-sign-out-alt"></i></span>Đăng xuất</a></li>
                        </ul>
                    </li>';
} if($role =="dvtc"){
    echo' <a href="#">'.$username.'</a><span class="icon"><i class="fas fa-user"></i></span>

     <label title="toggle menu" for="settings">
<span class="downarrow"><i class="fa fa-caret-down"></i></span>
</label>
     <input type="checkbox" class="sub-menu-checkbox" id="settings" />

     <ul class="sub-menu-dropdown">
         <li><a href="index.php?ttcn"><span class="icon"><i class="fas fa-user"></i></span>Thông tin cá nhân</a></li>
         <li><a href="index.php?qlsk"><span class="icon"><i class="fas fa-calendar-alt"></i></span>Quản lý sự kiện</a></li>
         <li><a href="index.php?xemhotro"><span class="icon"><i class="fas fa-headset"></i></span>Gửi hỡ trợ</a></li>

         <li><a href="index.php?tkdvtc"><span class="icon"><i class="fas fa-chart-bar"></i></span> Thống kê</a></li>
          
         <li><a href="logout.php">Đăng xuất</a></li>
     </ul>
 </li>';
} if($role =="employee"){
    echo' <a href="#">'.$username.'</a><span class="icon"><i class="fas fa-user"></i></span>

     <label title="toggle menu" for="settings">
<span class="downarrow"><i class="fa fa-caret-down"></i></span>
</label>
     <input type="checkbox" class="sub-menu-checkbox" id="settings" />

     <ul class="sub-menu-dropdown">
         <li><a href="index.php?ttcn"><span class="icon"><i class="fas fa-user"></i></span>Thông tin cá nhân</a></li>
         <li><a href="index.php?nhanve"><span class="icon"><i class="fas fa-ticket-alt"></i></span>Nhận order</a></li>
         <li><a href="index.php?xemhd"><span class="icon"><i class="fas fa-file-invoice"></i></span>Xem hóa đơn</a></li>
        <li><a href="index.php?ht"><span class="icon"><i class="fas fa-headset"></i></span>Hỗ trợ</a></li>
         <li><a href="logout.php">Đăng xuất</a></li>
     </ul>
 </li>';
}if($role =="admin"){
    echo' <a href="#">'.$username.'</a><span class="icon"><i class="fas fa-user"></i></span>

     <label title="toggle menu" for="settings">
<span class="downarrow"><i class="fa fa-caret-down"></i></span>
</label>
     <input type="checkbox" class="sub-menu-checkbox" id="settings" />

     <ul class="sub-menu-dropdown">
        <li><a href="index.php?ttcn"><span class="icon"><i class="fas fa-user"></i></span>Thông tin cá nhân</a></li>
        <li><a href="index.php?qltk"><span class="icon"><i class="fas fa-user-cog"></i></span>Quản lý tài khoản</a></li><br>
        <h5>Chức năng khác của khách hàng</h5> <br>
        <li><a href="index.php?xemhotro"><span class="icon"><i class="fas fa-headset"></i></span>Gửi hỡ trợ</a></li>
        <li><a href="index.php?xemve"><span class="icon"><i class="fas fa-ticket-alt"></i></span>Xem vé</a></li>
        <li><a href="index.php?xemdiem"><span class="icon"><i class="fas fa-star"></i></span>Xem tích điểm</a></li>
        <li><a href="index.php?xemthanhtoan"><span class="icon"><i class="fas fa-credit-card"></i></span>Xem thanh toán</a></li><br>
        <h5>Chức năng khác của nhân viên</h5> <br>
        <li><a href="index.php?nhanve"><span class="icon"><i class="fas fa-ticket-alt"></i></span>Nhận order</a></li>
        <li><a href="index.php?xemhd"><span class="icon"><i class="fas fa-file-invoice"></i></span>Xem hóa đơn</a></li>
        <li><a href="index.php?ht"><span class="icon"><i class="fas fa-headset"></i></span>Hỗ trợ</a></li><br>
        
        <li><a href="logout.php">Đăng xuất</a></li>
     </ul>
 </li>';
 
}
}

?>
                    <li><a href="index.php">Trang chủ</a><span class="icon"><i class="fas fa-home"></i></span></li>
    
    
                    <li><a href="index.php?gt">Giới thiệu</a><span class="icon"><i class="fas fa-info-circle"></i></span></li>
    <?php
    if (!isset($_SESSION['email'])) {
        echo'<li><a href="index.php?xemsk">Sự kiện</a><span class="icon"><i class="fas fa-calendar-alt"></i></span></li>';
    }else{
    if($role =="employee"){
echo"";
    }elseif($role =="dvtc"){
        echo"";
    }elseif($role =="admin"){
        echo'<li><a href="index.php?xemsk">Sự kiện</a><span class="icon"><i class="fas fa-calendar-alt"></i></span></li>';
    }else{
    ?>
                    <li><a href="index.php?xemsk">Sự kiện</a><span class="icon"><i class="fas fa-calendar-alt"></i></span></li>
<?php }}?>
                </ul>
    
            </div>
    
        </nav>
    
    </div>
    
<div class="new-wrapper">
    
        <div id="main">
    
            <div id="main-contents">
    
    <?php
 $show=true;
 if (!isset($_SESSION['email'])) {
    echo "";
 }else{
if ($role === 'guest'){
    if(isset($_REQUEST['ttcn'])){
        $show = false;
        include_once("./view/ttcn.php");
    }if(isset($_REQUEST['xemhotro'])){
        $show = false;
        include_once("./view/guihotro.php");
    }if(isset($_REQUEST['xoahotro'])){
        $show = false;
        include_once("./view/guihotro.php");
    }
    if(isset($_REQUEST['xemve'])){
        $show = false;
        include_once("./view/xemve.php");
    }if(isset($_REQUEST['xemdiem'])){
        $show = false;
        include_once("./view/xemdiem.php");
    }if(isset($_REQUEST['datve1'])){
        $show = false;
        include_once("./view/datve.php");
    }elseif(isset($_REQUEST['xemnd1'])){
        $show = false;
        include_once("./view/xemndsk.php");
    }elseif(isset($_REQUEST['thanhtoan'])){
        $show = false;
        include_once("./view/thanhtoan.php");
    }elseif(isset($_REQUEST['return'])){
        $show = false;
        include_once("./view/vnpay_return.php");
    }elseif(isset($_REQUEST['xemthanhtoan'])){
        $show = false;
        include_once("./view/xemthanhtoan.php");
    }
    
}
if ($role === 'dvtc'){
    if(isset($_REQUEST['qlsk'])){
        $show = false;
        include_once("./view/qlsk.php");
    }if(isset($_REQUEST['tkdvtc'])){
        $show = false;
        include_once("./view/thongkedvtc.php");
    }if(isset($_REQUEST['ttcn'])){
        $show = false;
        include_once("./view/ttcn.php");
    }if(isset($_REQUEST['xemhotro'])){
        $show = false;
        include_once("./view/guihotro.php");
    }if(isset($_REQUEST['xoahotro'])){
        $show = false;
        include_once("./view/guihotro.php");}
    if(isset($_REQUEST['xoask'])){
            $show = false;
            include_once("./view/xoask.php");}
}

if ($role === 'employee'){
    if(isset($_REQUEST['ttcn'])){
        $show = false;
        include_once("./view/ttcn.php");
    }if(isset($_REQUEST['ht'])){
        $show = false;
        include_once("./view/hotro.php");
    }
    if(isset($_REQUEST['traloi'])){
        $show = false;
        include_once("./view/traloi.php");}
    if(isset($_REQUEST['nhanve'])){
            $show = false;
            include_once("./view/nhanorder.php");}
    if(isset($_REQUEST['trangthai'])){
        $show = false;
        include_once("./view/nhanorder.php");}
        if(isset($_REQUEST['xemhd'])){
            $show = false;
            include_once("./view/xemhd.php");
        }
        if(isset($_REQUEST['xuathoadon'])){
            $show = false;
            include_once("./view/xuathd.php");
        }
     

   
}

if ($role === 'admin'){
    if(isset($_REQUEST['ttcn'])){
        $show = false;
        include_once("./view/ttcn.php");
    }if(isset($_REQUEST['qltk'])){
        $show = false;
        include_once("./view/qltk.php");
    }elseif(isset($_REQUEST['xemuser'])){
        $show = false;
        include_once("./view/suatk.php");
    }elseif(isset($_REQUEST['xemmk'])){
        $show = false;
        include_once("./view/suatk.php");
    }if(isset($_REQUEST['xemhotro'])){
        $show = false;
        include_once("./view/guihotro.php");
    }if(isset($_REQUEST['xoahotro'])){
        $show = false;
        include_once("./view/guihotro.php");
    }
    if(isset($_REQUEST['xemve'])){
        $show = false;
        include_once("./view/xemve.php");
    }if(isset($_REQUEST['xemdiem'])){
        $show = false;
        include_once("./view/xemdiem.php");
    }if(isset($_REQUEST['datve1'])){
        $show = false;
        include_once("./view/datve.php");
    }elseif(isset($_REQUEST['xemnd1'])){
        $show = false;
        include_once("./view/xemndsk.php");
    }elseif(isset($_REQUEST['thanhtoan'])){
        $show = false;
        include_once("./view/thanhtoan.php");
    }elseif(isset($_REQUEST['return'])){
        $show = false;
        include_once("./view/vnpay_return.php");
    }elseif(isset($_REQUEST['xemthanhtoan'])){
        $show = false;
        include_once("./view/xemthanhtoan.php");
    }if(isset($_REQUEST['ht'])){
        $show = false;
        include_once("./view/hotro.php");
    }
    if(isset($_REQUEST['traloi'])){
        $show = false;
        include_once("./view/traloi.php");}
    if(isset($_REQUEST['nhanve'])){
            $show = false;
            include_once("./view/nhanorder.php");}
    if(isset($_REQUEST['trangthai'])){
        $show = false;
        include_once("./view/nhanorder.php");}
    if(isset($_REQUEST['xemhd'])){
            $show = false;
            include_once("./view/xemhd.php");
        }
    if(isset($_REQUEST['xuathoadon'])){
            $show = false;
            include_once("./view/xuathd.php");
        }
    
    
}

}if(isset($_REQUEST['xemsk'])){
    $show = false;
    include_once("./view/xemsukien.php");
}elseif(isset($_REQUEST['xemnd'])){
    $show = false;
    include_once("./view/xemndsk.php");
}
elseif(isset($_REQUEST['timkiemsk'])){
    $show = false;
    include_once("./view/xemsukien.php");
}elseif(isset($_REQUEST['xembl'])){
    $show = false;
    include_once("./view/xemndsk.php");
}elseif(isset($_REQUEST['xemtag'])){
    $show = false;
    include_once("./view/xemsukien.php");
}elseif(isset($_REQUEST['gt'])){
    $show = false;
    include_once("./view/gioithieu.php");
}
if($show){
    include_once("./assets/layout.php");
}

  include_once("./view/boxx.php")  


?>
<script src="./js/final1.js"></script>
             <footer>
        <p>&copy; 2023 Cyborg Gaming Company. All rights reserved.</p>
        <p>Design by TemplateMo</p>
    </footer>
            </div>
    
        </div>
    
    </div>
    
     <script>
        $('.nav-toggle').click(function(e) {
  
  e.preventDefault();
  $("html").toggleClass("openNav");
  $(".nav-toggle").toggleClass("active");

});
    </script>

</body>
</html>