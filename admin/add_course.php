<?php
include '../include/adminheader.php';
?>

<?Php
$course = new Course();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $insert_course = $course->insert_course($_POST, $_FILES);
}
?>

<main>
    <section id="addcourse" class="container d-flex justify-content-center align-items-center">
        <div class="section-title addcourse-box">
            <h2>Thêm khóa học</h2>
            <?php
            if (isset($insert_course)) {
                echo $insert_course;
            }
            ?> <br><br>
            <form class="addcourse-form" action="add_course.php" method="post" enctype="multipart/form-data">
                <label for="CourseName">Tên Khóa Học</label><br>
                <input class="addcourse-form-group" type="text" id="CourseName" name="CourseName"><br>

                <label for="AboutCourse">Mô Tả Khóa Học</label><br>
                <textarea class="addcourse-form-group" id="AboutCourse" name="AboutCourse" rows="10"></textarea><br>

                <label for="AboutCourse">Mô Tả Chi Tiết Khóa Học</label><br>
                <textarea class="addcourse-form-group" id="AboutCourseExtend" name="AboutCourseExtend"
                    rows="20"></textarea><br>

                <label for="CourseImage">Hình Ảnh Khóa Học</label><br>
                <input class="addcourse-form-group" type="file" id="CourseImage" name="CourseImage"><br>

                <label for="CoursePrice">Giá Khóa Học</label><br>
                <input class="addcourse-form-group" type="number" step="100000" min="0" id="CoursePrice"
                    name="CoursePrice"><br><br>
                <button class="addcourse-button" type="submit" name="submit" style="margin: auto 20px;">Thêm Khóa
                    Học</button>
            </form>
        </div>
    </section>

</main>
<?php
include '../include/adminfooter.php';
?>