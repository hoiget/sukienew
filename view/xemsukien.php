<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Event List</title>

<style>
    /* Căn giữa phần tìm kiếm */
.search-container {
    display: flex;
    justify-content: center; /* Căn giữa theo chiều ngang */
    align-items: center;     /* Căn giữa theo chiều dọc */
    height: 100vh;           /* Chiều cao của phần tìm kiếm là toàn bộ chiều cao cửa sổ */
    flex-direction: column;  /* Đặt các phần tử theo chiều dọc */
}

/* Style cho input tìm kiếm */
#keyword {
    width: 500px;  /* Chiều rộng của ô input */
    padding: 10px;
    margin-bottom: 10px; /* Khoảng cách giữa ô input và nút tìm kiếm */
    border: 2px solid #ccc; /* Viền của ô input */
    border-radius: 4px;     /* Bo tròn các góc của ô input */
    font-size: 14px;    
    margin-top:10px;    
}

/* Style cho nút tìm kiếm */
#searchBtn {
    padding: 10px 20px;
    background-color: #4CAF50; /* Màu nền của nút tìm kiếm */
    color: white;              /* Màu chữ */
    border: none;
    border-radius: 4px;        /* Bo tròn các góc của nút */
    font-size: 16px;           /* Kích thước chữ */
    cursor: pointer;
}

#searchBtn:hover {
    background-color: #45a049; /* Thay đổi màu nền khi hover */
}

/* Tạo khoảng cách cho các phần tử trong .search-container */
.search-container input, .search-container button {
    margin: 5px 0;
}

</style>
</head>
<body>
<!-- Form tìm kiếm sự kiện -->
 <center>
    
<div style="background: linear-gradient(45deg, #ff6ec4, #7873f5);">
    <input type="text" id="keyword" placeholder="Tìm kiếm sự kiện..." />
    <button id="searchBtn"><i class="fas fa-search"></i> Tìm kiếm</button>
</div></center>
<hr>


<div class="xemsk">
    <div class="row" id="events"></div>
    <script>
   
</script>
</div>


</body>
</html>