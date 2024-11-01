<?php
include '../include/header.php';
?>

<?php
$cart = new Cart();
if (isset($_GET['CartID'])) {
    $CartID = $_GET['CartID'];
    $delete_cart = $cart->delete_cart($CartID);
}
?>

<main class>
    <section id="course" class="course container">
        <div style="margin-top: 10vh;" class="section-title">
            <h2>Khóa Học đã đăng ký</h2>
            <?php
            if (isset($delete_cart)) {
                echo $delete_cart;
            }
            ?>
        </div>
        <div class="row content text-center d-flex justify-content-around course-box">

            <table style="color: #37517e;">
                <tr>
                    <th>Tên Khóa Học</th>
                    <th>Giá</th>
                    <th>Lịch học</th>
                    <th style="width: 31%;">Trạng Thái</th>
                    <th>Thao Tác</th>
                </tr>
                <?php
                $UserID = Session::get('UserID');
                $cart = new Cart();
                $show_cart_by_UserID = $cart->show_cart_by_UserID($UserID);
                if ($show_cart_by_UserID !== 0) {
                    while ($result = $show_cart_by_UserID->fetch_assoc()) {
                        ?>
                        <tr>
                            <br><br><br>
                            <td><?php echo $result['CourseName'] ?></td>
                            <td><?php echo $result['CoursePrice'] ?></td>
                            <td><?php
                            if ($result['ScheduleSet'] == 1 && $result['Status'] != 2 && $result['Status'] != 3) {
                                echo 'Đã lập lịch học, ' . '<a
                                href="edit_schedule.php?CourseID=' . $result['CourseID'] . '&CartID=' . $result['CartID'] . '">Điều chỉnh</a>';
                            } else if ($result['ScheduleSet'] == 0) {
                                echo '<a
                                href="make_schedule.php?CourseID=' . $result['CourseID'] . '&CartID=' . $result['CartID'] . '">Lập lịch học</a>';
                            } else if ($result['Status'] == 2 && $result['ScheduleSet'] == 1) {
                                echo 'Lịch học đã được duyệt, không thể điều chỉnh';
                            } else {
                                echo 'Không thể lập lịch';
                            }
                            ?></td>
                            <td>
                                <?php if ($result['Status'] == 0) {
                                    echo 'Chờ thanh toán và lập lịch học';
                                } else if ($result['Status'] == 1) {
                                    echo 'Đã thanh toán, chờ xử lý';
                                } else if ($result['Status'] == 3) {
                                    echo 'Đã bị từ chối (Lý do:' . $result['DenyReasonContent'] . ')';
                                } else {
                                    echo 'Đăng ký thành công';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($result['Status'] == 0) {
                                    echo '<a href="pay.php?CartID=' . $result['CartID'] . '">Thanh Toán</a>
                                    <a href="">|</a>
                                    <a href="?CartID=' . $result['CartID'] . '">Xóa</a>';
                                } else if ($result['Status'] == 2) {
                                    echo '<a
                                    href="acceptanceletter.php?CourseID=' . $result['CourseID'] . '">Xem giấy báo nhập học</a>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>

    </section>
</main>

<?php
include '../include/footer.php';
?>