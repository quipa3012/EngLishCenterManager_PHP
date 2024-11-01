<?php
include '../include/header.php';
?>

<main>
    <section id="contact" class="contact">
        <div class="container" style="margin-top: 10vh;">

            <div class="section-title">
                <h2>Liên Hệ</h2>
            </div>

            <div class="row">
                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="fa-solid fa-location-dot"></i>
                            <h4>Địa chỉ:</h4>
                            <p>Tòa nhà 351, Long Hòa, Bình Thủy, Cần Thơ</p>
                        </div>

                        <div class="email">
                            <i class="fa-solid fa-envelope"></i>
                            <h4>Email:</h4>
                            <p>quib2016999@student.ctu.edu.vn</p>
                        </div>

                        <div class="phone">
                            <i class="fa-solid fa-phone"></i>
                            <h4>Số điện thoại:</h4>
                            <p>+84 942 733 787</p>
                        </div>

                        <img style="height: 350px;" src="../images/index/map.png" alt="">
                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Họ Tên</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Địa Chỉ Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Chủ Đề</label>
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nội Dụng</label>
                            <textarea class="form-control" name="message" rows="10" required></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Gửi</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section>
</main>

<?php
include '../include/footer.php';
?>