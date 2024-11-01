<?php
include '../include/header.php';
include '../classes/login_process.php';
?>

<?php
$login_process = new Login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_check = $login_process->login($username, $password);
}
?>


<main>
    <section id="login" class="container d-flex justify-content-center align-items-center">
        <div class="section-title login-box">
            <h2>đăng nhập</h2>
            <span class="danger">
                <?php
                if(isset($login_check)){
                    echo $login_check;
                }
                ?> <br><br>
            </span>
            <form class="login-form" action="login.php" method="post">
                <label for="username">Tài Khoản</label><br>
                <input class="login-form-group" type="text" id="username" name="username"><br>
                <label for="password">Mật Khẩu</label><br>
                <input class="login-form-group" type="password" id="password" name="password"><br>
                <button class="login-button" type="submit" style="margin: auto 20px;">Đăng Nhập</button>
                <h6><br>Nếu bạn chưa có tài khoản, <a href="register.php">Đăng Ký</a></h6>
            </form>
        </div>
    </section>
</main>

<?php
include '../include/footer.php';
    ?>