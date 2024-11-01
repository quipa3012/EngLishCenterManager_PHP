<?php
include '../include/header.php';
?>

<?php
$user = new User();
$UserID = Session::get('UserID');
$get_user_by_id = $user->get_user_by_id($UserID);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $update_user = $user->update_user($_POST, $UserID);
}


?>

<main>
    <section id="profile" class="profile container">
        <div class="row content text-center d-flex justify-content-around mt-5 section-title ">
            <h2>Thông tin tài khoản</h2>
            <h5 style="color: #37517e;">Nếu không muốn đổi mật khẩu, hãy bỏ trống các ô mật khẩu</h5>
            <?php
            if (isset($update_user)) {
                echo $update_user;
            }
            if ($get_user_by_id !== 0) {
                $result = $get_user_by_id->fetch_assoc();
                ?>
                <form action="" method="post" class="profile-box">
                    <div class="row justify-content-center mt-5 text-start">
                        <h4 style="color: #37517e;" class="text-left col-lg-4">Tên Tài Khoản:</h4><br>
                        <h4 style="color: #37517e;" class="text-left col-lg-4"><?php echo $result['UserName'] ?></h4>
                    </div>
                    <div class="row justify-content-center mt-5 text-start">
                        <h4 style="color: #37517e;" class="text-left col-lg-4">Mật khẩu cũ:</h4><br>
                        <h4 class="text-left col-lg-4"><input style="color: #37517e;" type="Password" name="Password_old">
                        </h4>
                    </div>
                    <div class="row justify-content-center mt-5 text-start">
                        <h4 style="color: #37517e;" class="text-left col-lg-4">Mật khẩu mới:</h4><br>
                        <h4 class="text-left col-lg-4"><input type="Password" name="Password_new1" style="color: #37517e;">
                        </h4>
                    </div>
                    <div class="row justify-content-center mt-5 text-start">
                        <h4 style="color: #37517e;" class="text-left col-lg-4">Nhập lại mật khẩu mới:</h4><br>
                        <h4 class="text-left col-lg-4"><input type="Password" name="Password_new2" style="color: #37517e;">
                        </h4>
                    </div>
                    <div class="row justify-content-center mt-5 text-start">
                        <h4 style="color: #37517e;" class="text-left col-lg-4">Họ Và Tên:</h4><br>
                        <h4 class="text-left col-lg-4"><input name="Name" style="color: #37517e;" type="text"
                                value="<?php echo $result['Name'] ?>"></h4>
                    </div>
                    <div class="row justify-content-center mt-5 text-start">
                        <h4 style="color: #37517e;" class="text-left col-lg-4">Địa chỉ Email:</h4><br>
                        <h4 class="text-left col-lg-4"><input name="Email" style="color: #37517e;" type="text"
                                value="<?php echo $result['Email'] ?>"></h4>
                    </div>
                    <div class="row justify-content-center mt-5 text-start">
                        <h4 style="color: #37517e;" class="text-left col-lg-4">Cấp bậc:</h4><br>
                        <h4 style="color: #37517e;" class="text-left col-lg-4"><?php if ($result['RoleID'] == 0) {
                            echo 'Quản trị viên';
                        } else {
                            echo 'Thành viên';
                        } ?></h4>
                    </div>
                    <button name="submit" type="submit" class="profile-edit-button mb-5 mt-5">Cập Nhật</button>
                </form>

                <?php
            }
            ?>
        </div>
    </section>
</main>

<?php
include '../include/footer.php';
?>