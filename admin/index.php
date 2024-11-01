<?php
include '../include/adminheader.php';
?>

<?php
$course = new Course();
if (isset($_GET['CourseID'])) {
    $CourseID = $_GET['CourseID'];
    $delete_course = $course->delete_course($CourseID);
}
?>

<main>
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1">
                    <h1>KHÔNG CẦN RA CÔNG VIÊN "SĂN TÂY" ĐỂ LUYỆN TIẾNG ANH</h1>
                    <h2>Tại Đây Có Hơn 40 Giáo Viên Tận Tâm Với Nhiều Năm Kinh Nghiệm Giảng Dạy</h2>
                    <div class="d-flex justify-content-center">
                        <a href="course_manager.php" class="btn-get-started scrollto">Tìm Hiểu Ngay</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="../images/index/img1.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>


    <section id="about" class="about">
        <div class="container">

            <div class="section-title">
                <h2>Về Chúng Tôi</h2>
            </div>

            <div class="row content text-center justify-content-around">
                <div class="col-lg-4">
                    <h5 class="fw-bold">HƠN 3000 HỌC VIÊN</h5>
                    <br>
                    <p>Hơn 3000 học viên đã lựa chọn học tiếng anh Cần Thơ tại Trung tâm Anh ngữ ENGQUI. Chúng tôi
                        đã
                        đồng hành, phát triển, tiếp bước tương lai cho thế hệ tiếp nối.</p>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold">02 CƠ SỞ LỚN-TRUNG TÂM ANH NGỮ TẠI CẦN THƠ</h5>
                    <p>Tọa lại tại trung tâm thành phố Cần Thơ, trung tâm Anh ngữ ENGQUI Cần Thơ sở hữu 2 tòa nhà
                        với
                        cơ sở vật chất tốt nhất để tạo ra môi trường học tập tốt nhất dành cho học viên của trường.
                    </p>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold">13 NĂM ĐỒNG HÀNH</h5>
                    <br>
                    <p>ENGQUI Cần Thơ rất tự hào và nhiệt huyết với việc giảng dạy, xây dựng nền tảng cho các bạn
                        trẻ
                        Cần Thơ. Với nhiều khóa học luyện thi, bồi dưỡng kiến thức tiếng Anh, đáp ứng được nhu cầu
                        đòi hỏi cao của xã hội.</p>
                </div>
            </div>

            <div style="margin-top: 50px;" class="section-title">
                <h2>Chương trình đào tạo</h2>
            </div>
            <div id="course" class="row content text-center d-flex justify-content-around">
                <?php
                if (isset($delete_course)) {
                    echo $delete_course;
                }
                $course_list = $course->show_course();
                if ($course_list !== 0) {
                    for ($i = 0; $i < 4; $i++) {
                        $result = $course_list->fetch_assoc();
                        if (!$result) {
                            break;
                        }
                        ?>
                        <div class="col-lg-5 col-sm-5 mt-5 course-box section-title">
                            <img class="course-img" src="<?php echo $result['CourseImage'] ?>" alt="">
                            <h2><?php echo $result['CourseName'] ?></h2>
                            <p style="color: #37517e;" class="text-left"><?php echo $result['AboutCourse'] ?></p>
                            <h3 style="color: #37517e;" class="mt-3"><strong>Giá: <?php echo $result['CoursePrice'] ?></strong>
                            </h3>
                            <a href="edit_course.php?CourseID=<?php echo $result['CourseID'] ?>" class="course-edit-button mt-3"
                                type="submit" style="margin: auto 20px;">Sửa Khóa Học</a>
                            <a href="javascript:void(0)" onclick="confirmDelete(<?php echo $result['CourseID'] ?>)"
                                class="course-del-button mt-3" type="submit" style="margin: auto 20px;">Xóa Khóa Học</a>
                        </div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>
    </section>

    <section id="contact" class="contact">
        <div class="container">

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

<script>
    function confirmDelete(courseID) {
        if (confirm("Bạn có chắc chắn muốn xóa khóa học không?")) {
            window.location.href = '?action=delete&CourseID=' + courseID;
        }
    }
</script>

<?php
include '../include/adminfooter.php';
?>