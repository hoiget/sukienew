<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbox</title>
    <style>
        /* Nút mở chatbox */
        .chat-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Chatbox */
        .chatbox {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 400px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none; /* Ẩn mặc định */
            flex-direction: column;
            overflow: hidden;
        }

        .chatbox-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            cursor: pointer;
        }

        .messages {
            height: 300px;
            overflow-y: auto;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }

        .input-container {
            display: flex;
            gap: 5px;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .input-container input {
            flex: 1;
            height: 50px;
            width: 282px;
            
        }
     
    .messages div {
        word-wrap: break-word; /* Ngắt dòng cho từ dài */
        margin-bottom: 10px; /* Khoảng cách giữa các tin nhắn */
    }

    .messages p {
        margin: 5px 0; /* Khoảng cách giữa các đoạn trong mỗi tin nhắn */
    }

    .messages span {
        font-size: 12px;
        color: gray;
    }
#buttop{
    width:100% ;
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

    </style>
</head>
<body>
<div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2></h2>
        <p></p>
        <button onclick="closePopup()">Ok</button>
    </div>
    <!-- Nút mở Chatbox -->
    <div class="chat-toggle">💬</div>

    <!-- Khung Chatbox -->
    <div class="chatbox">
        <div class="chatbox-header">Chat</div>
        <div class="messages" id="messages"></div>
        <div class="input-container">
            <form id="guibox" action="./api/api.php" method="post">
                <input type="hidden" name="action" value="guibox">
                <input type="hidden" name="sender_id" value="<?php echo $user_id; ?>">
                <input type="text" id="message-input" name="message" placeholder="Nhập tin nhắn...">
                <button type="button" id="send-button">Gửi</button>
                <?php
                if($role=='admin'){
                    echo '<br><br><button type="button" id="buttop" onclick="xoabox()">Xóa</button>';
                }
                 ?>
            </form>
        </div>
    </div>

    <!-- Thêm jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Định nghĩa biến sessionId
   

        // Hàm xembox: lấy tin nhắn từ API
        function getTimeAgo(sentAt) {
    const sentTime = new Date(sentAt).getTime(); // Chuyển thời gian gửi thành timestamp
    const currentTime = Date.now(); // Lấy timestamp hiện tại
    const timeDiff = Math.abs(currentTime - sentTime) / 1000; // Khoảng cách thời gian tính bằng giây

    let timeAgo = "";

    if (timeDiff < 60) {
        timeAgo = Math.floor(timeDiff) + " giây trước";
    } else if (timeDiff < 3600) {
        const minutesAgo = Math.floor(timeDiff / 60);
        timeAgo = minutesAgo + " phút trước";
    } else if (timeDiff < 86400) {
        const hoursAgo = Math.floor(timeDiff / 3600);
        timeAgo = hoursAgo + " giờ trước";
    } else {
        const daysAgo = Math.floor(timeDiff / 86400);
        timeAgo = daysAgo + " ngày trước";
    }

    return timeAgo;
}

function xembox() {
    $.ajax({
        url: './api/api.php?action=xembox',
        type: 'GET',
        success: function(response) {
            if (response && response.length > 0) {
                let events = response;
                let eventHtml = '';

                events.forEach(function(event) {
                    const timeAgo = getTimeAgo(event.sent_at); // Tính thời gian "time ago"

                    if (sessionId == event.sender_id) {
                        eventHtml += `
                            <div style="float: right; margin-bottom: 10px; word-wrap: break-word;width:50%;border:1px solid blue;box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);">
                                <p style="font-size:14px; color:blue; margin: 0; font-weight: bold;padding-left:7px">
                                    
                                    ${event.message}
                               

                                </p>
                                
                                <span style="font-size:12px; color:gray;padding-left:7px">${timeAgo}</span>
                            </div>
                        `;
                    } else {
                        eventHtml += `
                            <div style="float: left; margin-bottom: 10px; word-wrap: break-word;border:1px solid blue;width:50%;box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);">
                                <p style="font-size:14px; color: orange; margin: 0; font-weight: bold;padding-left:7px">
                                    ${event.username}
                                </p>
                               <p style="font-size:14px; color:black; margin: 0; font-weight: bold;padding-left:7px">
                                    ${event.message}
                                </p>
                                <span style="font-size:12px; color:gray;padding-left:7px">${timeAgo}</span>
                            </div>
                        `;
                    }
                });

                $('#messages').html(eventHtml);
            } else {
                $('#messages').html('<div class="col">Không có tin nhắn nào.</div>');
            }
        },
        error: function() {
            console.error("Lỗi khi tải tin nhắn.");
        }
    });
}


        // Hàm xử lý gửi tin nhắn
        function guibox() {
    // Hàm chung để gửi tin nhắn
    function sendMessage() {
        const message = $('#message-input').val();
        if (!message.trim()) {
            alert("Vui lòng nhập tin nhắn!");
            return;
        }

        $.ajax({
            url: './api/api.php',
            type: 'POST',
            data: $('#guibox').serialize(), // Lấy dữ liệu từ form
            success: function(response) {
                $('#message-input').val(''); // Xóa nội dung input sau khi gửi
                xembox(); // Tải lại danh sách tin nhắn
            },
            error: function() {
                alert("Gửi tin nhắn thất bại.");
            }
        });
    }

    // Lắng nghe sự kiện submit của form
    $('#guibox').on('submit', function(e) {
        e.preventDefault(); // Ngăn hành vi mặc định của form
        sendMessage(); // Gọi hàm gửi tin nhắn
    });

    // Lắng nghe sự kiện click của nút gửi
    $('#send-button').on('click', function(e) {
        e.preventDefault(); // Ngăn hành vi mặc định (phòng trường hợp nút trong form)
        sendMessage(); // Gọi hàm gửi tin nhắn
    });
}


        // Khi tài liệu đã sẵn sàng
        $(document).ready(function() {
            // Gọi hàm
           
            guibox();

            // Sự kiện bật/tắt chatbox
            $('.chat-toggle').on('click', function () {
                $('.chatbox').toggle();
            });

            // Tải tin nhắn mới mỗi 5 giây
            setInterval(xembox, 1000);
        });
        function xoabox() {
        // Gửi yêu cầu đến api.php để cập nhật trạng thái
        fetch('./api/api.php?action=xoabox')
            .then(response => response.text())
            .then(data => {
                
                if (data === 'gui') {
                    // Chuyển hướng người dùng sau khi cập nhật thành công
                    openPopup('xóa tin nhắn thành công', '');
                    
                } else {
                    openPopup('Cập nhật không thành công','');
                }
            })
            .catch(error => console.error('Lỗi:', error));
    }
    </script>
</body>
</html>