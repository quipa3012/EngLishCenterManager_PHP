<?php
include '../include/header.php';
?>

<?Php
$user = new User();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $create_user = $user->create_user($_POST);
}
?>

<main>
    <section id="register" class="container d-flex justify-content-center align-items-center">
        <div class="section-title register-box">
            <h2>Đăng Ký</h2>
            <?php
            if (isset($create_user)) {
                echo $create_user;
            }
            ?> <br><br>
            <form action="" method="post" class="register-form">
                <label for="username">Tài Khoản</label><br>
                <input class="register-form-group" type="text" name="UserName"><br>
                <label for="password">Mật Khẩu</label><br>
                <input class="register-form-group" type="password" name="Password"><br>
                <label for="password">Nhập Lại Mật Khẩu</label><br>
                <input class="register-form-group" type="password" name="Password2"><br>
                <label for="password">Họ Và Tên</label><br>
                <input class="register-form-group" type="password2" name="Name"><br>
                <label for="password">Địa chỉ email</label><br>
                <input class="register-form-group" type="password2" name="Email"><br>
                <button name="submit" type="submit" class="register-button">Đăng Ký</button>
            </form>
        </div>
    </section>
</main>

<?php
include '../include/footer.php'
    ?>