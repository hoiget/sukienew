
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/qltk.css">
    <style>
       
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
            position: relative;
        }
        .form-group label {
            display: block;
            color: #333;
            font-weight: bold;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            font-size: 16px;
        }
        .form-group input[type="file"] {
            padding: 5px;
        }
        .form-group i {
            position: absolute;
            top: 40px;
            left: 10px;
            color: #aaa;
        }
        .form-group input[type="number"] {
            -moz-appearance: textfield;
        }
        .form-group input[type="number"]::-webkit-outer-spin-button,
        .form-group input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
     
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
}
.tb{
    text-align: right;
}
.tabcontent {
      display: none;
    }
.tablink{
       background-color:white;
       border:none;
       color:black;
    }  
.tablink:hover{
       background-color:white;
       border:none;
       color:black;
    }  
a{
    text-decoration:none;
    color:black;
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
    <center><button class="open-modal-btn">Thêm sự kiện</button></center><br><br>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
<div class="form-container">
    
    <form  id="themsukien" action="./api/api.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="themsukien">
    <h2>Thêm sự kiện</h2>
    <div class="form-grid">
        <div hidden class="form-group">
            <label for="iduser">User ID</label>
            
            <input type="text" id="iduser" name="iduser" value="<?php echo $user_id; ?>" required>
        </div>
        <div class="form-group">
            <label for="tensukien">Tên sự kiện</label>
           
            <input type="text" id="tensukien" name="tensukien" required>
        </div>
        <div class="form-group">
            <label for="noidung">Nội dung</label>
           
            <textarea id="noidung" name="noidung" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="thoigianbd">Thời gian bắt đầu</label>
        
            <input type="date" id="thoigianbd" name="thoigianbd" required>
        </div>
        <div class="form-group">
            <label for="thoigiankt">Thời gian kết thúc</label>
           
            <input type="date" id="thoigiankt" name="thoigiankt" required>
        </div>
        <div class="form-group">
            <label for="daichi">Địa chỉ</label>
           
            <input type="text" id="diachi" name="diachi" required>
        </div>
        <div class="form-group">
            <label for="anh">Hình ảnh</label>
          
            <input type="file" id="anh" name="anh"  required>
        </div>
        <div class="form-group">
            <label for="sotien">Gía</label>
           
            <input type="number" id="sotien" name="sotien" min="0" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="tag">Tag</label>
            
            <select id="tag" name="tag" required>
                <option value="" disabled selected>Chọn tag</option>
                <option value="Sự kiện">Sự kiện</option>
                <option value="Âm nhạc">Âm nhạc</option>
                <option value="Kịch">Kịch</option>
                <option value="Cải lương">Cải lương</option>
                <option value="Xiếc">Xiếc</option>

            </select>
        </div>
</div>
        <button type="submit" class="submit-btn">Submit</button>
    </form>
</div>
</div>
</div>
<div class="tb">
    <button  class="tablink" onclick="openTab(event, 'menu1')"><i class="fa-regular fa-square"></i></button>
    <button class="tablink" onclick="openTab(event, 'menu2')"><i class="fa fa-list"></i></button>
 </div>
 <div id="menu1" class="tabcontent" style="display: block;">
 <div class="xemsk">
                <div class="row" id="eventqlsk">
                   
                </div>
 </div>
</div>
<div id="menu2" class="tabcontent">
<div class="xemsk">
                <div class="row" id="qlsk12">
                   
                </div>
 </div>
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
qlsk();
qlsk12()
themsukien();
});
</script>
</body>

