<?php
include '../include/header.php';
?>

<?php
$cart = new Cart();
$register = new Register();
if (isset($_GET['CourseID'])) {
    $CourseID = $_GET['CourseID'];
}
$UserID = Session::get('UserID');
$show_cart_by_UserID = $cart->show_cart_by_UserID($UserID);
$result_show_cart_by_UserID = $show_cart_by_UserID->fetch_assoc();
?>

<main class>
    <section id="acceptanceletter" class="acceptanceletter container">
        <div style="margin-top: 10vh;" class="section-title">
            <h2>Giấy báo nhập học</h2>
        </div>
        <div style="color: #37517e;" class="row content text-center d-flex justify-content-around acceptanceletter-box">
            <h3 class="mt-5">Thông tin Giấy báo nhập học - Trung tâm Anh ngữ ENGQUI</h3>
            <p style="width: 55%;" class="mt-3 text-start"><strong>Họ và tên:</strong>
                <?php echo $result_show_cart_by_UserID['Name']; ?></p>
            <p style="width: 55%;" class="mt-3 text-start">
                <strong>Email:</strong><?php echo $result_show_cart_by_UserID['Email']; ?>
            </p>
            <p style="width: 55%;" class="mt-3 text-start"><strong>Khóa
                    Học:</strong><?php echo $result_show_cart_by_UserID['CourseName']; ?></p>
            <p style="width: 55%;" class="mt-3 text-start"><strong>Ngày nhập học:</strong>
                13/5/2024</p>
            <p class="mt-3"><strong>Thời Khóa Biểu</strong></p>
            <table style="width: 55%;" class="text-center mt-3">
                <tr>
                    <th>Thứ</th>
                    <th>Buổi</th>
                </tr>
                <?php
                $show_register_by_UserID_CourseID = $register->show_register_by_UserID_CourseID($UserID, $CourseID);
                if ($show_register_by_UserID_CourseID !== 0) {
                    while ($result = $show_register_by_UserID_CourseID->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $result['DayOfWeek'] ?></td>
                            <td><?php echo $result['Lession'] ?></td>
                        </tr>

                        <?php
                    }
                }
                ?>
            </table>
            <p style="width: 55%;" class="mt-5 text-start">Tiết buổi sáng bắt đầu vào lúc 08:00 giờ, kết thúc vào lúc
                11:00 giờ</p>
            <p style="width: 55%;" class="text-start">Tiết buổi chiều bắt đầu vào lúc 08:00 giờ, kết thúc vào lúc 11:00
                giờ</p>
            <p style="width: 55%;" class=" mb-5 text-start">Tiết buổi tối bắt đầu vào lúc 08:00 giờ, kết thúc vào lúc
                11:00 giờ</p>
        </div>

    </section>
</main>

<?php
include '../include/footer.php';
?>