


<!DOCTYPE html>
<html>
<head>
    <title>Biểu đồ cột</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
       #myChart {
           
          margin-left:100px;
            max-width: 1000px;
            max-height: 500px;
            border:1px solid black;
            
        }
      
  
       
        
       
    </style>
</head>
<body>
<center>
    <h4>Số lượng người mua vé</h4>
    
 <div id="bd"></div>
    
   
  

    <br>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    function thongkedvtc() {
        $.ajax({
            url: './api/api.php?action=tkdvtc', 
            type: 'GET',
            success: function(response) {
                console.log(response);
                if (response && response.length > 0) {
                    // Khai báo mảng để lưu labels và data
                    let labels = [];
                    let data = [];

                    // Duyệt qua tất cả các sự kiện trong response
                    response.forEach(event => {
                        labels.push(event.Tensukien); // Thêm tên sự kiện vào mảng labels
                        data.push(event.count1); // Thêm số lượng người mua vào mảng data
                    });

                    let eventHtml = '';
                    
                    // Tạo thẻ canvas cho biểu đồ
                    eventHtml += '<canvas id="myChart"></canvas>';
                    $('#bd').html(eventHtml);

                    // Lấy thẻ canvas và vẽ biểu đồ cột
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var barChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels, // Sử dụng mảng labels
                            datasets: [{
                                label: 'Số lượng người mua',
                                data: data, // Sử dụng mảng data
                                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                                borderColor: 'rgba(0, 123, 255, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                } else {
                    $('#bd').html('<div class="col">No events found.</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching events:', error);
                $('#events1').html('<div class="col">An error occurred while fetching events.</div>');
            }
        });
    };

    $(document).ready(function() {
        thongkedvtc();
    });
</script>

    </center>
</body>
</html>
