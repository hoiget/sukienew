<?php


session_start();

include_once("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    
    if($action == "login"){
    $email = $_POST['email'];
    $password =$_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password=MD5('$password')";
    $result = $conn->query($sql);
   
    if ($result->num_rows == 1) {
            $_SESSION['email'] = $email;
        
            $user = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['phone_number'] = $user['phone_number'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['hoten'] = $user['hoten'];
            $_SESSION['username'] = $user['username'];
        
            echo 'success';
    }else {
            echo 'error';
    }
}elseif ($action == "register") {
    $username = $_POST['tk'];
    $email = $_POST['email'];
    $hoten = $_POST['ht'];
    $phone = $_POST['sdt'];
    $address = $_POST['dc'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $Diem = 100;

    // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo 'user';
    } else {
        // Nếu chưa tồn tại, thêm người dùng mới vào cơ sở dữ liệu
        $insert_query = "INSERT INTO users(username, hoten, password, email, phone_number, address, role) 
                         VALUES ('$username', '$hoten', MD5('$password'), '$email', '$phone', '$address', '$role')";

        if ($conn->query($insert_query) === TRUE) {
            // Lấy ID tự động tạo
            $id = $conn->insert_id;

            // Thêm điểm tích lũy vào bảng tichdiem
            $insert_query1 = "INSERT INTO tichdiem(Iduser, Diem) VALUES ('$id', '$Diem')";

            if ($conn->query($insert_query1) === TRUE) {
                echo 'dangky';
            } else {
                echo 'kotc';
            }
        } else {
            echo 'kotc';
        }
    }
}


elseif ($action == "themuser") {
        $username = $_POST['tk'];
        $email = $_POST['email'];
        $hoten = $_POST['ht']; // Thêm dấu chấm phẩy vào cuối dòng
        $phone = $_POST['sdt'];
        $address = $_POST['dc'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $Diem = 100;

        // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
        $check_query = "SELECT * FROM users WHERE email = '$email'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            echo 'user';
        } else {
            // Nếu chưa tồn tại, thêm người dùng mới vào cơ sở dữ 
          
        
       
        
           
            $insert_query = "INSERT INTO users(username, hoten, password, email, phone_number, address, role) 
                             VALUES ('$username', '$hoten', MD5('$password'), '$email', '$phone', '$address', '$role')";
             if ($conn->query($insert_query) === TRUE) {
                // Lấy ID tự động tạo
                $id = $conn->insert_id;
    
                // Thêm điểm tích lũy vào bảng tichdiem
                $insert_query1 = "INSERT INTO tichdiem(Iduser, Diem) VALUES ('$id', '$Diem')";
    
                if ($conn->query($insert_query1) === TRUE) {
                    echo 'dangky';
                } else {
                    echo 'kotc';
                }
            } else {
                echo 'kotc';
            }
        
        }
       
    }elseif ($action == "suauser") {
    $username = $_POST['tk'];
    $userid=$_POST['id'];
    $hoten=$_POST['ht'];
    $phone = $_POST['sdt'];
    $address = $_POST['dc'];
   $email=$_POST['email'];
   $role=$_POST['role'];
        $insert_query = "UPDATE users set username='$username',
                                    hoten='$hoten',
                                    email='$email',
                                    phone_number='$phone',
                                    address='$address',
                                    role='$role'
                                    Where id='$userid' ";
        if ($conn->query($insert_query) === TRUE) {
            
          
                echo 'dangky';
            
        } else {
            echo 'kotc: ' . $conn->error;
        }
    
   
} 

elseif ($action == "suamk") {
    $password = $_POST['pass'];
    $userid=$_POST['id'];
   
        $insert_query = "UPDATE users set password=MD5('$password')
                                    Where id='$userid' ";
        if ($conn->query($insert_query) === TRUE) {
            
          
                echo 'capnhat';
            
        } else {
            echo 'kotc: ' . $conn->error;
        }
    
   
}elseif ($action == "capnhatttcn") {
        $username = $_POST['ten'];
        $userid=$_POST['id'];
        $hoten=$_POST['hoten'];
        $phone = $_POST['sdt'];
        $address = $_POST['dc'];
       

            $insert_query = "UPDATE users set username='$username',
                                        hoten='$hoten',
                                        phone_number='$phone',
                                        address='$address'
                                        Where id='$userid' ";
            if ($conn->query($insert_query) === TRUE) {
                
                $_SESSION['username'] = $username;
                $_SESSION['phone'] = $phone;
                $_SESSION['address'] = $address;
                echo 'dangky';
                
            } else {
                echo 'kotc: ' . $conn->error;
            }
        
       
    } 

    elseif ($action == "guihotro") {
        $userid = $_POST['ten'];
        
        $noidung = $_POST['noidung'];
    
       

        
            // Nếu chưa tồn tại, thêm người dùng mới vào cơ sở dữ liệu
            $insert_query = "INSERT INTO hotro(Iduser,Noidung) 
                             VALUES ('$userid', '$noidung')";
            if ($conn->query($insert_query) === TRUE) {
                echo 'gui';
            } else {
                echo 'kotc';
            }
        }
     
        elseif ($action == "thanh") {
            $userid=$_POST['iduser'];
            $nd=$_POST['nd'];
            $tg=$_POST['tg'];
            $td=$_POST['td'];
            $st=$_POST['st'];
            $tdc=$td + 1;
            $trangthai=0;
            $ma = $_POST['ma'];
            preg_match('/\d+/', $ma, $matches);
            $ma_so = $matches[0];
            // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
           
    
            $insert_query  = "INSERT INTO hoadon(Iduser,Thoigian,Noidunghoadon,sotien) VALUES ('".$userid."','".$tg."','".$nd."','".$st."')";	
            // Nếu chưa tồn tại, thêm người dùng mới vào cơ sở dữ liệu
            $update = "UPDATE tichdiem SET Diem='$tdc' Where Iduser=".$userid;
            $update1="UPDATE ve set Trangthaive='$trangthai'
                            WHERE Idve='$ma'";

                if ($conn->query($update) === TRUE && $conn->query($insert_query) === TRUE && $conn->query($update1) === TRUE) {
                    echo 'gui';
                } else {
                    echo 'kotc';
                }
            }

    elseif ($action == "traloi1") {
       
        $ma=$_POST['id'];
        $noidung = $_POST['noidung'];
        $tl = $_POST['tl'];
        $tb=1;
        // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
       

        
            // Nếu chưa tồn tại, thêm người dùng mới vào cơ sở dữ liệu
            $insert_query = "UPDATE hotro set  Noidung='$noidung',
                                        Traloi='$tl',
                                        thongbao='$tb'
                                        
                                        Where Idht='$ma'";
            if ($conn->query($insert_query) === TRUE) {
                echo 'gui';
            } else {
                echo 'kotc';
            }
    } 

    elseif ($action == "datve") {
        $userid = $_POST['id'];

        $tensk = $_POST['ten'];
        $td = $_REQUEST['diem'];
        $td1 = $_REQUEST['diemsd'];
        $tdc = $td - $td1;
        $tdc1 = $td1 * 1000;
        $st = $_REQUEST['gv'];
        $st1 = $st - $tdc1;
        $trangthai = 1;
        $diachi = $_POST['dc'];
        $thoigian = $_POST['tg'];
    
        // Kiểm tra nếu người dùng không đủ điểm
        if ($td < $td1) {
            echo "Không đủ điểm";
        } else {
            // Cập nhật điểm cho người dùng
            $update_query = "UPDATE tichdiem SET Diem = '$tdc' WHERE Iduser = '$userid'";
            $insert_query = "INSERT INTO ve (Tensukien, Diem, Iduser, Giave, diachi, thoigiandatve, Trangthaive) 
                             VALUES ('$tensk', '$td1', '$userid', '$st1', '$diachi', '$thoigian', '$trangthai')";
    
            // Thực hiện các truy vấn
            if ($conn->query($update_query) === TRUE && $conn->query($insert_query) === TRUE) {
                echo "gui";
            } else {
                echo "lỗi" . $conn->error;
            }
        }
    }

    elseif($action == "guibl" ) {
        $userid = $_POST['id'];
        $idsk = $_POST['idsk'];
        
        $tensk = $_POST['ten'];
        
        $Noidung = $_POST['bl'];
        $thoigian = $_POST['tgbl'];
        
       
        
        $insert_query1 = "INSERT INTO binhluan(Iduser,Idsk,Tensukien,Noidungbinhluan,Ngaybinhluan) VALUES ('$userid','$idsk','$tensk','$Noidung', '$thoigian')";

        if ($conn->query($insert_query1) === TRUE) {
            echo 'gui';
        } else {
        
            echo 'kotc';
        
        
        }
    }

      elseif ($action == "themsukien") {
        $userid = $_POST['iduser'];
        $ten = $_POST['tensukien'];
        $noidung = $_POST['noidung'];
        $tgbd = $_POST['thoigianbd'];
        $tgkt = $_POST['thoigiankt'];
        $diachi = $_POST['diachi'];
        $sotien = $_POST['sotien'];
        $tag = $_POST['tag'];
    
        // Kiểm tra ảnh
        $file = $_FILES['anh']['tmp_name'];
        $name = $_FILES['anh']['name'];
        $loai = $_FILES['anh']['type'];
    
        // Kiểm tra loại ảnh hợp lệ
        if ($loai != "image/jpg" && $loai != "image/jpeg" && $loai != "image/png") {
            echo 'lỗi';
            exit;
        }
    
        // Kiểm tra giá trị tiền
        if ($sotien <= 0) {
            echo 'lỗi tiền';
            exit;
        }
    
        // Kiểm tra thời gian bắt đầu và kết thúc
        if (strtotime($tgbd) >= strtotime($tgkt)) {
            echo 'lỗi thời gian';
            exit;
        }
    
        // Nếu ảnh hợp lệ thì tải lên
        if (move_uploaded_file($file, "../images/" . $name)) {
            // Thêm sự kiện vào CSDL
            $insert_query = "INSERT INTO sukien(Iduser, Tensukien, Noidungsukien, Thoigianbatdau, thoigianketthuc, Diachi, anh, sotien, tag) 
                             VALUES ('$userid', '$ten', '$noidung', '$tgbd', '$tgkt', '$diachi', '$name', '$sotien', '$tag')";
    
            if ($conn->query($insert_query) === TRUE) {
                echo 'dangky';
            } else {
                echo "Lỗi SQL:" . $conn->error;
            }
        } else {
            echo 'lỗi tải ảnh';
        }
        
    } 
    
elseif ($action == "sua") {
        $userid = $_POST['iduser'];
        $ten = $_POST['tensukien'];
        $noidung = $_POST['noidung'];
        $tgbd = $_POST['thoigianbd'];
        $tgkt = $_POST['thoigiankt'];
        $diachi = $_POST['diachi'];
        $sotien = $_POST['sotien'];
        $ma= $_POST['ma'];
        $tag = $_POST['tag'];
    
        // Kiểm tra ảnh
        $file = $_FILES['anh']['tmp_name'];
        $name = $_FILES['anh']['name'];
        $loai = $_FILES['anh']['type'];
    
        // Kiểm tra loại ảnh hợp lệ
        
    
        // Kiểm tra giá trị tiền
        if ($sotien <= 0) {
            echo 'lỗi tiền';
            exit;
        }
    
        // Kiểm tra thời gian bắt đầu và kết thúc
        if (strtotime($tgbd) >= strtotime($tgkt)) {
            echo 'lỗi thời gian';
            exit;
        }
    
        // Nếu ảnh hợp lệ thì tải lên
      
            // Thêm sự kiện vào CSDL
            $insert_query = "UPDATE sukien set  Idsk='$ma',Iduser='$userid',
                                        Tensukien='$ten',
                                        Noidungsukien='$noidung',
                                        Thoigianbatdau='$tgbd',
                                        thoigianketthuc='$tgkt',
                                        Diachi='$diachi',
                                        sotien='$sotien',
                                        tag='$tag'
                                        where Idsk='$ma'
                                        ";
    
            if ($conn->query($insert_query) === TRUE) {
                echo 'dangky';
            } else {
                echo "Lỗi SQL:" . $conn->error;
            }
        
    }
    
    elseif($action == "guibox" ) {
        $userid = $_POST['sender_id'];
        $message=$_POST['message'];
        
        
       
       
        
       
        
        $insert_query1 = "INSERT INTO messages(sender_id,message) VALUES ('$userid','$message')";

        if ($conn->query($insert_query1) === TRUE) {
            echo 'gui';
        } else {
        
            echo 'kotc';
        
        
        }
    }
    
}





if($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_GET['action'];

    if ($action == "xem") {
        $sql = "SELECT * FROM sukien";
        $result = $conn->query($sql);

        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }elseif($action === 'get_notifications') {
        $query = "SELECT hotro.*,users.email,users.username,users.id FROM hotro INNER JOIN users ON hotro.Iduser=users.id WHERE hotro.thongbao = 0";
        
        $result = $conn->query($query);
    
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        
    }elseif($action === 'get_notifications12') {
        $query = "SELECT users.id ,users.hoten ,users.email ,ve.Idve,ve.Tensukien ,ve.Diem , ve.Trangthaive ,ve.Giave ,ve.diachi ,ve.thoigiandatve ,sukien.Tensukien ,sukien.Idsk 
        FROM users INNER JOIN  ve ON users.id = ve.Iduser INNER JOIN sukien ON ve.Tensukien = sukien.Idsk where ve.Trangthaive='3' OR ve.Trangthaive='1'";

                
        $result = $conn->query($query);

        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        
    }elseif ($action === 'mark_read') {
        $query = "UPDATE hotro SET thongbao = 1 WHERE thongbao = 0";
        $conn->query($query);
        header('Content-Type: application/json');
        echo json_encode(["status" => "success"]);
       
    }elseif ($action === 'get_notificationskh') {
        $email = $_SESSION['email']; 
        $query = "SELECT hotro.*,users.email,users.username,users.id FROM hotro INNER JOIN users ON hotro.Iduser=users.id WHERE hotro.thongbao = 1 AND users.email='$email'";
        $result = $conn->query($query);
    
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        
    }elseif($action === 'get_notificationskh12') {
        $email = $_SESSION['email'];
        $query = "SELECT users.id ,users.hoten ,users.email ,ve.Idve,ve.Tensukien ,ve.Diem , ve.Trangthaive ,ve.Giave ,ve.diachi ,ve.thoigiandatve ,sukien.Tensukien ,sukien.Idsk 
        FROM users INNER JOIN  ve ON users.id = ve.Iduser INNER JOIN sukien ON ve.Tensukien = sukien.Idsk where ve.Trangthaive='2' AND users.email='$email'";

                
        $result = $conn->query($query);

        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        
    }elseif ($action === 'mark_readkh') {
        // Lấy email từ session
        $email = $_SESSION['email']; 
    
        // Truy vấn để đánh dấu thông báo của email này
        $query = "UPDATE hotro 
                  SET thongbao = 2 
                  WHERE thongbao = 1 AND Iduser IN (
                      SELECT id FROM users WHERE email = '$email'
                  )";
    
        $conn->query($query);
    
        header('Content-Type: application/json');
        echo json_encode(["status" => "success"]);
    }

    

    elseif ($action == "layout") {
        
        $sql = "SELECT * FROM sukien ORDER BY sukien.luotxem DESC LIMIT 8";
        $result = $conn->query($sql);

        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    elseif ($action == "xembox") {
        $sql = "SELECT users.id,users.username,users.hoten,users.email,messages.* FROM messages INNER JOIN users ON users.id=messages.sender_id ";
        $result = $conn->query($sql);

        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    elseif ($action == "user") {
        $email = $_SESSION['email']; 
        $sql = "SELECT users.username,users.hoten,users.email,users.phone_number,users.address FROM users where users.email='$email'";
        $result = $conn->query($sql);

        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
   
    elseif($action == "xemnd"){
                // Lấy ID từ request
        $idnd = $_GET['idnd'];
       
        // Xây dựng truy vấn SQL
        $update_query = "UPDATE sukien SET luotxem = luotxem + 1 WHERE Idsk = '$idnd'";
        $conn->query($update_query);
        $sql = "SELECT sukien.*,users.role FROM sukien INNER JOIN users ON sukien.Iduser=users.id where sukien.Idsk = $idnd";

        $result = $conn->query($sql);

        // Chuyển kết quả thành mảng dữ liệu JSON và trả về
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($rows);

    }

elseif($action == "xemnd1"){
        // Lấy ID từ request
        $idnd = $_GET['idnd1'];

        // Xây dựng truy vấn SQL
        $sql = "SELECT * FROM sukien where Idsk = $idnd";

        $result = $conn->query($sql);

        // Chuyển kết quả thành mảng dữ liệu JSON và trả về
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($rows);
        }

elseif($action == "xemnd2"){
            // Lấy ID từ request
            $idnd = $_GET['idnd2'];
    
            // Xây dựng truy vấn SQL
            $sql = "SELECT * FROM sukien where Idsk = $idnd";
    
            $result = $conn->query($sql);
    
            // Chuyển kết quả thành mảng dữ liệu JSON và trả về
            $rows = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
            header('Content-Type: application/json');
            echo json_encode($rows);
            }

elseif($action == "xemnd3"){
                // Lấy ID từ request
                $idnd = $_GET['idnd3'];
        
                // Xây dựng truy vấn SQL
                $sql = "SELECT * FROM sukien where Idsk = $idnd";
        
                $result = $conn->query($sql);
        
                // Chuyển kết quả thành mảng dữ liệu JSON và trả về
                $rows = array();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }
                }
                header('Content-Type: application/json');
                echo json_encode($rows);
                }      
   
    elseif ($action == "datve1") {
        // Lấy ID từ request và email từ session
        $id = $_GET['id'];
        // Truy vấn 1: Lấy thông tin sự kiện dựa trên Idsk
        $sql_event = "SELECT * FROM sukien where Idsk = $id  ";
    
        $result_event = $conn->query($sql_event);
    
        // Truy vấn 2: Lấy thông tin người dùng dựa trên email
     
    
        // Gộp kết quả từ hai truy vấn vào một mảng
        $rows = array();
        
        if ($result_event->num_rows > 0) {
            while ($row = $result_event->fetch_assoc()) {
                $rows[] = $row;
            }
        }
    
        // Trả về kết quả dạng JSON
        header('Content-Type: application/json');
        echo json_encode($rows);}

elseif ($action == "datng") {
        $email = $_SESSION['email']; 

        $sql_event1 = "SELECT users.id,users.email,users.hoten,tichdiem.Idtd,tichdiem.Diem,tichdiem.Iduser FROM users INNER JOIN tichdiem ON 
        users.id = tichdiem.Iduser
        where users.email = '$email'";
        
        $result_event1 = $conn->query($sql_event1);
    
        // Truy vấn 2: Lấy thông tin người dùng dựa trên email
     
    
        // Gộp kết quả từ hai truy vấn vào một mảng
        $rowss = array();
        
        if ($result_event1->num_rows > 0) {
            while ($row1 = $result_event1->fetch_assoc()) {
                $rowss[] = $row1;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($rowss);
    }

elseif ($action == "datng1") {
        $email = $_SESSION['email']; 

        $sql_event1 = "SELECT users.id,users.email,users.hoten,tichdiem.Idtd,tichdiem.Diem,tichdiem.Iduser FROM users INNER JOIN tichdiem ON 
        users.id = tichdiem.Iduser
        where users.email = '$email'";
        
        $result_event1 = $conn->query($sql_event1);
    
      
        $rowss = array();
        
        if ($result_event1->num_rows > 0) {
            while ($row1 = $result_event1->fetch_assoc()) {
                $rowss[] = $row1;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($rowss);
   
    }

    elseif($action == "xemtag"){
                // Lấy ID từ request
        $tag = trim($_GET['tag']);

        // Xây dựng truy vấn SQL
        $sql = "SELECT * FROM sukien WHERE tag like '%".$tag."%'";

        $result = $conn->query($sql);

        // Chuyển kết quả thành mảng dữ liệu JSON và trả về
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($rows);

    }

elseif($action == "xemhotro"){
                    // Lấy ID từ request
           
            $email = $_SESSION['email'];

            // Xây dựng truy$ vấn SQL
            $sql = "SELECT users.hoten,users.id,users.email, hotro.Idht, hotro.Noidung, hotro.Traloi, hotro.thongbao
            FROM users INNER JOIN hotro ON users.id = hotro.Iduser where users.email= '$email'";

            $result = $conn->query($sql);

            // Chuyển kết quả thành mảng dữ liệu JSON và trả về
            $rows = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
            header('Content-Type: application/json');
            echo json_encode($rows);
    }

elseif($action == "hotronv"){
        // Lấy ID từ request

       

        // Xây dựng truy$ vấn SQL
        $sql = "SELECT users.hoten,users.id,users.email, hotro.Idht, hotro.Noidung, hotro.Traloi, hotro.thongbao
        FROM users INNER JOIN hotro ON users.id = hotro.Iduser";

        $result = $conn->query($sql);

        // Chuyển kết quả thành mảng dữ liệu JSON và trả về
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($rows);
        }

        elseif($action == "traloi"){
            // Lấy ID từ request
    
            $idht = $_GET['id'];
    
            // Xây dựng truy$ vấn SQL
            $sql = "SELECT users.hoten,users.id,users.email, hotro.Idht, hotro.Noidung, hotro.Traloi, hotro.thongbao
            FROM users INNER JOIN hotro ON users.id = hotro.Iduser where hotro.Idht=$idht";
    
            $result = $conn->query($sql);
    
            // Chuyển kết quả thành mảng dữ liệu JSON và trả về
            $rows = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
            header('Content-Type: application/json');
            echo json_encode($rows);
            }

    elseif($action == "xoahotro"){
                // Lấy ID từ request
                $idht = $_GET['idht'];

                // Xây dựng truy vấn SQL
                $sql = "DELETE FROM hotro WHERE Idht = $idht"; // Cú pháp đúng
            
                // Thực hiện truy vấn
                if ($conn->query($sql) === TRUE) {
                    // Trả về phản hồi JSON thành công
                    $response = array(
                        'status' => 'success',
                        
                    );
                } else {
                    // Trả về phản hồi JSON lỗi
                    $response = array(
                        'status' => 'error',
                        
                    );
                }
            
                header('Content-Type: application/json');
                echo json_encode($response);
    }

    elseif($action == "xemve"){
        // Lấy ID từ request

        $email = $_SESSION['email'];

        // Xây dựng truy$ vấn SQL
        $sql = "SELECT users.id ,users.hoten ,users.email ,ve.Idve,ve.Tensukien ,ve.Diem , ve.Trangthaive ,ve.Giave ,ve.diachi ,ve.thoigiandatve ,sukien.Tensukien ,sukien.Idsk 
        FROM users INNER JOIN  ve ON users.id = ve.Iduser INNER JOIN sukien ON ve.Tensukien = sukien.Idsk WHERE users.email = '$email' and ve.Trangthaive != '0' ";

        $result = $conn->query($sql);

        // Chuyển kết quả thành mảng dữ liệu JSON và trả về
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($rows);
    }elseif($action == "xemve1"){
        // Lấy ID từ request

        $email = $_SESSION['email'];

        // Xây dựng truy$ vấn SQL
        $sql = "SELECT users.id ,users.hoten ,users.email ,ve.Idve,ve.Tensukien ,ve.Diem , ve.Trangthaive ,ve.Giave ,ve.diachi ,ve.thoigiandatve ,sukien.Tensukien ,sukien.Idsk 
        FROM users INNER JOIN  ve ON users.id = ve.Iduser INNER JOIN sukien ON ve.Tensukien = sukien.Idsk WHERE users.email = '$email' and ve.Trangthaive='0' ";

        $result = $conn->query($sql);

        // Chuyển kết quả thành mảng dữ liệu JSON và trả về
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($rows);

    }

    elseif($action == "xemvenv"){
        // Lấy ID từ request

     

        // Xây dựng truy$ vấn SQL
        $sql = "SELECT users.id ,users.hoten ,users.email ,ve.Idve,ve.Tensukien ,ve.Diem , ve.Trangthaive ,ve.Giave ,ve.diachi ,ve.thoigiandatve ,sukien.Tensukien ,sukien.Idsk 
        FROM users INNER JOIN  ve ON users.id = ve.Iduser INNER JOIN sukien ON ve.Tensukien = sukien.Idsk where ve.Trangthaive='3' OR ve.Trangthaive='1'";

        $result = $conn->query($sql);

        // Chuyển kết quả thành mảng dữ liệu JSON và trả về
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($rows);
    }

    elseif($action == "xemdiem"){
        // Lấy ID từ request

        $email = $_SESSION['email'];

        // Xây dựng truy$ vấn SQL
        $sql = "SELECT users.hoten,users.id,users.email,tichdiem.Iduser, tichdiem.Idtd, tichdiem.Diem
        FROM users INNER JOIN tichdiem ON users.id = tichdiem.Iduser where users.email= '$email'";

        $result = $conn->query($sql);

        // Chuyển kết quả thành mảng dữ liệu JSON và trả về
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($rows);
    }
        
elseif($action == "xembl"){
            // Lấy ID từ request
    
            $id = $_GET['id'];
    
            // Xây dựng truy$ vấn SQL
            $sql = "SELECT binhluan.*,users.hoten,users.id FROM  binhluan LEFT JOIN users ON users.id=binhluan.Iduser where binhluan.Idsk = $id";

            $result = $conn->query($sql);
    
            // Chuyển kết quả thành mảng dữ liệu JSON và trả về
            $rows = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
            header('Content-Type: application/json');
            echo json_encode($rows);
            }
       
elseif ($action == "xoabl") {
            // Lấy ID từ request và đảm bảo an toàn bằng cách ép kiểu số nguyên
            $idbl = $_GET['idbl']; 
        
            // Xây dựng truy vấn SQL
            $sql = "DELETE FROM binhluan WHERE Idbl = $idbl";
        
            // Thực hiện truy vấn
            if ($conn->query($sql) === TRUE) {
                echo 'gui';
                } else {
                
                echo 'kotc';
                }
        
           
        }elseif ($action == "xoasukien") {
            // Lấy ID từ request và đảm bảo an toàn bằng cách ép kiểu số nguyên
            $idsk = $_GET['idsk']; 
        
            // Xây dựng truy vấn SQL
            $sql = "DELETE FROM sukien WHERE Idsk = $idsk";
        
            // Thực hiện truy vấn
            if ($conn->query($sql) === TRUE) {
                echo 'gui';
                } else {
                
                echo 'kotc';
                }
        
           
        }
       
elseif($action == "laydulieu") {
    // Lấy dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT * FROM hoadon"; // hoặc truy vấn phù hợp với dữ liệu bạn muốn
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}

elseif($action == "xemhoadon") {
    // Lấy dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT hoadon.*,users.username,users.phone_number,users.id,users.hoten,users.address FROM hoadon INNER JOIN users ON hoadon.Iduser=users.id where hoadon.Trangthai=''"; // hoặc truy vấn phù hợp với dữ liệu bạn muốn
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}

elseif ($action == "trangthai" ) {
   
    $id = $_GET['id']; 
       $tt=2;
      
    // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
    
        $insert_query = "UPDATE ve SET Trangthaive='$tt' Where Idve= '$id'";
       
        if ($conn->query($insert_query) === TRUE) {
        echo 'gui';
        } else {
        
            echo 'kotc';
        }
      
        

}

elseif ($action == "huyve" ) {
   
    $id = $_GET['id']; 
       $tt=3;
      
    // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
    
        $insert_query = "UPDATE ve SET Trangthaive='$tt' Where Idve= '$id'";
       
        if ($conn->query($insert_query) === TRUE) {
        echo 'gui';
        } else {
        
            echo 'kotc';
        }
      
        

}

elseif ($action == "hetve" ) {
   
    $id = $_GET['id']; 
       $tt=1;
      
    // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
    
        $insert_query = "UPDATE sukien SET Trangthai='$tt' Where Idsk= '$id'";
       
        if ($conn->query($insert_query) === TRUE) {
        echo 'gui';
        } else {
        
            echo 'kotc';
        }
      
        
}

elseif ($action == "conve" ) {
   
    $id = $_GET['id']; 
      
      
    // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
    
        $insert_query = "UPDATE sukien SET Trangthai=' ' Where Idsk= '$id'";
       
        if ($conn->query($insert_query) === TRUE) {
        echo 'gui';
        } else {
        
            echo 'kotc';
        }
      
        
    }

elseif ($action == "xoave" ) {
   
    $id = $_GET['id']; 
      
      
    // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
    
        $insert_query = "DELETE FROM ve Where Idve= '$id'";
       
        if ($conn->query($insert_query) === TRUE) {
        echo 'gui';
        } else {
        
            echo 'kotc';
        }
      
}

elseif ($action == "xoakhach" ) {
   
    $id = $_GET['id']; 
      
      
    // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
    
        $insert_query = "DELETE FROM users Where id= '$id'";
       
        if ($conn->query($insert_query) === TRUE) {
        echo 'gui';
        } else {
        
            echo 'kotc';
        }
      
}

elseif ($action == "xoabox") {
    $sql = "DELETE FROM messages";
    if ($conn->query($sql) === TRUE) {
        echo 'gui';
        } else {
        
            echo 'kotc';
        }
}

elseif ($action == "xoahd") {
    $id=$_GET['idhd'];
    $trangthai = 1 ;
    // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
   

    
        // Nếu chưa tồn tại, thêm người dùng mới vào cơ sở dữ liệu
        $update = "UPDATE hoadon SET Trangthai='$trangthai' Where Idhd='$id'";
        if ($conn->query($update) === TRUE) {
            echo 'gui';
        } else {
            echo 'kotc';
        }
    }


elseif ($action == "guest" ) {
   
    $role = 'guest';
    
    // Xây dựng truy$ vấn SQL
    $sql = "SELECT * from users where role = '$role'";

    $result = $conn->query($sql);

    // Chuyển kết quả thành mảng dữ liệu JSON và trả về
    $rows = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($rows);
}

elseif ($action == "dvtc" ) {
   
    $role = 'dvtc';
    
    // Xây dựng truy$ vấn SQL
    $sql = "SELECT * from users where role = '$role'";

    $result = $conn->query($sql);

    // Chuyển kết quả thành mảng dữ liệu JSON và trả về
    $rows = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($rows);
}

elseif ($action == "employee" ) {
   
    $role = 'employee';
    
    // Xây dựng truy$ vấn SQL
    $sql = "SELECT * from users where role = '$role'";

    $result = $conn->query($sql);

    // Chuyển kết quả thành mảng dữ liệu JSON và trả về
    $rows = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($rows);
}

elseif ($action == "xemuser") {
    $id = $_GET['id']; 

    $sql_event1 = "SELECT * from users where id='$id'";
    
    $result_event1 = $conn->query($sql_event1);

    // Truy vấn 2: Lấy thông tin người dùng dựa trên email
 

    // Gộp kết quả từ hai truy vấn vào một mảng
    $rowss = array();
    
    if ($result_event1->num_rows > 0) {
        while ($row1 = $result_event1->fetch_assoc()) {
            $rowss[] = $row1;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($rowss);
}

elseif ($action == "xemmk") {
    $id = $_GET['id']; 

    $sql_event1 = "SELECT * from users where id='$id'";
    
    $result_event1 = $conn->query($sql_event1);

    // Truy vấn 2: Lấy thông tin người dùng dựa trên email
 

    // Gộp kết quả từ hai truy vấn vào một mảng
    $rowss = array();
    
    if ($result_event1->num_rows > 0) {
        while ($row1 = $result_event1->fetch_assoc()) {
            $rowss[] = $row1;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($rowss);
}   
     
      
        

if ($action == "timkiemsk") {
    // Lấy từ khóa tìm kiếm từ request
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

    // Truy vấn SQL để tìm sự kiện theo từ khóa
    $sql = "SELECT * 
            FROM sukien
            WHERE Tensukien LIKE '%$keyword%' OR Noidungsukien LIKE '%$keyword%'";

    // Thực thi truy vấn
    $result = $conn->query($sql);

    // Tạo mảng để lưu kết quả
    $rows = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    // Trả về dữ liệu dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($rows);
}

elseif ($action == "qlsk") {
    // Lấy ID từ request và email từ session
    $email = $_SESSION['email'];

    $sql_event = "SELECT users.email, users.id, users.hoten, sukien.* 
    FROM users 
    INNER JOIN sukien ON users.id = sukien.Iduser 
    WHERE users.email = '$email'";

        $result_event = $conn->query($sql_event);

        if (!$result_event) {
        echo "SQL Error: " . $conn->error; // In ra lỗi SQL nếu có
        }

        $rows = array();
        if ($result_event->num_rows > 0) {
        while ($row = $result_event->fetch_assoc()) {
        $rows[] = $row;
        }
        } else {
        echo "No events found"; // Kiểm tra có sự kiện nào không
        }

        header('Content-Type: application/json');
        echo json_encode($rows);
    }elseif ($action == "qlsk12") {
        // Lấy ID từ request và email từ session
        $email = $_SESSION['email'];
    
        $sql_event = "SELECT users.email, users.id, users.hoten, sukien.* 
        FROM users 
        INNER JOIN sukien ON users.id = sukien.Iduser 
        WHERE users.email = '$email'";
    
            $result_event = $conn->query($sql_event);
    
            if (!$result_event) {
            echo "SQL Error: " . $conn->error; // In ra lỗi SQL nếu có
            }
    
            $rows = array();
            if ($result_event->num_rows > 0) {
            while ($row = $result_event->fetch_assoc()) {
            $rows[] = $row;
            }
            } else {
            echo "No events found"; // Kiểm tra có sự kiện nào không
            }
    
            header('Content-Type: application/json');
            echo json_encode($rows);
        }

    elseif ($action == "tkdvtc") {
        
        $email = $_SESSION['email'];

        // Tạo câu truy vấn SQL để lấy thống kê
        $sql = "SELECT sukien.Tensukien, COUNT(ve.Iduser) AS count1, users.id, users.email
                FROM sukien
                INNER JOIN users ON users.id = sukien.Iduser  -- Sửa JOIN với bảng users
                LEFT JOIN ve ON sukien.Idsk = ve.Tensukien  
                WHERE users.email = '$email'
                GROUP BY sukien.Tensukien";
        
        
        // Execute query
        $result = $conn->query($sql);
        
        // Check if query returns results
        if ($result->num_rows > 0) {
            $rows = array();
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
            // Return results as JSON
            header('Content-Type: application/json');
            echo json_encode($rows);
    } 

    elseif($action == "thanhtoan"){
        // Lấy ID từ request
            $id = $_GET['idve'];
            $email = $_SESSION['email'];

            // Xây dựng truy vấn SQL
            $sql ="SELECT ve.Idve,sukien.Tensukien,sukien.Iduser,ve.thoigiandatve,users.phone_number,ve.Giave,users.hoten,users.email,users.phone_number,users.address FROM ve INNER JOIN users ON users.id=ve.Iduser INNER JOIN sukien ON ve.Tensukien=sukien.Idsk Where Idve='$id' AND users.email = '$email'";

            $result = $conn->query($sql);

            // Chuyển kết quả thành mảng dữ liệu JSON và trả về
            $rows = array();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
            header('Content-Type: application/json');
            echo json_encode($rows);

            }
    
}
$conn->close();
?>