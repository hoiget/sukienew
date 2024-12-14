<style>
    .rowconnn {
 
  width: 100%;
 
 
}
/* Reset CSS */


.form-container {
  background-color: #fff;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  width: 100%;
  text-align: center;
  
}

.form-container h2 {
  margin-bottom: 1rem;
  color: #333;
}

.form-group {
  margin-bottom: 1rem;
  text-align: left;
}

.form-group label {
  display: block;
  font-size: 1rem;
  margin-bottom: 0.5rem;
  color: #555;
}

.form-group textarea {
  width: 100%;
  padding: 0.8rem;
  font-size: 1rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  resize: vertical;
}

.form-group textarea:focus {
  border-color: #fda085;
  outline: none;
  box-shadow: 0 0 4px rgba(253, 160, 133, 0.5);
}

button {
  background-color: #fda085;
  color: #fff;
  font-size: 1rem;
  padding: 0.8rem 2rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background 0.3s ease;
}

button:hover {
  background-color: #f68a62;
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
<center><h1>Nội dung chi tiết</h1></center>
<br><br>
                    <div class="rowconnn">
                        <div class="form-container">
                            <h2>Đặt vé</h2>
                            <form id="datve" action="./api/api.php" method="post">
                                <input type="hidden" name="action" value="datve">
                                <div id="contentsk"></div>
                                <div id="contentus"></div>
                                <button type="submit">Đặt vé</button>
                            </form>
                        </div>
                    </div>

                  

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>

    $(document).ready(function() {
        datve2();
    });
</script>
</body>
</html>