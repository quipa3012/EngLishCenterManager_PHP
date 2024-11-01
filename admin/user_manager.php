<?php
include '../include/adminheader.php';
?>

<?php
$user = new User();
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['UserID'])) {
    $UserID = $_GET['UserID'];
    $delete_user = $user->delete_user($UserID);
}
?>

<main class>
    <section id="course" class="course container">
        <div style="margin-top: 10vh;" class="section-title">
            <h2>Quản Lý Người Dùng</h2>
        </div>
        <div class="text-center ">
            <?php
            if (isset($delete_user)) {
                echo $delete_user;
            }
            ?>
        </div>
        <div class="row content text-center d-flex justify-content-around course-box">
            <table style="color: #37517e;">
                <tr>
                    <th>Tên Tài Khoản</th>
                    <th>Họ Và Tên</th>
                    <th>Email</th>
                    <th>Cấp Bậc</th>
                    <th>Thao Tác</th>
                </tr>
                <?php
                $show_user = $user->show_user();
                if ($show_user !== 0) {
                    while ($result = $show_user->fetch_assoc()) {
                        ?>
                        <tr>
                            <br><br><br>
                            <td><?php echo $result['UserName'] ?></td>
                            <td><?php echo $result['Name'] ?></td>
                            <td><?php echo $result['Email'] ?> </td>
                            <td>
                                <?php if ($result['RoleID'] == 0) {
                                    echo 'Quản Trị Viên';
                                } else {
                                    echo 'Thành Viên';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="edit_user.php?UserID=<?php echo $result['UserID'] ?>" type="submit">Sửa</a>
                                <a href="javascript:void(0)" onclick="confirmDelete(<?php echo $result['UserID'] ?>)"
                                    style="color: red; margin-left:15px;" type="submit">Xóa</a>

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
    function confirmDelete(userID) {
        if (confirm("Bạn có chắc chắn muốn xóa người dùng không?")) {
            window.location.href = '?action=delete&UserID=' + userID;
        }
    }
</script>

<?php
include '../include/adminfooter.php';
?>