
<style>
 input{
        border:none;
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
<body>
   
<div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2></h2>
        <p></p>
        <button onclick="closePopup()">Ok</button>
    </div>
    


<div class="profile">
    <div class="profile-card">
        <div class="profile-header">
            <h1>Thông tin cá nhân</h1>
        </div>
        <div class="profile-body">
            <ul>
                <form id="capnhatttcn" action="./api/api.php" method="post">
                <input type="hidden" name="action" value="capnhatttcn">
                <input type="hidden" name="id" id="id" value="<?php echo $user_id; ?>">
                <div  id="user"></div>
                <br>
                <center><button type="submit">Cập nhật</button></center>
                </form>
            </ul>
        </div>
    </div>
</div>
<script>
    
      $(document).ready(function() {
        user();
        ttcn();

      });
</script>
</body>
