
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
.quay{
    text-decoration:none;
    color:black;
    padding-left:10px;
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
    <a class="quay" href="index.php?qltk">Quay lại</a>

    <form class="my-form" id="suauser" action="./api/api.php" method="post"> 
   <input type="hidden" name="action" value="suauser">
        <div class="login-welcome-row"> 
            <h1>Sửa tài khoản &#x1F44F; </h1> 
        </div> 
        <div id="xemuser"></div>
        <center><button type="submit" > Cập nhật </button> </center>
       
       
    </form> 
    
    <form class="my-form" id="suamk" action="./api/api.php" method="post"> 
   <input type="hidden" name="action" value="suamk">
        <div class="login-welcome-row"> 
            <h1>Cập nhật mật khẩu &#x1F44F; </h1> 
        </div> 
        <div id="xemmk"></div>
        <center><button type="submit" > Cập nhật mật khẩu </button> </center>
       
       
    </form> 
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>

    $(document).ready(function() {
        
       xemuser();
       suauser();
       xemmk();
       suamk();
   });
        
  </script>
</body>
</html>