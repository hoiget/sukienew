// Đảm bảo popup được định nghĩa đúng
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

function xem() {
    $.ajax({
        url: './api/api.php?action=xem',

        type: 'GET',
        success: function(response) {
            
            if (response && response.length > 0) {
                var events = response;
                var eventHtml = '';

                events.forEach(function(event, index) {
                    if (index % 4 === 0) {
                        eventHtml += '<div class="row">';
                    }
                
                    eventHtml += '<div class="col-3 mb-3">';
                    eventHtml += '<div class="card">';
 	   
                    eventHtml += '<a href="index.php?xemnd='+ event.Idsk +  '&xembl=' + event.Idsk + '&xemnd1=' + event.Idsk + '"><img  src="images/' + event.anh + '" class="card-img-top" alt="' + event.Tensukien + '"></a>';
                    if(event.Trangthai == '1'){
                    eventHtml += '<span class="italic-text" >Hết vé</span>'
                    }else{
                    eventHtml += '<span class="italic-text-con">Còn vé</span>'
                    }
                    eventHtml += '<div class="card-body">';

                    eventHtml += '<a href="index.php?xemnd=' + event.Idsk + '&xembl=' + event.Idsk +'&xemnd1=' + event.Idsk + '"><h5 class="card-title">' + event.Tensukien + '</h5></a>';
                    eventHtml += '<a href="index.php?xemtag= '+ encodeURIComponent(event.tag.trim()) +'"><p class="card-text">' + event.tag + '</p></a>';

                    // Add other event details as needed
                    eventHtml += '</div></div></div>';

                    if ((index + 1) % 4 === 0 || (index + 1) === events.length) {
                        eventHtml += '</div>';
                    }
                  
                });

                $('#events').html(eventHtml);
            } else {
                $('#events').html('<div class="col">No events found.</div>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching events:', error);
            $('#events').html('<div class="col">An error occurred while fetching events.</div>');
        }
    });
}

function xemnd() {
    const urlParams1 = new URLSearchParams(window.location.search);
    const idnd = urlParams1.get('xemnd');
    const today = new Date();
        const day = String(today.getDate()).padStart(2, '0'); // Đảm bảo ngày có 2 chữ số
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Đảm bảo tháng có 2 chữ số
        const year = today.getFullYear();
        const currentDate = `${year}-${month}-${day}`;
    // Kiểm tra xem idnd có giá trị hay không
  

   

    // Sử dụng ID để gửi yêu cầu AJAX và hiển thị nội dung tương ứng
    $.ajax({
        url: './api/api.php?action=xemnd&idnd=' + idnd, // Thêm ID vào URL
        type: 'GET',
        success: function(response) {
           
            if (response && response.length > 0) {
                const event = response[0]; // Lấy sự kiện đầu tiên
                
                // Xây dựng HTML cho nội dung sự kiện
                let eventHtml = '';
           
                eventHtml += '<div style="margin:auto;width:1400px;border:1px solid black; border-radius:10px;background-color:white;">';
                eventHtml += '<aside style="width:30%;float:left;padding:10px"><h5 class="Ten">'+ event.Tensukien +'</h5>'; 
                eventHtml += '<div style="color:black; font-size: medium;">';
                
                eventHtml += 'Thời gian bắt đầu lúc: ' + event.Thoigianbatdau + '<br>';
                eventHtml += 'Thời gian kết thúc lúc: ' + event.thoigianketthuc + '<br>';
                eventHtml += 'Địa chỉ: ' + event.Diachi + '</div>';
                eventHtml += '<br><hr style="border: none; border-top: 3px solid black; height: 2px;">';
                eventHtml += '<h4 style="color:black; font-size: medium;">Giá vé: ' + parseInt(event.sotien).toLocaleString('vi-VN') + ' VNĐ</h4></aside>';
                eventHtml += '<div style="width:68%; float:left"><img width="100%" height="400px" src="images/' + event.anh + '" alt="' + event.Tensukien + '"></div></div>';
                
                eventHtml += '<hr><div class="nd1" style="text-align: justify; white-space: pre-line; color: black; background: white">';
                eventHtml += '<b style="padding:10px;">Giới thiệu</b>';
                eventHtml += '<h6 class="nd2">' + event.Noidungsukien + '</h6></div>';
                if(event.Trangthai == '1'){
                    eventHtml += '';
                }
                else{
                    
                        eventHtml += '<br><center><button><a style="text-decoration:none;color:white" href="index.php?datve1=' + event.Idsk + '">Đặt vé</a></button></center><br>';

                   

                }
              
                // Thêm các trường nhập và nút gửi bình luận

                // Hiển thị HTML trong phần tử #contentnd
                $('#contentndsk').html(eventHtml);
            } else {
                $('#contentndsk').html('Không tìm thấy sự kiện với ID ' + idnd);
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi lấy sự kiện:', error);
            $('#contentndsk').html('Đã xảy ra lỗi khi lấy sự kiện.');
        }
    });
}
function xemnd1() {
    const urlParams1 = new URLSearchParams(window.location.search);
    const idnd = urlParams1.get('xemnd1');
    const today = new Date();
        const day = String(today.getDate()).padStart(2, '0'); // Đảm bảo ngày có 2 chữ số
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Đảm bảo tháng có 2 chữ số
        const year = today.getFullYear();
        const currentDate = `${year}-${month}-${day}`;
    // Kiểm tra xem idnd có giá trị hay không
  

   

    // Sử dụng ID để gửi yêu cầu AJAX và hiển thị nội dung tương ứng
    $.ajax({
        url: './api/api.php?action=xemnd1&idnd1=' + idnd, // Thêm ID vào URL
        type: 'GET',
        success: function(response) {
           
            if (response && response.length > 0) {
                const event = response[0]; // Lấy sự kiện đầu tiên
                
                // Xây dựng HTML cho nội dung sự kiện
                let eventHtml = '';
               
               
                eventHtml += '<br><h5>Bình luận</h5>';
                
                // Thêm các trường nhập và nút gửi bình luận
                eventHtml += '<input hidden type="text" name="idsk" value="' + event.Idsk + '">';
                eventHtml += '<input hidden type="text" name="id" value="' + sessionId + '">';
                eventHtml += '<input hidden type="text" name="ten" value="' + event.Tensukien + '">';
                eventHtml += '<input hidden class="inp" type="date" name="tgbl" value="' + currentDate + '" readonly>';
                eventHtml += '<input type="text" style="height:50px;width:85%" name="bl" placeholder="Bình luận">';
                eventHtml += '<button type="submit">Gửi</button><br>';
                
                // Hiển thị HTML trong phần tử #contentnd
                $('#contentbll').html(eventHtml);
            } else {
                $('#contentbll').html('');
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi lấy sự kiện:', error);
            $('#contentbll').html('Đã xảy ra lỗi khi lấy sự kiện.');
        }
    });
}
function xemnd2() {
    const urlParams1 = new URLSearchParams(window.location.search);
    const idnd2 = urlParams1.get('xemnd2');
    const today = new Date();
        const day = String(today.getDate()).padStart(2, '0'); // Đảm bảo ngày có 2 chữ số
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Đảm bảo tháng có 2 chữ số
        const year = today.getFullYear();
        const currentDate = `${year}-${month}-${day}`;
    // Kiểm tra xem idnd có giá trị hay không
  

   

    // Sử dụng ID để gửi yêu cầu AJAX và hiển thị nội dung tương ứng
    $.ajax({
        url: './api/api.php?action=xemnd2&idnd2=' + idnd2, // Thêm ID vào URL
        type: 'GET',
        success: function(response) {
          
            if (response && response.length > 0) {
                const event = response[0]; // Lấy sự kiện đầu tiên
                
                // Xây dựng HTML cho nội dung sự kiện
                let eventHtml = '';
                eventHtml += `
                
                <input hidden type="text" id="ma" name="ma" required value="`+event.Idsk+`">

                <div class="form-group">
                    <label for="tensukien">Tên sự kiện</label>
                    <input type="text" id="tensukien" name="tensukien" required value="`+event.Tensukien+`">
                </div>
                <div class="form-group">
                    <label for="noidung">Nội dung</label>
                    <textarea id="noidung" name="noidung" rows="3" required >`+event.Noidungsukien+`</textarea>
                </div>
                <div class="form-group">
                    <label for="thoigianbd">Thời gian bắt đầu</label>
                    <input type="date" id="thoigianbd" name="thoigianbd" value="`+event.Thoigianbatdau+`" required>
                </div>
                <div class="form-group">
                    <label for="thoigiankt">Thời gian kết thúc</label>
                    <input type="date" id="thoigiankt" name="thoigiankt" value="`+event.thoigianketthuc+`" required>
                </div>
                <div class="form-group">
                    <label for="diachi">Địa chỉ</label>
                    <input type="text" id="diachi" name="diachi" value="`+event.Diachi+`" required>
                </div>
                <div class="form-group">
                    <label for="anh">Hình ảnh</label>
                    <input type="file" id="anh" name="anh">
                     <span>Ảnh hiện tại: ${event.anh ? event.anh : 'Chưa có ảnh'}</span>
                </div>
                <div class="form-group">
                    <label for="sotien">Gía</label>
                    <input type="number" id="sotien" name="sotien" min="0" step="0.01" value="`+event.sotien+`" required>
                </div>
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <select id="tag" name="tag" required>
                        <option value="`+event.tag+`" >`+event.tag+`</option>
                        <option value="Sự kiện">Sự kiện</option>
                        <option value="Âm nhạc">Âm nhạc</option>
                        <option value="Kịch">Kịch</option>
                        <option value="Cải lương">Cải lương</option>
                        <option value="Xiếc">Xiếc</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            `;
                eventHtml += '<br><br><br><br> <center><h1>Nội dung chi tiết</h1></center><div style="margin:auto;width:1400px;border:1px solid black; border-radius:10px;background-color:white;">';
                eventHtml += '<aside style="width:30%;float:left;padding:10px"><h5 class="Ten">'+ event.Tensukien +'</h5>'; 
                eventHtml += '<div style="color:black; font-size: medium;">';
                
                eventHtml += 'Thời gian bắt đầu lúc: ' + event.Thoigianbatdau + '<br>';
                eventHtml += 'Thời gian kết thúc lúc: ' + event.thoigianketthuc + '<br>';
                eventHtml += 'Địa chỉ: ' + event.Diachi + '</div>';
                eventHtml += '<br><hr style="border: none; border-top: 3px solid black; height: 2px;">';
                eventHtml += '<h4 style="color:black; font-size: medium;">Giá vé: ' + parseInt(event.sotien).toLocaleString('vi-VN') + ' VNĐ</h4></aside>';
                eventHtml += '<div style="width:68%; float:left"><img width="100%" height="400px" src="images/' + event.anh + '" alt="' + event.Tensukien + '"></div></div>';
                
                eventHtml += '<div class="nd1" style="text-align: justify; white-space: pre-line; color: black; background: white">';
                eventHtml += '<b style="padding:10px;"></b><hr><b style="padding:10px;">Giới thiệu</b>';
                eventHtml += '<h6 class="nd2">' + event.Noidungsukien + '</h6></div>';
                
              
                // Thêm các trường nhập và nút gửi bình luận

                // Hiển thị HTML trong phần tử #contentnd
                $('#contentndsk2').html(eventHtml);
            } else {
                $('#contentndsk2').html('Không tìm thấy sự kiện với ID ' + idnd);
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi lấy sự kiện:', error);
            $('#contentndsk').html('Đã xảy ra lỗi khi lấy sự kiện.');
        }
    });
}

function xemnd3() {
    const urlParams1 = new URLSearchParams(window.location.search);
    const idnd3 = urlParams1.get('xemnd3');

    // Sử dụng ID để gửi yêu cầu AJAX và hiển thị nội dung tương ứng
    $.ajax({
        url: './api/api.php?action=xemnd3&idnd3=' + idnd3, // Thêm ID vào URL
        type: 'GET',
        success: function(response) {
          
            if (response && response.length > 0) {
                const event = response[0]; // Lấy sự kiện đầu tiên
                
                // Xây dựng HTML cho nội dung sự kiện
                let eventHtml = '';
                eventHtml += `
                <button style="color:red;" onclick="hetve( `+event.Idsk+ `)"> HẾT VÉ</button>
                <button style="color:green;background:rgb(72, 178, 239);" onclick="conve( `+event.Idsk+ `)"> CÒN VÉ</button>
                <button style="color: red;background: #FBB03B;" onclick="xoasukien( `+event.Idsk+ `)">Xóa sự kiện</button>


            `;
               
                
              
                // Thêm các trường nhập và nút gửi bình luận

                // Hiển thị HTML trong phần tử #contentnd
                $('#contentndsk3').html(eventHtml);
            } else {
                $('#contentndsk3').html('Không tìm thấy sự kiện với ID ' + idnd);
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi lấy sự kiện:', error);
            $('#contentndsk3').html('Đã xảy ra lỗi khi lấy sự kiện.');
        }
    });
}
function hetve(id) {
    // Gửi yêu cầu đến api.php để cập nhật trạng thái
    fetch('./api/api.php?action=hetve&id=' + id)
        .then(response => response.text())
        .then(data => {
            
            if (data === 'gui') {
                // Chuyển hướng người dùng sau khi cập nhật thành công
                openPopup('Cập nhật thành công', '');
                setTimeout(function() {
                    window.location.href = 'index.php?qlsk';
                }, 2000);
            } else {
                openPopup('Cập nhật không thành công','');
            }
        })
        .catch(error => console.error('Lỗi:', error));
}
function conve(id) {
    // Gửi yêu cầu đến api.php để cập nhật trạng thái
    fetch('./api/api.php?action=conve&id=' + id)
        .then(response => response.text())
        .then(data => {
            
            if (data === 'gui') {
                // Chuyển hướng người dùng sau khi cập nhật thành công
                openPopup('Cập nhật thành công', '');
                setTimeout(function() {
                    window.location.href = 'index.php?qlsk';
                }, 2000);
            } else {
                openPopup('Cập nhật không thành công','');
            }
        })
        .catch(error => console.error('Lỗi:', error));
}
function xoasukien(id) {
    // Gửi yêu cầu đến api.php để cập nhật trạng thái
    fetch('./api/api.php?action=xoasukien&idsk=' + id)
        .then(response => response.text())
        .then(data => {
            
            if (data === 'gui') {
                // Chuyển hướng người dùng sau khi cập nhật thành công
                openPopup('Xóa sự kiện thành công', '');
                setTimeout(function() {
                    window.location.href = 'index.php?qlsk';
                }, 2000);
            } else {
                openPopup('Cập nhật không thành công','');
            }
        })
        .catch(error => console.error('Lỗi:', error));
}


function xemtag(){
    const urlParams = new URLSearchParams(window.location.search);
    const tag = urlParams.get('xemtag');

    
    $.ajax({
        url: './api/api.php?action=xemtag&tag=' + tag,
        type: 'GET',
            success: function(response) {
                if (response && response.length > 0) {
                    var events = response;
                    var eventHtml = '';
                    events.forEach(function(event, index) {
                        if (index % 4 === 0) {
                            eventHtml += '<div class="row">';
                        }

                        eventHtml += '<div class="col-3 mb-3">';
                        eventHtml += '<div class="card">';
                        
                        eventHtml += '<a href="index.php?xemnd=' + event.Idsk + '&xembl=' + event.Idsk + '&xemnd1=' + event.Idsk +'"><img src="images/' + event.anh + '" class="card-img-top" alt="' + event.Tensukien + '"></a>';
                        if(event.Trangthai == '1'){
                            eventHtml += '<span class="italic-text" >Hết vé</span>'
                            }else{
                            eventHtml += '<span class="italic-text-con">Còn vé</span>'
                            }
                        eventHtml += '<div class="card-body">';
                        eventHtml += '<a href="index.php?xemnd=' + event.Idsk + '&xembl=' + event.Idsk + '&xemnd1=' + event.Idsk +'"><h5 class="card-title">' + event.Tensukien + '</h5></a>';
                        eventHtml += '<a href="index.php?xemtag=' + event.tag + '"><p class="card-text">' + event.tag + '</p></a>';
                        // Add other event details as needed
                        eventHtml += '</div></div></div>';

                        if ((index + 1) % 4 === 0 || (index + 1) === events.length) {
                            eventHtml += '</div>';
                        }
                    });

                    $('#events').html(eventHtml);
                } else {
                    $('#events').html('Không tìm thấy sự kiện với tag ' + decodedTag);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy sự kiện:', error);
                $('#content').html('Đã xảy ra lỗi khi lấy sự kiện.');
            }
        });
    }

        
    // Sử dụng ID để gửi yêu cầu AJAX và hiển thị nội dung tương ứng
    function xembl() {
        const urlParams4 = new URLSearchParams(window.location.search);
        const id1 = urlParams4.get('xembl');
        $.ajax({
        url: './api/api.php?action=xembl&id=' + id1, // Thêm ID vào URL
        type: 'GET',
        success: function(response) {
            var eventHtml = '';
    
            if (response && response.length > 0) {
                var events = response;
               
                var $i = 1;
               
    
                // Luôn hiển thị form nhập liệu
               
                events.forEach(function(event, index) {
                    eventHtml += "<div style='padding-left:10px; background-color: white; box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.3);'>";
                    eventHtml += "Tên: " + event.hoten + "<br>" + "Ngày bình luận: " + event.Ngaybinhluan ;
    
                    if (event.Iduser == sessionId) {
                        eventHtml += "||";
                        eventHtml += "<button style='background:none;color:black'  class='del-bl' data-id='" + event.Idbl + "'> <a href='#' onclick='xoabl(" + event.Idbl + ")'><h5>Xóa</h5></a></button>";

                    }

                    eventHtml += "<p class='anh' style='border: 1px solid black; background-color: gainsboro; color: black;'>" + event.Noidungbinhluan + "</p></div>";
    
                    for ($i; $i <= 260; $i++) {
                        eventHtml += "*";
                    }
                    eventHtml += "<br>";
                });
            } else {
                // Trường hợp không có bình luận
                eventHtml += '<p>Không có bình luận</p>';
            }
    
            $('#contentbl').html(eventHtml);
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi lấy sự kiện:', error);
            $('#contentbl').html('Đã xảy ra lỗi khi lấy sự kiện.');
        }
    });}; 
    function datve() {
        const urlParams3 = new URLSearchParams(window.location.search);
        const idd = urlParams3.get('datve1');
        const today = new Date();
        const day = String(today.getDate()).padStart(2, '0'); // Đảm bảo ngày có 2 chữ số
        const month = String(today.getMonth() + 1).padStart(2, '0'); // Đảm bảo tháng có 2 chữ số
        const year = today.getFullYear();
        const currentDate = `${year}-${month}-${day}`;
    // Sử dụng ID để gửi yêu cầu AJAX và hiển thị nội dung tương ứng
        $.ajax({
            url: './api/api.php?action=datve1&id=' + idd, // Thêm ID vào URL
            type: 'GET',
            success: function(response) {
                if (response && response.length > 0) {
                    var events = response;
                    var eventHtml = '';
                    events.forEach(function(event, index) {
                    
                    eventHtml +='<div class="form-group"><label for="noidung">Tên sự kiện:</label><input hidden type="text" name="ten" id="ten" value="'+event.Idsk+'}" readonly><textarea readonly>'+event.Tensukien+'</textarea></div>';
                    eventHtml +='<div class="form-group"><label for="noidung">Gía vé:</label><textarea id="gv" name="gv" readonly>'+event.sotien+'</textarea></div>';
                    eventHtml +='<div class="form-group"><label for="noidung">Địa chỉ:</label><textarea id="dc" name="dc" readonly>'+event.Diachi+'</textarea></div>';
                    eventHtml += '<div class="form-group"> <label for="noidung">Thời gian đặt vé:</label><input type="date" name="tg" id="tg" value="'+currentDate+'" readonly></div>';
                        
                    
                    });
                    $('#contentsk').html(eventHtml);
                } else {
                    $('#contentsk').html('Không tìm thấy sự kiện với ID ' + idd);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy sự kiện:', error);
                $('#content').html('Đã xảy ra lỗi khi lấy sự kiện.');
            }
        });  
    
      };
      function datve1() {
        $.ajax({
            url: './api/api.php?action=datng', // Thêm ID vào URL
            type: 'GET',
            success: function(response) {
                if (response && response.length > 0) {
                    var events = response;
                    var eventHtml = '';
                    events.forEach(function(event, index) {
                    
                        eventHtml +='<div class="form-group"><textarea hidden  id="diem" name="diem" readonly>'+event.Diem+'</textarea></div>';
                        eventHtml +='<div class="form-group"><label for="noidung">Điểm sử dụng:</label><textarea id="diemsd" name="diemsd"  >0</textarea></div>';
    
                        eventHtml +='<div class="form-group"><label for="id">Người dùng:</label><select name="id" id="id"><option value="'+event.id+'">'+event.hoten+'</option></select></div>';                
                    
                    });
                    $('#contentus').html(eventHtml);
                } else {
                    $('#contentus').html('Không tìm thấy sự kiện với ID ');
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy sự kiện:', error);
                $('#content').html('Đã xảy ra lỗi khi lấy sự kiện.');
            }
        });  
      };

      function diem() {
        $.ajax({
            url: './api/api.php?action=datng1', // Thêm ID vào URL
            type: 'GET',
            success: function(response) {
                if (response && response.length > 0) {
                    var events = response;
                    var eventHtml = '';
                    events.forEach(function(event, index) {
                    
                        eventHtml +="<input hidden class='inp' type='number' name='td' value='"+event.Diem+"'>";
                      
                    });
                    $('#contentus1').html(eventHtml);
                } else {
                    $('#contentus1').html('Không tìm thấy sự kiện với ID ');
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy sự kiện:', error);
                $('#content').html('Đã xảy ra lỗi khi lấy sự kiện.');
            }
        });  
      };

      function xemdiem() {
        $.ajax({
            url: './api/api.php?action=xemdiem',
            type: 'GET',
            success: function(response) {
                let eventHtml = '';
                
                if (response && response.length > 0) {
                    eventHtml += '<div class="event-container">';
                    eventHtml += '<h2 class="title">Điểm tích lũy</h2>';
                    
                    response.forEach(function(event) {
                        eventHtml += `
                        <div class="event-item">
                            <div><label style="color: black;">Tên:</label> ${event.hoten}</div>
                            <div><label>Điểm:</label> ${event.Diem}</div>
                        </div>`;
                    });
                    
                    eventHtml += '</div>';
                } else {
                    eventHtml = `
                        <br>
                        <center>
                            <form id="Nhandiem" action="./api/api.php" method="post">
                                <input type="hidden" name="action" value="Nhandiem">
                                <input hidden type="text" name="id" id="id" value="${sessionId}" placeholder="Nhập ID">
                                <button name="butt" type="submit">Nhận điểm</button>
                            </form>
                        </center>`;
                }
    
                $('#xemdiem').html(eventHtml);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy dữ liệu điểm:', error);
                $('#xemdiem').html('<div class="col">Đã xảy ra lỗi khi lấy dữ liệu điểm.</div>');
            }
        });
    }
    
    function xemhotro1() {
        $.ajax({
            url: './api/api.php?action=xemhotro', 
            type: 'GET',
            success: function(response) {
                if (response && response.length > 0) {
                    let events = response;
                    let eventHtml = '';
                    
                    let i = 1;
                    
                    eventHtml += '<div class="table-container">';
                    eventHtml += '<h2>Danh Sách hỗ trợ</h2>';
                    eventHtml += '<table>';
                    eventHtml += '<thead><tr><th>STT</th><th>Nội dung</th><th>Trả lời</th><th>Tên khách hàng</th><th>Action</th></tr></thead>';
                    eventHtml += '<tbody>';
                    
                    events.forEach(function(event) {
                        eventHtml += '<tr><td>' + i++ + '</td><td>' + event.Noidung + '</td><td>' + event.Traloi + '</td><td>' + event.hoten + '</td><td>';
                        
                        
                        
                         eventHtml +='<button onclick="return confirm(\""."Bạn chắc có muốn xóa không"."\")" style="background:none" class="del-but" data-id="'+event.Idht+'"><a style="text-decoration:none;color:black" href="index.php?xoahotro&idht='+event.Idht +'">Xóa</a></button>' + '</td></tr>';
                    });
                    
                    eventHtml += '</tbody></table></div>';
                    
                    $('#events1').html(eventHtml);
                } else {
                    $('#events1').html('<div class="col">No events found.</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching events:', error);
                $('#events1').html('<div class="col">An error occurred while fetching events.</div>');
            }
        });
    };

    function guihotro() {
        $('#guihotro').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response)
                    if(response === 'gui'){
                        openPopup('Gửi thành công','')
                    }
                    else{
                        openPopup('Gửi không thành công','')
                    }
                    
                    
                }
            });
        });
        
      };

      function xoahotro() {
        $(document).on('click', '.del-but', function () {
            var idbl = $(this).data('id'); // Lấy ID từ thuộc tính data-id của nút xóa
    
            $.ajax({
                url: './api/api.php?action=xoahotro&idht=' + idbl,
                type: 'GET', // hoặc 'POST' nếu bạn muốn gửi qua POST
                success: function (response) {
                    if (response.status === 'success') {
                        openPopup('Xoá thành công', '');
                       
                        // Xóa phần tử bình luận khỏi giao diện nếu cần thiết
                    } else {
                        openPopup('Xoá không thành công', '');
                    }
                }.bind(this), // bind(this) để giữ đúng ngữ cảnh `this` trong callback success
                error: function (xhr, status, error) {
                    console.error('Error deleting record:', error);
                    alert('An error occurred while deleting the record.');
                }
            });
        });
    }
   
    function hotronv() {
        $.ajax({
            url: './api/api.php?action=hotronv', 
            type: 'GET',
            success: function(response) {
               
                if (response && response.length > 0) {
                    let events = response;
                    let eventHtml = '';
                    
                    let i = 1;
                    
                    eventHtml += '<div class="table-containe">';
                    eventHtml += '<center><h2>Danh Sách hỗ trợ</h2></center>';
                    eventHtml += '<table>';
                    eventHtml += '<thead><tr><th>STT</th><th>Nội dung</th><th>Trả lời</th><th>Tên khách hàng</th><th>Action</th></tr></thead>';
                    eventHtml += '<tbody>';
                    
                    events.forEach(function(event) {
                        eventHtml += '<tr><td>' + i++ + '</td><td>' + event.Noidung + '</td><td>' + event.Traloi + '</td><td>' + event.hoten + '</td><td>';
                        
                        
                        
                         eventHtml +='<a style="text-decoration:none;color:black" href="index.php?traloi='+event.Idht +'">Trả lời</a>' + '</td></tr>';
                    });
                    
                    eventHtml += '</tbody></table></div>';
                    
                    $('#hotro').html(eventHtml);
                } else {
                    $('#hotro').html('<div class="col">No events found.</div>');
                }
            },
            
        });
    };

    function traloi() {
        const urlParams6 = new URLSearchParams(window.location.search);
        const id = urlParams6.get('traloi');
        $.ajax({
            url: './api/api.php?action=traloi&id=' + id,
            type: 'GET',
            success: function(response) {

                let eventHtml = '';
    
                if (response && response.length > 0) {
                    const event = response[0]; // Lấy phần tử đầu tiên của mảng
                    
                    eventHtml += `
                     <input type="hidden" name="id" value="${event.Idht}">
                        <div class="form-group">
                            <label for="noidung">Nội dung:</label>
                            <textarea id="noidung" name="noidung" placeholder="Nhập nội dung..." readonly>${event.Noidung}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tl">Trả lời:</label>
                            <textarea id="tl" name="tl" placeholder="Nhập nội dung...">${event.Traloi}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="ten">Tên khách hàng:</label>
                            <select name="ten" id="ten">
                                <option value="${event.Iduser}">${event.hoten}</option>
                            </select>
                        </div>
                        <button type="submit">Gửi</button>
                    `;
                } else {
                    eventHtml += '<p>Không tìm thấy dữ liệu.</p>';
                }
    
                $('#hello').html(eventHtml);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy sự kiện:', error);
                $('#hello').html('Đã xảy ra lỗi khi lấy sự kiện.');
            }
        });
    }
    function traloi1() {
        $('#traloi1').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: $(this).serialize(),
                success: function(response) {
                  
                    if(response === 'gui'){
                        openPopup('Gửi thành công','')
                        setTimeout(function() {
                            window.location.href = 'index.php?ht';
                        }, 2000);
                    }
                    else{
                        openPopup('Gửi không thành công','')
                    }
                    
                    
                }
            });
        });
        
      };

    function layout() {
        $.ajax({
            url: './api/api.php?action=layout',
            type: 'GET',
            success: function (response) {
                if (response && response.length > 0) {
                    var events = response;
                    var eventHtml = '';

                    // Bắt đầu phần tử section
                    eventHtml += '<section class="popular-section">';
                    eventHtml += '<h2>Sự kiện được yêu thích</h2>';

                    // Lặp qua các sự kiện
                    for (var i = 0; i < events.length; i++) {
                        // Mỗi hàng sẽ có tối đa 4 game-card
                        if (i % 4 === 0) {
                            if (i !== 0) {
                                eventHtml += '</div><br>'; // Đóng game-list cho hàng trước
                            }
                            eventHtml += '<div class="game-list">'; // Mở game-list cho hàng mới
                        }

                        eventHtml += '<div class="game-card">';
                        eventHtml += '<a style="text-decoration:none;color:white" href="index.php?xemnd=' + events[i].Idsk + '&xembl=' + events[i].Idsk + '&xemnd1=' + events[i].Idsk +'">';
                        eventHtml += '<img style=" width: 100%;height: 200px; " src="images/' + events[i].anh + '" alt="' + events[i].Tensukien + '">';
                        eventHtml += '<span>' + events[i].Tensukien + '</span>';
                        eventHtml += '</a>';
                        eventHtml += '</div>';
                    }

                    // Đóng game-list cho hàng cuối cùng
                    eventHtml += '</div>'; // Đóng game-list
                    eventHtml += '<center><button class="discover-btn">Khám phá</button></center>'; // Nút khám phá
                    eventHtml += '</section>'; // Đóng popular-section

                    $('#layout').html(eventHtml);
                } else {
                    $('#layout').html('<div class="col">No events found.</div>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching events:', error);
                $('#events').html('<div class="col">An error occurred while fetching events.</div>');
            }
        });
    };


    function user() {
        $.ajax({
            url: './api/api.php?action=user',
            type: 'GET',
            success: function(response) {

                let eventHtml = '';
    
                if (response && response.length > 0) {
                    const event = response[0]; // Lấy phần tử đầu tiên của mảng
                    
                    eventHtml += `
                    <li><strong>Username:</strong><input type="text" name="ten" id="ten" value="` + event.username +`"></li>
                <li><strong>Họ Tên:</strong><input type="text" name="hoten" id="hoten" value="` + event.hoten +`"></li>

                <li><strong>Email:</strong><input type="text" name="email" id="email" value="` + event.email +`" readonly></li>
                <li><strong>Số điện thoại:</strong> <input type="number" name="sdt" id="sdt" value="` + event.phone_number +`"></li>
                <li><strong>Địa chỉ:</strong> <input type="text" name="dc" id="dc" value="` + event.address +`"></li>
                    `;
                } else {
                    eventHtml += '<p>Không tìm thấy dữ liệu.</p>';
                }
    
                $('#user').html(eventHtml);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy sự kiện:', error);
                $('#user').html('Đã xảy ra lỗi khi lấy sự kiện.');
            }
        });
    }

    function xemve() {
        $.ajax({
            url: './api/api.php?action=xemve', 
            type: 'GET',
            success: function(response) {
                if (response && response.length > 0) {
                    let events = response;
                    let eventHtml = '';
                    
                    let i = 1;
                    
                    eventHtml += '<div class="table-con">';
                    eventHtml += '<center><h2>Danh Sách vé</h2></center>';
                    eventHtml += '<table>';
                    eventHtml += '<thead><tr><th>STT</th><th>Tên sự kiện</th><th>Họ tên</th><th>Địa chỉ</th><th>Gía vé</th><th>Thời gian đặt vé</th><th>Trạng thái vé</th><th>Action</th></tr></thead>';
                    eventHtml += '<tbody>';
                    
                    events.forEach(function(event) {
                        eventHtml += '<tr><td>' + i++ + '</td><td>' + event.Tensukien + '</td><td>' + event.hoten + '</td><td>' + event.diachi + '</td><td>'+event.Giave + '</td><td>' +event.thoigiandatve + '</td><td>'; 
                        if(event.Trangthaive == '3'){
                            eventHtml +='<span style="color:red;">Hủy vé</span>' + '</td><td>';   
                            eventHtml +='<button style="background:none"><a style="text-decoration:none;color:red" href="#">Hủy vé</a></button>' + '</td></tr>';

                      }else if(event.Trangthaive == '1'){
                          eventHtml += '<span style="color: orange;">Chưa xác nhận</span>' + '</td><td>' ;
                          eventHtml +='<button style="background:none"><a style="text-decoration:none;color: orange;" href="#">Chưa xác nhận</a></button>'+'||'
                          + '<button style="background:none" onclick="huyve('+event.Idve +')"><a style="text-decoration:none;color:red" href="#">Hủy vé</a></button>' + '</td></tr>';
                          + '</td></tr>';


                      }else if(event.Trangthaive == '2'){
                          eventHtml +='<span style="color:green;">Thanh toán</span>' + '</td><td>' ;
                          eventHtml +='<button style="background:none"><a style="text-decoration:none;color:black" href="index.php?thanhtoan='+event.Idve +'">Thanh toán</a></button>' + '</td></tr>';

                      }
                        
                    });
                    
                    eventHtml += '</tbody></table></div>';
                    
                    $('#xemve').html(eventHtml);
                } else {
                    $('#xemve').html('<div class="col">No events found.</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching events:', error);
                $('#events1').html('<div class="col">An error occurred while fetching events.</div>');
            }
        });
    };
    function huyve(idve) {
        // Gửi yêu cầu đến api.php để cập nhật trạng thái
        fetch('./api/api.php?action=huyve&id=' + idve)
            .then(response => response.text())
            .then(data => {
                
                if (data === 'gui') {
                    // Chuyển hướng người dùng sau khi cập nhật thành công
                    openPopup('Cập nhật thành công', '');
                    setTimeout(function() {
                        window.location.href = 'index.php?xemve';
                    }, 2000);
                } else {
                    openPopup('Cập nhật không thành công','');
                }
            })
            .catch(error => console.error('Lỗi:', error));
    }
    function xemve1() {
        $.ajax({
            url: './api/api.php?action=xemve1', 
            type: 'GET',
            success: function(response) {
                console.log(response);
                if (response && response.length > 0) {
                    let events = response;
                    let eventHtml = '';
                    
                    let i = 1;
                    
                    eventHtml += '<div class="table-con">';
                    eventHtml += '<center><h2>Danh Sách vé đã thanh toán</h2></center>';
                    eventHtml += '<table>';
                    eventHtml += '<thead><tr><th>STT</th><th>Tên sự kiện</th><th>Họ tên</th><th>Địa chỉ</th><th>Gía vé</th><th>Thời gian đặt vé</th><th>Trạng thái vé</th></tr></thead>';
                    eventHtml += '<tbody>';
                    
                    events.forEach(function(event) {
                        eventHtml += '<tr><td>' + i++ + '</td><td>' + event.Tensukien + '</td><td>' + event.hoten + '</td><td>' + event.diachi + '</td><td>'+event.Giave + '</td><td>' +event.thoigiandatve + '</td><td>'; 
                       
                          eventHtml +='<span style="color:green;">Đã Thanh toán</span>' + '</td>' ;

                      
                        
                    });
                    
                    eventHtml += '</tbody></table></div>';
                    
                    $('#xemve1').html(eventHtml);
                } else {
                    $('#xemve1').html('<div class="col">No events found.</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching events:', error);
                $('#xemve1').html('<div class="col">An error occurred while fetching events.</div>');
            }
        });
    };

    function xemvenv() {
        $.ajax({
            url: './api/api.php?action=xemvenv', 
            type: 'GET',
            success: function(response) {
                
                if (response && response.length > 0) {
                    let events = response;
                    let eventHtml = '';
                    
                    let i = 1;
                    
                    eventHtml += '<div class="table-con" style="width:100%">';
                    eventHtml += '<center><h2>Danh Sách vé</h2></center>';
                    eventHtml += '<table>';
                    eventHtml += '<thead><tr><th>STT</th><th>Tên sự kiện</th><th>Họ tên</th><th>Địa chỉ</th><th>Gía vé</th><th>Thời gian đặt vé</th><th>Trạng thái vé</th><th>Action</th></tr></thead>';
                    eventHtml += '<tbody>';
                    
                    events.forEach(function(event) {
                        eventHtml += '<tr><td>' + i++ + '</td><td>' + event.Tensukien + '</td><td>' + event.hoten + '</td><td>' + event.diachi + '</td><td>'+event.Giave + '</td><td>' +event.thoigiandatve + '</td><td>'; 
                        if(event.Trangthaive == '3'){
                            eventHtml +='<span style="color:red;">Hủy vé</span>' + '</td><td>';   
                            eventHtml += '<a  style="text-decoration:none;color:red" href="#" onclick="xoave(' + event.Idve + ')">Hủy vé</a>';

                      }else if(event.Trangthaive == '1'){
                          eventHtml += '<span style="color: orange;">Chưa xác nhận</span>' + '</td><td>' ;
                          eventHtml += '<a id="trangthai" style="text-decoration:none;color: orange;" href="#" onclick="updateTrangthai(' + event.Idve + ')">Xác nhận</a>';
                          
                      }
                        
                    });
                    
                    eventHtml += '</tbody></table></div>';
                    
                    $('#xemvenv').html(eventHtml);
                } else {
                    $('#xemvenv').html('<div class="col">Không có vé nào.</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching events:', error);
                $('#xemvenv').html('<div class="col">An error occurred while fetching events.</div>');
            }
        });
    };
    function updateTrangthai(idve) {
        // Gửi yêu cầu đến api.php để cập nhật trạng thái
        fetch('./api/api.php?action=trangthai&id=' + idve)
            .then(response => response.text())
            .then(data => {
                
                if (data === 'gui') {
                    // Chuyển hướng người dùng sau khi cập nhật thành công
                    openPopup('Cập nhật thành công', '');
                    setTimeout(function() {
                        window.location.href = 'index.php?nhanve';
                    }, 2000);
                } else {
                    openPopup('Cập nhật không thành công','');
                }
            })
            .catch(error => console.error('Lỗi:', error));
    }
    function xoave(idve) {
        // Gửi yêu cầu đến api.php để cập nhật trạng thái
        fetch('./api/api.php?action=xoave&id=' + idve)
            .then(response => response.text())
            .then(data => {
               
                if (data === 'gui') {
                    // Chuyển hướng người dùng sau khi cập nhật thành công
                    openPopup('Hủy vé thành công', '');
                    setTimeout(function() {
                        window.location.href = 'index.php?nhanve';
                    }, 2000);
                } else {
                    openPopup('Hủy vé không thành công','');
                }
            })
            .catch(error => console.error('Lỗi:', error));
    }
   
    function timkiemsk() {
        document.getElementById('searchBtn').addEventListener('click', function () {
            const keyword = document.getElementById('keyword').value;

            // Gửi yêu cầu AJAX tới API PHP
            $.ajax({
                url: './api/api.php?action=timkiemsk',
                type: 'GET',
                data: { keyword: keyword }, // Truyền từ khóa tìm kiếm
                success: function (response) {
                    if (response && response.length > 0) {
                        var events = response;
                        var eventHtml = '';
                        events.forEach(function (event, index) {
                            if (index % 4 === 0) {
                                eventHtml += '<div class="row">';
                            }

                            eventHtml += '<div class="col-3 mb-3">';
                            eventHtml += '<div class="card">';

                            eventHtml += '<a href="index.php?xemnd=' + event.Idsk + '&xembl=' + event.Idsk +'&xemnd1=' + event.Idsk + '"><img  src="images/' + event.anh + '" class="card-img-top" alt="' + event.Tensukien + '"></a>';
                            if (event.Trangthai == '1') {
                                eventHtml += '<span class="italic-text" >Hết vé</span>';
                            } else {
                                eventHtml += '<span class="italic-text-con">Còn vé</span>';
                            }
                            eventHtml += '<div class="card-body">';

                            eventHtml += '<a href="index.php?xemnd=' + event.Idsk + '&xembl=' + event.Idsk +'&xemnd1=' + event.Idsk + '"><h5 class="card-title">' + event.Tensukien + '</h5></a>';
                            eventHtml += '<a href="index.php?xemtag= ' + encodeURIComponent(event.tag.trim()) + '"><p class="card-text">' + event.tag + '</p></a>';

                            // Add other event details as needed
                            eventHtml += '</div></div></div>';

                            if ((index + 1) % 4 === 0 || (index + 1) === events.length) {
                                eventHtml += '</div>';
                            }

                        });

                        document.getElementById('events').innerHTML = eventHtml;
                    } else {
                        document.getElementById('events').innerHTML = 'Không tìm thấy sự kiện.';
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Lỗi khi tìm kiếm:', error);
                    document.getElementById('events').innerHTML = 'Đã xảy ra lỗi.';
                }
            });
        });
    }
  
    function xoabl(idbl) {
        // Gửi yêu cầu đến api.php để cập nhật trạng thái
        fetch('./api/api.php?action=xoabl&idbl=' + idbl)
            .then(response => response.text())
            .then(data => {
                
                if (data === 'gui') {
                    // Chuyển hướng người dùng sau khi cập nhật thành công
                    openPopup('Xóa thành công', '');
                   
                } else {
                    openPopup('xóa không thành công','');
                }
            })
            .catch(error => console.error('Lỗi:', error));
    }

    function guibl() {
        $('#guibl').on('submit', function(event) {
            event.preventDefault(); // Chặn hành động mặc định của form

            // Thực hiện các hành động AJAX hoặc xử lý dữ liệu tại đây
            var formData = $(this).serialize(); // Thu thập dữ liệu form nếu cần
            
            $.ajax({
                url: './api/api.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'gui') {
                        // Xử lý khi gửi thành công, ví dụ: hiển thị thông báo
                        openPopup('Gửi bình luận thành công', '');
                    } else {
                        openPopup('Gửi bình luận thành công', '');
                        
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error submitting form:', error);
                    alert('Đã xảy ra lỗi khi gửi bình luận.');
                }
            });

            return false; // Đảm bảo rằng form không tiếp tục chuyển trang
        });
      }
    
    function qlsk() {
        $.ajax({
                url: './api/api.php?action=qlsk',
                type: 'GET',
                success: function(response) {
                    if (response && response.length > 0) {
                        var events = response;
                        var eventHtml = '';
        
                        events.forEach(function(event, index) {

                            if (index % 4 === 0) {
                                eventHtml += '<div class="row">';
                            }
                        
                            eventHtml += '<div class="col-3 mb-3">';
                            eventHtml += '<div class="card">';
                
                            eventHtml += '<a href="index.php?xemnd2='+ event.Idsk +'&xemnd3=' + event.Idsk+  '&xembl=' + event.Idsk + '"><img  src="images/' + event.anh + '" class="card-img-top" alt="' + event.Tensukien + '"></a>';
                            if(event.Trangthai == '1'){
                            eventHtml += '<span class="italic-text" >Hết vé</span>'
                            }else{
                            eventHtml += '<span class="italic-text-con">Còn vé</span>'
                            }
                            eventHtml += '<div class="card-body">';
        
                            eventHtml += '<a href="index.php?xemnd2=' + event.Idsk +'&xemnd3=' + event.Idsk+ '&xembl=' + event.Idsk + '"><h5 class="card-title">' + event.Tensukien + '</h5></a>';
                            eventHtml += '<p class="card-text">' + event.tag + '</p>';
        
                            // Add other event details as needed
                            eventHtml += '</div></div></div>';
        
                            if ((index + 1) % 4 === 0 || (index + 1) === events.length) {
                                eventHtml += '</div>';
                            }
                          
                        });
        
                        $('#eventqlsk').html(eventHtml);
                    } else {
                        $('#eventqlsk').html('<div class="col">No events found.</div>');
                    }
                },
               
            });
    }
    function qlsk12() {
        $.ajax({
            url: './api/api.php?action=qlsk12', 
            type: 'GET',
            success: function(response) {
                console.log(response);
                if (response && response.length > 0) {
                    let events = response;
                    let eventHtml = '';
                    
                    let i = 1;
                    
                    eventHtml += `<table class="table table-hover text-center">
                      <thead>
                        <tr>
                          <th scope="col">STT</th>
                          <th scope="col">Tên sự kiện</th>
                          <th scope="col">Tag</th>
                          <th scope="col">Ảnh</th>
                          <th scope="col">Trạng Thái</th>
                          <th scope="col">Thao Tác</th>
                        </tr>
                      </thead>
                      <tbody>`;
                    
                    events.forEach(function(event) {
                        eventHtml += '<tr><th scope="row">'+ i++ +'</th>';
                        eventHtml += '<td>'+ '<a href="index.php?xemnd2='+ event.Idsk +'&xemnd3=' + event.Idsk+  '&xembl=' + event.Idsk + '">'+event.Tensukien+'</a>'+'</td>';
                        eventHtml += '<td>'+event.tag+'</td>';
   
                        eventHtml += '<td>'+'<a href="index.php?xemnd2='+ event.Idsk +'&xemnd3=' + event.Idsk+  '&xembl=' + event.Idsk + '"><img  src="images/' + event.anh + '" width=50px height=50px alt="' + event.Tensukien + '"></a>'+'</td>';
                        eventHtml +='<td>';
                        if(event.Trangthai == '1'){
                            eventHtml += '<span class="italic-text" >Hết vé</span>'
                            }else{
                            eventHtml += '<span class="italic-text-con">Còn vé</span>'
                            } 
                        eventHtml +='</td>';
  
  
                       
                        eventHtml +='<td><button style="color: black;background:rgb(99, 194, 237);" onclick="xoasukien('+event.Idsk+')">Xóa sự kiện</button>';
                   
                       
                        eventHtml += '</td></tr>';
                        
                    });
                    
                    eventHtml += '</tbody></table>';
                    
                    $('#qlsk12').html(eventHtml);
                } else {
                    $('#qlsk12').html('<div class="col">Không có vé nào.</div>');
                }
            },
           
        });
    };

function themsukien() {
        $('#themsukien').submit(function(e) {
            e.preventDefault();
    
            // Lấy các giá trị cần kiểm tra
            var sotien = parseFloat($('#sotien').val());
            var tgbd = new Date($('#thoigianbd').val());
            var tgkt = new Date($('#thoigiankt').val());
    
            // Kiểm tra giá trị tiền
            if (sotien <= 0) {
                openPopup('Giá sự kiện phải lớn hơn 0', '');
                return;
            }
    
            // Kiểm tra thời gian
            if (tgbd >= tgkt) {
                openPopup('Thời gian bắt đầu không thể sau thời gian kết thúc', '');
                return;
            }
    
            // Gửi AJAX nếu mọi thứ hợp lệ
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: new FormData($('#themsukien')[0]),
                processData: false,
                contentType: false,
                success: function(response) {
                    // Xem 
                    if (response === 'dangky') {
                        openPopup('Thêm thành công', '');
                        setTimeout(function() {
                            window.location.href = 'index.php?qlsk';
                        }, 2000);
                    } else if (response === 'lỗi') {
                        openPopup('Không đúng loại ảnh', '');
                    } else if (response === 'Lỗi SQL:') {
                        openPopup('Lỗi khi thêm sự kiện', '');
                    }
                }
            });
        });
    }


    function suasukien() {
        $('#suasukien').submit(function(e) {
            e.preventDefault();
    
            // Lấy các giá trị cần kiểm tra
            var sotien = parseFloat($('#sotien').val());
            var tgbd = new Date($('#thoigianbd').val());
            var tgkt = new Date($('#thoigiankt').val());
    
            // Kiểm tra giá trị tiền
            if (sotien <= 0) {
                openPopup('Giá sự kiện phải lớn hơn 0', '');
                return;
            }
    
            // Kiểm tra thời gian
            if (tgbd >= tgkt) {
                openPopup('Thời gian bắt đầu không thể sau thời gian kết thúc', '');
                return;
            }
    
            // Gửi AJAX nếu mọi thứ hợp lệ
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: new FormData($('#suasukien')[0]),
                processData: false,
                contentType: false,
                success: function(response) {
                   
                    if (response === 'dangky') {
                        openPopup('Sửa thành công', '');
                       
                    } else if (response === 'lỗi') {
                        openPopup('Không đúng loại ảnh', '');
                    } else if (response === 'Lỗi SQL:') {
                        openPopup('Lỗi khi thêm sự kiện', '');
                    }
                }
            });
        });
    }
   
      function datve2() {
        $('#datve').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: $(this).serialize(),
                success: function(response) {

                  
                    if(response === 'gui'){
                        openPopup('Đặt vé thành công','')
                    }else if(response === 'Không đủ điểm'){
                        openPopup('ko đủ điểm','')
                    }
                    else if(response === 'lỗi'){
                        openPopup('lỗi','')
                    }
                    
                    
                }
            });
        });
    }

    function ttcn() {
        
        $('#capnhatttcn').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    if(response === 'dangky'){
                        openPopup('Cập nhật thành công.', '');
                        setTimeout(function() {
                            window.location.href = 'index.php?ttcn';
                        }, 1000);
                    }else if(response === 'kotc_no_change'){
                        openPopup('Cập nhật thành công ko đổi.', '');
                    }
                    else{
                        openPopup('Cập nhật không thành công.', '');
                    }
                    
                    
                }
            });
        });
        
      };

      function guest() {
        $.ajax({
            url: './api/api.php?action=guest', 
            type: 'GET',
            success: function(response) {
                console.log(response);
                if (response && response.length > 0) {
                    let events = response;
                    let eventHtml = '';
                    
                    let i = 1;
                    
                    eventHtml += `<table class="table table-hover text-center">
                      <thead>
                        <tr>
                          <th scope="col">STT</th>
                          <th scope="col">Tên tài khoản</th>
<th scope="col">Họ và tên</th>
                          <th scope="col">Email</th>
                          <th scope="col">Số điện thoại</th>
                          <th scope="col">Địa chỉ</th>
                          <th scope="col">Thao Tác</th>
                        </tr>
                      </thead>
                      <tbody>`;
                    
                    events.forEach(function(event) {
                        eventHtml += '<tr><th scope="row">'+ i++ +'</th>';
                        eventHtml += '<td>'+ event.username+'</td>';
                        eventHtml += '<td>'+event.hoten+'</td>';
   
                        eventHtml += '<td>'+event.email+'</td>';
                        eventHtml +='<td>'+event.phone_number+'</td>';
                        eventHtml += '<td>'+event.address+'</td>';
  
  
                       
                        eventHtml +='<td><a class="huy" href="#" class="ti-trash no-underline link-muted" title="Xóa" onclick= "xoakhach('+event.id+')">Xóa</a>&nbsp;|&nbsp';
                        eventHtml +='<a href="index.php?xemuser='+event.id+'&xemmk='+event.id +'" class="ti-pencil-alt no-underline link-muted" title="Sửa">Sửa</a>&nbsp;&nbsp;';
                   
                       
                        eventHtml += '</td></tr>';
                        
                    });
                    
                    eventHtml += '</tbody></table>';
                    
                    $('#khach').html(eventHtml);
                } else {
                    $('#khach').html('<div class="col"></div>');
                }
            },
           
        });
    };

    function xoakhach(idus) {
        // Gửi yêu cầu đến api.php để cập nhật trạng thái
        fetch('./api/api.php?action=xoakhach&id=' + idus)
            .then(response => response.text())
            .then(data => {
               
                if (data === 'gui') {
                    // Chuyển hướng người dùng sau khi cập nhật thành công
                    openPopup('Xóa thành công', '');
                    setTimeout(function() {
                        window.location.href = 'index.php?qltk';
                    }, 1000);
                } else {
                    openPopup('Xóa không thành công','');
                }
            })
            .catch(error => console.error('Lỗi:', error));
    }

    function dvtc() {
        $.ajax({
            url: './api/api.php?action=dvtc', 
            type: 'GET',
            success: function(response) {
                console.log(response);
                if (response && response.length > 0) {
                    let events = response;
                    let eventHtml = '';
                    
                    let i = 1;
                    
                    eventHtml += `<table class="table table-hover text-center">
                      <thead>
                        <tr>
                          <th scope="col">STT</th>
                          <th scope="col">Tên tài khoản</th>
<th scope="col">Họ và tên</th>
                          <th scope="col">Email</th>
                          <th scope="col">Số điện thoại</th>
                          <th scope="col">Địa chỉ</th>
                          <th scope="col">Thao Tác</th>
                        </tr>
                      </thead>
                      <tbody>`;
                    
                    events.forEach(function(event) {
                        eventHtml += '<tr><th scope="row">'+ i++ +'</th>';
                        eventHtml += '<td>'+ event.username+'</td>';
                        eventHtml += '<td>'+event.hoten+'</td>';
   
                        eventHtml += '<td>'+event.email+'</td>';
                        eventHtml +='<td>'+event.phone_number+'</td>';
                        eventHtml += '<td>'+event.address+'</td>';
  
  
                       
                        eventHtml +='<td><a class="huy" href="#" class="ti-trash no-underline link-muted" title="Xóa" onclick= "xoakhach('+event.id+')">Xóa</a>&nbsp;|&nbsp';
                        eventHtml +='<a href="index.php?xemuser='+event.id+'&xemmk='+event.id +'" class="ti-pencil-alt no-underline link-muted" title="Sửa">Sửa</a>&nbsp;&nbsp;';
                   
                       
                        eventHtml += '</td></tr>';
                        
                    });
                    
                    eventHtml += '</tbody></table>';
                    
                    $('#dv').html(eventHtml);
                } else {
                    $('#dv').html('<div class="col">Không có vé nào.</div>');
                }
            },
           
        });
    };
   
    function employee() {
        $.ajax({
            url: './api/api.php?action=employee', 
            type: 'GET',
            success: function(response) {
                console.log(response);
                if (response && response.length > 0) {
                    let events = response;
                    let eventHtml = '';
                    
                    let i = 1;
                    
                    eventHtml += `<table class="table table-hover text-center">
                      <thead>
                        <tr>
                          <th scope="col">STT</th>
                          <th scope="col">Tên tài khoản</th>
<th scope="col">Họ và tên</th>
                          <th scope="col">Email</th>
                          <th scope="col">Số điện thoại</th>
                          <th scope="col">Địa chỉ</th>
                          <th scope="col">Thao Tác</th>
                        </tr>
                      </thead>
                      <tbody>`;
                    
                    events.forEach(function(event) {
                        eventHtml += '<tr><th scope="row">'+ i++ +'</th>';
                        eventHtml += '<td>'+ event.username+'</td>';
                        eventHtml += '<td>'+event.hoten+'</td>';
   
                        eventHtml += '<td>'+event.email+'</td>';
                        eventHtml +='<td>'+event.phone_number+'</td>';
                        eventHtml += '<td>'+event.address+'</td>';
  
  
                       
                        eventHtml +='<td><a class="huy" href="" class="ti-trash no-underline link-muted" title="Xóa" onclick= "xoakhach('+event.id+')">Xóa</a>&nbsp;|&nbsp';
                        eventHtml +='<a href="index.php?xemuser='+event.id+'&xemmk='+event.id +'" class="ti-pencil-alt no-underline link-muted" title="Sửa">Sửa</a>&nbsp;&nbsp;';
                   
                       
                        eventHtml += '</td></tr>';
                        
                    });
                    
                    eventHtml += '</tbody></table>';
                    
                    $('#nv').html(eventHtml);
                } else {
                    $('#nv').html('<div class="col">Không có vé nào.</div>');
                }
            },
           
        });
    };

    function xemuser() {
        const urlParams1 = new URLSearchParams(window.location.search);
        const idnd = urlParams1.get('xemuser');
       
       
        // Sử dụng ID để gửi yêu cầu AJAX và hiển thị nội dung tương ứng
        $.ajax({
            url: './api/api.php?action=xemuser&id=' + idnd, // Thêm ID vào URL
            type: 'GET',
            success: function(response) {
               
                if (response && response.length > 0) {
                    const event = response[0]; // Lấy sự kiện đầu tiên
                    
                    // Xây dựng HTML cho nội dung sự kiện
                    let eventHtml = '';
                    eventHtml += `
                    <input type="hidden" name="id" id="id" value="`+event.id+`">

                    <div class="input__wrapper"> 
        <label for="taikhoan" class="input__label">Tài khoản:</label>
            <input type="text" id="tk" name="tk" class="input__field" placeholder="Tài khoản" value="`+event.username+`"  required >
            <div id="icon">
                <i class="far fa-user"></i>
            </div>
             
            <!--svg--> 
            
        </div> 
        <div class="input__wrapper"> 
        <label for="ht" class="input__label">Họ tên:</label> 
            <input type="text" id="ht" name="ht" class="input__field"  placeholder="Your name" value="`+event.hoten+`" required >
            <div id="icon">
                <i class="fas fa-envelope"></i>
            </div>
           
            <!--svg--> 
            
        </div> 
        <div class="input__wrapper"> 
        <label for="email" class="input__label">Email:</label> 
            <input type="email" id="email" name="email" class="input__field"  placeholder="Your Email" value="`+event.email+`" required >
            <div id="icon">
                <i class="fas fa-envelope"></i>
            </div>
            
            <!--svg--> 
            
        </div> 

        <div class="input__wrapper"> 
        <label for="sdt" class="input__label">Số điện thoại:</label> 
            <input type="text" id="sdt" name="sdt" class="input__field" placeholder="Your Phone"  value="`+event.phone_number+`"  required >
            <div id="icon">
                <i class="fas fa-phone"></i>
            </div>
           
            <!--svg--> 
            
        </div> 
        <div class="input__wrapper"> 
        <label for="sdt" class="input__label">Địa chỉ:</label> 
        <!--svg--> 
            <input type="text" id="dc" name="dc" class="input__field" placeholder="Your address" value="`+event.address+`" required >
            <div id="icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
         
            
        </div> 
       
       
       
        <div class="input__wrapper"> 
        <label for="role" class="input__label">Role:</label> 
            <select id="role" name="role">
            <option value="`+event.role+`">`+event.role+`</option>
                <option value="guest">Khách hàng</option>
                <option value="dvtc">Đơn vị tổ chức</option>
                 <option value="employee">Nhân viên</option>
            </select>
         
            
            <!--svg-->  
        </div> `
                   
                  
                    // Thêm các trường nhập và nút gửi bình luận
    
                    // Hiển thị HTML trong phần tử #contentnd
                    $('#xemuser').html(eventHtml);
                } else {
                    $('#xemuser').html('Không tìm thấy sự kiện với ID ' + idnd);
                }
            },
           
        });
    }

    function xemmk() {
        const urlParams1 = new URLSearchParams(window.location.search);
        const idnd = urlParams1.get('xemmk');
       
       
        // Sử dụng ID để gửi yêu cầu AJAX và hiển thị nội dung tương ứng
        $.ajax({
            url: './api/api.php?action=xemmk&id=' + idnd, // Thêm ID vào URL
            type: 'GET',
            success: function(response) {
               
                if (response && response.length > 0) {
                    const event = response[0]; // Lấy sự kiện đầu tiên
                    
                    // Xây dựng HTML cho nội dung sự kiện
                    let eventHtml = '';
                    eventHtml += `  <input type="hidden" name="id" id="id" value="`+event.id+`">

                   
        <div class="input__wrapper"> 
        <label for="email" class="input__label">Password:</label> 
            <input type="text id="pass" name="pass" class="input__field"  placeholder="Your pass" value="`+event.password+`" required >
           
            
            <!--svg--> 
            
        </div> 
       
       
        `
                   
                  
                    // Thêm các trường nhập và nút gửi bình luận
    
                    // Hiển thị HTML trong phần tử #contentnd
                    $('#xemmk').html(eventHtml);
                } else {
                    $('#xemmk').html('Không tìm thấy sự kiện với ID ' + idnd);
                }
            },
           
        });
    }

    function suauser() {
        $('#suauser').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    if(response === 'dangky'){
                        openPopup('Cập nhật thành công','');
                        setTimeout(function() {
                            window.location.href = 'index.php?qltk';
                        }, 1000);
                    }
                    else{
                        openPopup('Cập nhật không thành công','');
                    }
                    
                    
                }
            });
        });
        
      };

      function suamk() {
        $('#suamk').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    if(response === 'capnhat'){
                        openPopup('Cập nhật thành công','');
                        setTimeout(function() {
                            window.location.href = 'index.php?qltk';
                        }, 1000);
                    }
                    else{
                        openPopup('Cập nhật không thành công','');
                    }
                    
                    
                }
            });
        });
        
      };

      function generateRandomString(length) {
        const characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let randomString = '';
        for (let i = 0; i < length; i++) {
            randomString += characters[Math.floor(Math.random() * characters.length)];
        }
        return randomString;
    }
    
    const randomString = generateRandomString(8);
   
    
      function xemthanhtoan() {
        const urlParams6 = new URLSearchParams(window.location.search);
        const id = urlParams6.get('thanhtoan');
        
        $.ajax({
            url: './api/api.php?action=thanhtoan&idve=' + id,
            type: 'GET',
            success: function(response) {

                let eventHtml = '';
    
                if (response && response.length > 0) {
                    const event = response[0]; // Lấy phần tử đầu tiên của mảng
                    // ${event.Idht}
                    eventHtml += `
                     <div class="form-group">
                        <label for="order_id">Mã hóa đơn</label>
                        <input class="form-control"  id="order_id" name="order_id" type="text" value="${event.Idve + randomString}" readonly/>
                        
                    </div>
                    <div class="form-group">
                        <label for="amount">Số tiền</label>
                        <input class="form-control" id="amount"
                               name="amount" type="number" value="${event.Giave}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="order_desc">Nội dung thanh toán</label>
                        
                        <input class="form-control" id="order_desc" name="order_desc" type="text" value="${event.Tensukien}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="bank_code">Ngân hàng</label>
                        <select name="bank_code" id="bank_code" class="form-control">
                            <option value="">Không chọn</option>
                            <option value="NCB"> Ngan hang NCB</option>
                            <option value="AGRIBANK"> Ngan hang Agribank</option>
                            <option value="SCB"> Ngan hang SCB</option>
                            <option value="SACOMBANK">Ngan hang SacomBank</option>
                            <option value="EXIMBANK"> Ngan hang EximBank</option>
                            <option value="MSBANK"> Ngan hang MSBANK</option>
                            <option value="NAMABANK"> Ngan hang NamABank</option>
                            <option value="VNMART"> Vi dien tu VnMart</option>
                            <option value="VIETINBANK">Ngan hang Vietinbank</option>
                            <option value="VIETCOMBANK"> Ngan hang VCB</option>
                            <option value="HDBANK">Ngan hang HDBank</option>
                            <option value="DONGABANK"> Ngan hang Dong A</option>
                            <option value="TPBANK"> Ngân hàng TPBank</option>
                            <option value="OJB"> Ngân hàng OceanBank</option>
                            <option value="BIDV"> Ngân hàng BIDV</option>
                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                            <option value="VPBANK"> Ngan hang VPBank</option>
                            <option value="MBBANK"> Ngan hang MBBank</option>
                            <option value="ACB"> Ngan hang ACB</option>
                            <option value="OCB"> Ngan hang OCB</option>
                            <option value="IVB"> Ngan hang IVB</option>
                            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Ngôn ngữ</label>
                        <select name="language" id="language" class="form-control">
                            <option value="vn">Tiếng Việt</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                   
                    </td>
                     <td >
                    <div class="form-group">
                        <h3 style="color:black;">Thông tin hóa đơn (Billing)</h3>
                    </div>
                    <div class="form-group">
                        <label >Họ tên (*)</label>
                        <input class="form-control" id="txt_billing_fullname"
                               name="txt_billing_fullname" type="text" value="${event.hoten}"/>             
                    </div>
                    <div class="form-group">
                        <label >Email (*)</label>
                        <input class="form-control" id="txt_billing_email"
                               name="txt_billing_email" type="text" value="${event.email}"/>   
                    </div>
                    <div class="form-group">
                        <label >Số điện thoại (*)</label>
                        <input class="form-control" id="txt_billing_mobile"
                               name="txt_billing_mobile" type="text" value="${event.phone_number}"/>   
                    </div>
                    <div class="form-group">
                        <label >Địa chỉ (*)</label>
                        <input class="form-control" id="txt_billing_addr1"
                               name="txt_billing_addr1" type="text" value="${event.address}"/>   
                    </div>
                    <div class="form-group">
                        <label >Mã bưu điện (*)</label>
                        <input class="form-control" id="txt_postalcode"
                               name="txt_postalcode" type="text" value="100000"/> 
                    </div>
                    <div class="form-group">
                        <label >Tỉnh/TP (*)</label>
                        <input class="form-control" id="txt_bill_city"
                               name="txt_bill_city" type="text" value="TP Hồ Chí Minh"/> 
                    </div>
                    <div class="form-group">
                        <label ></label>
                        <input class="form-control" id="txt_bill_city"
                               name="txt_bill_city" type="text"/> 
                    </div>
                   
                    </td>
                   
                    `;
                } else {
                    eventHtml += '<p>Không tìm thấy dữ liệu.</p>';
                }
    
                $('#thanhtoan').html(eventHtml);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy sự kiện:', error);
                $('#thannhtoan').html('Đã xảy ra lỗi khi lấy sự kiện.');
            }
        });
    }

    function thanh() {
        $('#thanh').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './api/api.php',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    if(response === 'gui'){
                        openPopup('Cập nhật thành công','');
                        setTimeout(function() {
                            window.location.href = 'index.php?xemthanhtoan';
                        }, 1000);
                    }
                    else{
                        openPopup('Cập nhật không thành công','');
                    }
                    
                    
                }
            });
        });
        
      };

      function xemhoadon() {
        $.ajax({
            url: './api/api.php?action=xemhoadon', 
            type: 'GET',
            success: function(response) {
                console.log(response);
                if (response && response.length > 0) {
                    let events = response;
                    let eventHtml = '';
                    
                    let i = 1;
                    
                    eventHtml += `<table class="table table-hover text-center">
                      <thead>
                        <tr>
                          <th scope="col">STT</th>
                          <th scope="col">Tên tài khoản</th>
                          <th scope="col">Họ và tên</th>
                          <th scope="col">Nội dung hóa đơn</th>
                          <th scope="col">Số điện thoại</th>
                          <th scope="col">Địa chỉ</th>
                          <th scope="col">Gía</th>
                          <th scope="col">Thời gian</th>
                          <th scope="col">Thao Tác</th>
                        </tr>
                      </thead>
                      <tbody>`;
                    
                    events.forEach(function(event) {
                        eventHtml += '<tr><th scope="row">'+ i++ +'</th>';
                        eventHtml += '<td>'+ event.username+'</td>';
                        eventHtml += '<td>'+ event.hoten+'</td>';
                        eventHtml += '<td>'+event.Noidunghoadon+'</td>';
   
                        eventHtml += '<td>'+event.phone_number+'</td>';
                        eventHtml += '<td>'+event.address+'</td>';
                        eventHtml += '<td>'+event.sotien+'</td>';
                        eventHtml +='<td>'+event.Thoigian+'</td>';
                       
  
  
                        eventHtml +='<td><a href="index.php?xuathoadon='+event.Idhd+'" class="ti-pencil-alt no-underline link-muted" title="Sửa">In hóa đơn</a>&nbsp;|&nbsp';

                        eventHtml +='<a class="huy" href="" class="ti-trash no-underline link-muted"  onclick= "updatehd('+event.Idhd+')">Xóa</a>&nbsp;&nbsp;';
                   
                       
                        eventHtml += '</td></tr>';
                        
                    });
                    
                    eventHtml += '</tbody></table>';
                    
                    $('#xemhdo').html(eventHtml);
                } else {
                    $('#xemhdo').html('<div class="col">Không có vé nào.</div>');
                }
            },
           
        });
    };
    function updatehd(idhd) {
        // Gửi yêu cầu đến api.php để cập nhật trạng thái
        fetch('./api/api.php?action=xoahd&idhd=' + idhd)
            .then(response => response.text())
            .then(data => {
                
                if (data === 'gui') {
                    // Chuyển hướng người dùng sau khi cập nhật thành công
                    openPopup('Xóa thành công', '');
                    setTimeout(function() {
                        window.location.href = 'index.php?xemhd';
                    }, 2000);
                } else {
                    openPopup('xóa không thành công','');
                }
            })
            .catch(error => console.error('Lỗi:', error));
    }

    function xuathoadon() {
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('xuathoadon');
        $.ajax({
            url: './api/api.php?action=xuathoadon&idhd=' + id,
            type: 'GET',
            success: function(response) {
console.log(response);
                let eventHtml = '';
    
                if (response && response.length > 0) {
                    const event = response[0]; // Lấy phần tử đầu tiên của mảng
                    
                    eventHtml += `
                   
  
                    <h3 style="text-align: center;">HÓA ĐƠN</h3>
                    <hr>
                    

                    <p>Tên khách hàng:'`+event.username+`
                    </p>
                    <p>Địa chỉ:`+event.address+`</p>
                    <p>SĐT:`+event.phone_number+`</p>
                    <table>
                            <tr>
                                <th><b>Nội dung hóa đơn</b></th>
                                
                                <th><b>số tiền</b></th>
                                
                                

                            </tr>

                        <tr>
                            <td>`+event.Noidunghoadon+`</td>
                            <td>`+event.sotien+`</td>
                            
                            
                        </tr>
                    
                    
                    </table>
                    
                    
                    <p>Thời gian Thanh toán:`+event.Thoigian+`</p>
                    
                    
                    `;
                } else {
                    eventHtml += '<p>Không tìm thấy dữ liệu.</p>';
                }
    
                $('#hoad').html(eventHtml);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy sự kiện:', error);
                $('#hoad').html('Đã xảy ra lỗi khi lấy sự kiện.');
            }
        });
    }
  
   $(document).ready(function() {
        xem();
        xemtag();
       xemnd();
       xemnd1();
       xemnd2();
       xemnd3();
        datve();
        datve1();
        setInterval(xembl, 1000);
        setInterval(xemdiem, 1000);
        setInterval(xemhotro1, 1000);
        setInterval(hotronv, 1000);
       traloi();
       traloi1();
       xemvenv();
        guihotro();
        xoahotro();
        layout();
        setInterval(xemve, 1000);
        timkiemsk();
       
   });
