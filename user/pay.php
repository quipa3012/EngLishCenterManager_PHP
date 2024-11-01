<?php
include '../include/header.php';
?>

<?php
$cart = new Cart();
if (!isset($_GET['CartID']) || $_GET['CartID'] == null) {
    echo "<script>window.location = 'course_cart.php'</script>";
} else {
    $CartID = $_GET['CartID'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $pay = $cart->pay($CartID);
}

$UserID = Session::get('UserID');
?>


<main>
    <section id="course" class="course container">
        <div class="row content text-center d-flex justify-content-around section-title  mt-5">
            <h2>Thanh Toán</h2>
            <form style="width: 45%; color: #37517e;;" action="" method="post" class="col-lg-6 course-box">
                <h5>Cách 1: Quét mã QR để thanh toán</h5>
                <img style="width: 500px;" src="../images/pay/pay.png" alt="">
                <h5 class="mt-5">Cách 2:Thanh toán bằng hình thức chuyển khoản</h5>
                <h6>Ngân hàng: Ngân hàng quân đội - MB</h6>
                <h6>Chủ tài khoản: PHAN ANH QUI</h6>
                <h6>Nội dung chuyển khoản: <?php echo $CartID; ?></h6>
                <h5 class="mt-5">Cách 3: Thanh toán trực tiếp tại địa chỉ</h5>
                <h6>351, Võ Văn Kiệt, Long Hòa, Bình Thủy, thành phố Cần Thơ</h6>
                <input class="course-edit-button mt-3 mb-3" type="submit" name="submit" style="margin: auto 20px;"
                    value="Xác Nhận Đã Thanh Toán"></input>
            </form>
        </div>
    </section>
</main>

<?php
include '../include/footer.php'
    ?>