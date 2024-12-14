

<html>
<head>
<title>Thanh toán online</title>
<style>
       table {
            width: 400px;
           
            background-color: #fff;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }

        table td {
            padding: 10px;
        }

        table tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            display: block;
            width: 100px;
           
            padding: 8px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        #qrcode{
            float: right;
            padding-right:50px;
           
        }
        #fm{
            float: left;
            padding-right:50px;
            
        }
        #inp{float: none;}

</style>
</head>
<body>

 
 <div id="nh" class="tabcontent">
 <?php require_once("config.php"); ?>             
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">Thanh toán online</h3>
            </div>
           
            <div class="table-responsive">
                <form action="view/vnpay_create_payment.php" id="create_form" method="post">       
<table style="margin:auto;width:100%;">
    <tr>
        
        
       
    <td >
    <div class="form-group">
    <h3 style="color:black">Tạo mới đơn hàng</h3>
</div>
                    <div class="form-group">

                        <label for="language">Loại hàng hóa </label>

                        <select name="order_type" id="order_type" class="form-control">
                            
                            <option value="billpayment">Thanh toán hóa đơn</option>
                           
                            <option value="other">Khác</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label >Thời hạn thanh toán</label>
                        <input class="form-control" id="txtexpire"
                               name="txtexpire" type="text" value="<?php echo $expire; ?>" readonly/>
                    </div>
                    <div id="thanhtoan"></div>
               
               
                    </tr>
</table>
<br><center>
                  
                    <button type="submit" name="redirect" id="redirect" class="btn btn-primary">Thanh toán</button></center>

                </form>
            </div>
            <p>
                &nbsp;
            </p>
            
        </div>  
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function() {
        xemthanhtoan();
    });
</script>
</body>



</html>



