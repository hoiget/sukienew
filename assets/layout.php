<style>
     #intro-video-container {
           
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            
        }
        video {
        width: 90%;
        height: 500px;
    }
</style>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Dashboard</title>
    <style>
        h4{
            text-align: justify; 
            color:white;
        }
    </style>

 
</head>
<body>

 
    <div class="header">
        <h1>Chào mừng đến trang tổ chức sự kiện</h1>
        <h2>Khám Phá Các Sự Kiện Phổ Biến Của Chúng Tôi Tại Đây.</h2>
        <button class="browse-btn">Ngay bây giờ</button>
    </div>


   

<?php
 if (!isset($_SESSION['email'])) {
    echo'<div class="xemsk">
    <div class="row" id="layout"></div>
    </div>';
}else{
if($role=='dvtc'){
    echo"";
}else{

?>
 <div id="intro-video-container">
 <video autoplay controls>
    <source src="./video/intro.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>
</div>
   <div class="xemsk">
    <div class="row" id="layout"></div>
    </div>
<?php

}}

?>
    <section class="library-section">
        <h2>Giới thiệu</h2>
       <h4>Chào mừng bạn đến với trang mua vé sự kiện của chúng tôi! Nơi đây không chỉ là một điểm dừng chân, mà còn là cánh cửa mở ra thế giới của những trải nghiệm giải trí phong phú và đa dạng. Với mong muốn mang đến cho bạn những giây phút thư giãn tuyệt vời, chúng tôi cung cấp vé cho nhiều loại hình sự kiện hấp dẫn, từ âm nhạc sống động, kịch nghệ nghệ thuật đến những chương trình xiếc kỳ diệu và những buổi biểu diễn cải lương đầy bản sắc văn hóa.</h4>
       <h4>Hãy cùng hòa mình vào những buổi hòa nhạc với âm thanh lôi cuốn từ các nghệ sĩ nổi tiếng, nơi bạn có thể thưởng thức những giai điệu đẹp đẽ và cảm nhận sức sống mãnh liệt của âm nhạc. Nếu bạn là người yêu thích kịch, đừng bỏ lỡ cơ hội thưởng thức các vở diễn kịch đầy cảm xúc, nơi mà những câu chuyện nhân văn và thông điệp sâu sắc được thể hiện một cách sống động qua diễn xuất tài tình của các nghệ sĩ.</h4>
       <h4>Đối với những ai yêu thích sự kỳ diệu và ảo thuật, những chương trình xiếc với những màn trình diễn ngoạn mục sẽ khiến bạn phải trầm trồ thán phục. Các nghệ sĩ xiếc tài năng sẽ đưa bạn vào một thế giới đầy màu sắc với những pha biểu diễn mạo hiểm và nghệ thuật độc đáo. Và đừng quên thưởng thức những buổi cải lương truyền thống, nơi bạn sẽ được sống lại những câu chuyện văn hóa đặc sắc, hòa mình vào âm nhạc và vũ đạo tinh tế, mang đến cho bạn một trải nghiệm không thể nào quên.</h4>
       <h4>Chúng tôi cam kết cung cấp vé với giá cả hợp lý cùng dịch vụ khách hàng tận tình, giúp bạn dễ dàng tiếp cận các sự kiện mà mình yêu thích. Hãy truy cập trang web của chúng tôi ngay hôm nay để khám phá những chương trình đang diễn ra và đặt vé cho những trải nghiệm giải trí mà bạn không nên bỏ lỡ. Cùng nhau, hãy tạo nên những kỷ niệm đẹp bên gia đình và bạn bè trong những sự kiện nghệ thuật đầy ý nghĩa!

</h4>
       
    </section>

    
</body>
</html>

</body>

