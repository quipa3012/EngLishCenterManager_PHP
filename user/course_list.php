<?php
include '../include/header.php';
?>

<main>
    <section id="course" class="course container">
        <div style="margin-top: 10vh;" class="section-title">
            <h2>Khóa Học</h2>
        </div>
        <div class="row content text-center d-flex justify-content-around">
            <?php
            $course = new Course();
            $course_list = $course->show_course();
            if ($course_list !== 0) {
                while ($result = $course_list->fetch_assoc()) {
                    ?>
                    <div class="col-lg-5 col-sm-5  mt-5 course-box section-title">
                        <img class="course-img" src="<?php echo $result['CourseImage'] ?>" alt="">
                        <h2><?php echo $result['CourseName'] ?></h2>
                        <p style="color: #37517e;" class="text-start"><?php echo $result['AboutCourse'] ?></p>
                        <h3 style="color: #37517e;" class="mt-3"><strong>Giá: <?php echo $result['CoursePrice'] ?></strong></h3>
                        <a href="course_detail.php?CourseID=<?php echo $result['CourseID'] ?>" class="course-edit-button mt-3"
                            type="submit" style="margin: auto 20px;">Chi Tiết Khóa Học</a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

    </section>
</main>

<?php
include '../include/footer.php'
    ?>