<?php
include '../include/adminheader.php';
?>

<?php
$cart = new Cart();
$register = new Register();
$schedule = new Schedule();

if (isset($_GET['CartID']) && $_GET['action'] == 'agree') {
    $CartID = $_GET['CartID'];
    $agree = $cart->agree($CartID);
} else if (isset($_GET['CourseID']) && isset($_GET['UserID']) && isset($_GET['CartID']) && isset($_GET['DenyReasonID']) && $_GET['action'] == 'denie') {

    $DenyReasonID = $_GET['DenyReasonID'];
    $CartID = $_GET['CartID'];
    $UserID = $_GET['UserID'];
    $CourseID = $_GET['CourseID'];

    $denie = $cart->denie($CartID, $DenyReasonID);
    $cart_set_schedule_denie = $cart->cart_set_schedule_denie($CartID);
    $reduce_current_register = $schedule->reduce_current_register($UserID, $CourseID);
    $delete_register = $register->delete_register($UserID, $CourseID);

}


?>

<main class>
    <section id="course" class="course container">
        <div style="margin-top: 10vh;" class="section-title">
            <h2>Danh sách đăng ký</h2>
            <?php
            if (isset($agree)) {
                echo $agree;
            } else if (isset($denie)) {
                echo $denie;
            }
            ?>
        </div>
        <div class="row content text-center d-flex justify-content-around course-box">

            <table style="color: #37517e;">
                <tr>
                    <th>Tên Người Dùng</th>
                    <th>Tên Khóa Học</th>
                    <th>Trạng Thái</th>
                    <th style="width: 27%;">Thao Tác</th>
                </tr>
                <?php
                $show_cart = $cart->show_cart();
                if ($show_cart !== 0) {
                    while ($result = $show_cart->fetch_assoc()) {
                        ?>
                        <tr>
                            <br><br><br>
                            <td><?php echo $result['Name'] ?></td>
                            <td><?php echo $result['CourseName'] ?></td>
                            <td>
                                <?php if ($result['Status'] == 1) {
                                    echo 'Chờ Duyệt';
                                } else if ($result['Status'] == 2) {
                                    echo 'Đã Chấp Nhận';
                                } else if ($result['Status'] == 3) {
                                    echo 'Đã Từ Chối';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($result['Status'] == 1) {
                                    echo '<a href="?action=agree&CartID=' . $result['CartID'] . '">Chấp Nhận </a>';
                                    echo '<select style="color: #37517e;" id="reason' . $result['CartID'] . '">';
                                    echo '<option value="">Chọn lý do từ chối</option>';
                                    echo '<option value="1">Không tìm thấy thông tin thanh toán</option>';
                                    echo '<option value="2">Tạm thời ngừng nhận học viên</option>';
                                    echo '</select>';
                                    echo '  <a id="denie' . $result['CartID'] . '" style="color: red;" href="?action=denie&CartID=' . $result['CartID'] . '&UserID=' . $result['UserID'] . '&CourseID=' . $result['CourseID'] . '&DenyReasonID=" onclick="return validateSelect(' . $result['CartID'] . ')">Từ chối</a>';
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

<script>
    function validateSelect(CartID) {
        var reason = document.getElementById("reason" + CartID).value;
        if (reason !== "") {
            var url = document.getElementById("denie" + CartID).getAttribute("href");
            url += reason;
            document.getElementById("denie" + CartID).setAttribute("href", url);
            return reason;
        } else {
            alert("Vui lòng chọn lý do từ chối.");
            return false;
        }
    }
</script>

<?php
include '../include/adminfooter.php';
?>