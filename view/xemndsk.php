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
.quay{
    text-decoration:none;
    color:black;
    padding-left:10px;
}
    
.form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 98%;
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
</style>

<body>
<div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <h2></h2>
        <p></p>
        <button onclick="closePopup()">Ok</button>
    </div>
    <br>



<?php
if (!isset($_SESSION['email'])) {
    echo'<<a class="quay" href="index.php?xemsk">Quay lại</a>
   <center><h1>Nội dung chi tiết</h1></center>

<div id="contentndsk"></div>';
}else{
if($role=='dvtc'){
  ?>
  <a class="quay" href="index.php?qlsk">Quay lại</a>
  <div class="form-container">
    <h2>Sửa sự kiện</h2>
    <form  id="suasukien" action="./api/api.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="sua">

        <div hidden class="form-group">
            <label for="iduser">User ID</label>
            
            <input type="text" id="iduser" name="iduser" value="<?php echo $user_id; ?>" required>
        </div>
       

<div id="contentndsk2"></div>

    </form>
    <div id="contentndsk3"></div>
</div>
  <?php  
}
?>

<?php 
if($role=='guest' || $role=='admin'){

?>
<a class="quay" href="index.php?xemsk">Quay lại</a>
   <center><h1>Nội dung chi tiết</h1></center>

<div id="contentndsk"></div>
<?php  
}}
?>

<form id="guibl" action="./api/api.php" method="post">
    <input type="hidden" name="action" value="guibl">
    <div id="contentbll"></div>
</form>

<div id="contentbl"></div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function() {
        guibl();
      
        suasukien();
    });
</script>

</body>

