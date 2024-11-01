<?php
include '../include/header.php';
?>

<?php
$schedule = new Schedule();
$register = new Register();
$cart = new Cart();
$show_schedule = $schedule->show_schedule();
$UserID = Session::get('UserID');

if (!isset($_GET['CourseID']) || $_GET['CourseID'] == null) {
    echo "<script>window.location = 'course_cart.php'</script>";
} else {
    $CourseID = $_GET['CourseID'];
}

if (!isset($_GET['CartID']) || $_GET['CartID'] == null) {
    echo "<script>window.location = 'course_cart.php'</script>";
} else {
    $CartID = $_GET['CartID'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $ScheduleIDs = $_POST['ScheduleID'];
    $cart_set_schedule = $cart->cart_set_schedule($CartID);
    foreach ($ScheduleIDs as $ScheduleID) {
        $insert_register = $register->insert_register($UserID, $CourseID, $ScheduleID);
        $add_current_register = $schedule->add_current_register($ScheduleID);
    }
}
?>


<main>
    <section id="schedule" class="schedule container text-center">
        <div style="margin-top: 10vh;" class="section-title">
            <h2>Cập nhật thời khóa biểu</h2>
            <h5 style="color: #37517e;">Bắt buộc chọn 3 buổi học để học theo tiến độ của trung tâm</h5>
            <p id="message" class="danger"></p>
            <?php
            if (isset($insert_register)) {
                echo $insert_register;
            }
            ?>
        </div>
        <form action="" method="post" class="row content text-center d-flex justify-content-around    ">
            <table style="color: #37517e;" class="">
                <tr>
                    <th>Thứ</th>
                    <th>Buổi</th>
                    <th>Trạng Thái</th>
                    <th>Đăng Ký</th>
                </tr>
                <?php
                if ($show_schedule !== 0) {
                    while (
                        $result = $show_schedule->fetch_assoc()
                    ) {
                        ?>
                        <tr>
                            <td><?php echo $result['DayOfWeek'] ?></td>
                            <td><?php echo $result['Lession'] ?></td>
                            <td>Hiện tại:<?php echo $result['CurrentRegister'] . ' | Tối đa:' . $result['MaxRegister'] ?>
                            </td>
                            <td><?php if ($result['CurrentRegister'] < $result['MaxRegister']) {
                                echo '<input type="checkbox" name="ScheduleID[]" value="' . $result['ScheduleID'] . '">';
                            } else {
                                echo 'Đã Đầy';
                            } ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <button class="schedule-edit-button mt-5" type="submit" name="submit">Cập nhật</button>
        </form>
    </section>
</main>

<script>
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');

    var checkedCount = 0;

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                checkedCount++;

                if (checkedCount > 3) {
                    this.checked = false;
                    checkedCount--;
                } else if (checkedCount < 3) {
                    document.getElementById('message').innerText = "Vui lòng chọn đủ 3 Buổi học.";
                } else {
                    document.getElementById('message').innerText = "";
                }
            } else {
                checkedCount--;
            }
        });
    });
</script>


<?php
include '../include/footer.php'
    ?>