<?php
include '../include/header.php';
?>

<?php
$user = new User();
$UserID = Session::get('UserID');
$get_user_by_id = $user->get_user_by_id($UserID);

?>

<main>
    <section id="profile" class="profile container">
        <div class="row content text-center d-flex justify-content-around mt-5 section-title ">
            <h2>Thông tin tài khoản</h2>
            <?php
            if ($get_user_by_id !== 0) {
                $result = $get_user_by_id->fetch_assoc();
                ?>
                <div class="profile-box">
                    <div class="row justify-content-end mt-5 text-start">
                        <h4 style="color: #37517e;" class="col-lg-6">Tên Tài Khoản:</h4><br>
                        <h4 style="color: #37517e;" class="col-lg-4"><?php echo $result['UserName'] ?></h4>
                    </div>
                    <div class="row justify-content-end mt-5 text-start">
                        <h4 style="color: #37517e;" class="col-lg-6">Mật khẩu:</h4><br>
                        <h4 style="color: #37517e;" class="col-lg-4">*********</h4>
                    </div>
                    <div class="row justify-content-end mt-5 text-start">
                        <h4 style="color: #37517e;" class="col-lg-6">Họ Và Tên:</h4><br>
                        <h4 style="color: #37517e;" class="col-lg-4"><?php echo $result['Name'] ?></h4>
                    </div>
                    <div class="row justify-content-end mt-5 text-start">
                        <h4 style="color: #37517e;" class="col-lg-6">Địa chỉ Email:</h4><br>
                        <h4 style="color: #37517e;" class="col-lg-4"><?php echo $result['Email'] ?></h4>
                    </div>
                    <div class="row justify-content-end mt-5 text-start">
                        <h4 style="color: #37517e;" class="col-lg-6">Cấp bậc:</h4><br>
                        <h4 style="color: #37517e;" class="col-lg-4"><?php if ($result['RoleID'] == 0) {
                            echo 'Quản trị viên';
                        } else {
                            echo 'Thành viên';
                        } ?></h4>
                    </div>
                    <a href="edit_profile.php" name="submit" type="submit" class="profile-edit-button mb-5 mt-5">Chỉnh sủa
                        thông tin tài
                        khoản</a>
                </div>

                <?php
            }
            ?>
        </div>
    </section>
</main>

<?php
include '../include/footer.php';
?>