<style>
    
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
    z-index: 9998;
}
</style>
<body>
<div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2></h2>
        <p></p>
        <button onclick="closePopup()">Ok</button>
</div>
    
  <div class="rowcon">
    <div class="form-container">
        <h2>Gửi Phản Hồi</h2>
        <form  id="guihotro" action="./api/api.php" method="post"> 
            <input type="hidden" name="action" value="guihotro">
            <div class="form-group">
                <label for="noidung">Nội dung:</label>
                <textarea id="noidung" name="noidung" placeholder="Nhập nội dung..." ></textarea>
            </div>
            <div class="form-group">
                <label for="traloi">Tên khách hàng</label>
                <select name="ten" id="ten">
                <option value="<?php echo $user_id; ?>"><?php echo $hoten; ?></option>
                </select>
            </div>
            <button type="submit">Gửi</button>
        </form>
    </div>
          
    <div class="xemhotro">
        <div class="row" id="events1"></div>
    </div>
    </div> 
    
   

</body>
</html>

</body>
