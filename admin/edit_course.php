<?php
include '../include/adminheader.php';
?>

<?Php
$course = new Course();

if (!isset($_GET['CourseID']) || $_GET['CourseID'] == null) {
    echo "<script>window.location = 'course_manager.php'</script>";
} else {
    $CourseID = $_GET['CourseID'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $update_course = $course->update_course($_POST, $_FILES, $CourseID);
}
?>

<main>
    <section id="addcourse" class="container d-flex justify-content-center align-items-center">
        <div class="section-title addcourse-box">
            <h2>Sửa khóa học</h2>
            <?php
            if (isset($update_course)) {
                echo $update_course;
            }
            $get_course_by_id = $course->get_course_by_id($CourseID);
            if ($get_course_by_id) {
                while ($result_cur_course = $get_course_by_id->fetch_assoc()) {
                    ?> <br><br>
                    <form class="addcourse-form" action="" method="post" enctype="multipart/form-data">
                        <label for="CourseName">Tên Khóa Học</label><br>
                        <input class="addcourse-form-group" type="text" id="CourseName" name="CourseName"
                            value="<?php echo $result_cur_course['CourseName'] ?>"><br>

                        <label for="AboutCourse">Mô Tả Khóa Học</label><br>
                        <textarea class="addcourse-form-group" id="AboutCourse" name="AboutCourse"
                            rows="10"><?php echo $result_cur_course['AboutCourse'] ?></textarea><br>

                        <label for="AboutCourse">Mô Tả Chi Tiết Khóa Học</label><br>
                        <textarea class="addcourse-form-group" id="AboutCourseExtend" name="AboutCourseExtend"
                            rows="20"><?php echo $result_cur_course['AboutCourseExtend'] ?></textarea><br>

                        <label for="CourseImage">Hình Ảnh Khóa Học</label><br>
                        <img style="width: 200px;" class="course-img" src="<?php echo $result_cur_course['CourseImage'] ?>"
                            alt=""><br><br>
                        <input class="addcourse-form-group" type="file" id="CourseImage" name="CourseImage"><br>

                        <label for="CoursePrice">Giá Khóa Học</label><br>
                        <input value="<?php echo $result_cur_course['CoursePrice'] ?>" class="addcourse-form-group"
                            type="number" step="100000" min="0" id="CoursePrice" name="CoursePrice"><br><br>
                        <button class="addcourse-button" type="submit" name="submit" style="margin: auto 20px;">Cập Nhật
                            Học</button>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </section>

</main>
<?php
include '../include/adminfooter.php';
?>