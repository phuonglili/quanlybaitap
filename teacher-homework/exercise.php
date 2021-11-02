<?php
session_start();
include('templates/header.php')
?>
<h2 style="text-align: center; font-weight: 500; color:#3c5ca5;margin-top:50px">QUẢN LÝ BÀI TẬP BÀI TẬP VỀ NHÀ</h2>
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-9 ">
                        <form class="d-flex">
                            <input class="form-control me-2" style="width:200px;margin-top:30px; margin-right:15px" type="search" placeholder="Search..." aria-label="Search">
                            <button type="submit" style="margin-top:30px;" class="btn btn-primary">Tìm kiếm</button>
                        </form>
                    </div>


                    <div class="col-md-3">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success" style="margin-top:30px; border-radius: 32px!important;background-color: #3081e8!important;border: none; width:200px">
                                        <a href="add.php" style="color: #fff;text-decoration: none"><i class="fas fa-plus"> </i>Tạo bài tập</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content" style="margin-top:50px">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên bài tập</th>
                    <th scope="col">Yêu cầu</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Hạn nộp</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>
            <tbody>

                <?php
                require_once 'config/constants.php';

                #Lấy dữ liệu từ CSDL và đổ ra bảng(phần lặp lại)
                #B1 kết nối với CSDL
                $conn = mysqli_connect('localhost', 'root', '', 'btl');
                mysqli_set_charset($conn, "utf8"); //Định dang font chữ 
                if (!$conn) {
                    die("Không thể kết nối, kiểm tra lại các tham số kết nối");
                }
                #Bước 2: Khai báo câu lệnh thực thi và thực hiện truy vấn
                $query = "SELECT * FROM give_hw ";
                $result = mysqli_query($conn, $query);
                #Bước 3: Xử lí kết quả trả về

                if (mysqli_num_rows($result) > 0) {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['name_hw']; ?></td>
                            <td><?php echo $row['require']; ?></td>
                            <td><?php echo $row['time_st']; ?></td>
                            <td><?php echo $row['time_ex']; ?></td>
                            <td><a href="update.php?id_hw=<?php echo $row['id_hw']; ?>"><i class="fas fa-edit"></i></a></td>
                            <td><a onclick="return window.confirm('Bạn muốn xóa không');" href="delete.php?id_hw=<?php echo $row['id_hw']; ?>"><i class="fas fa-trash"></i></a></td>
                        </tr>
                <?php

                        $i++;
                    }
                }

                ?>

            </tbody>
        </table>
    </div>
</div>
<?php
include('templates/footer.php')
?>