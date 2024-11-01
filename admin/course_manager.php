<?php
include '../include/adminheader.php';
?>

<?php
$course = new Course();
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['CourseID'])) {
    $CourseID = $_GET['CourseID'];
    $delete_course = $course->delete_course($CourseID);
}
?>

<main>
    <section id="course" class="course container">
        <div style="margin-top: 10vh;" class="section-title">
            <h2>Quản Lý Khóa Học</h2>
            <a style="color: #37517e;" href="add_course.php">Thêm Khóa Học</a>
        </div>
        <div class="row content text-center d-flex justify-content-around">
            <?php
            if (isset($delete_course)) {
                echo $delete_course;
            }
            $course_list = $course->show_course();
            if ($course_list !== 0) {
                while ($result = $course_list->fetch_assoc()) {
                    ?>
                    <div class="col-lg-5 col-sm-5 mt-5 course-box section-title">
                        <img class="course-img" src="<?php echo $result['CourseImage'] ?>" alt="">
                        <h2><?php echo $result['CourseName'] ?></h2>
                        <p style="color: #37517e;" class="text-start"><?php echo $result['AboutCourse'] ?></p>
                        <h3 style="color: #37517e;" class="mt-3"><strong>Giá: <?php echo $result['CoursePrice'] ?></strong></h3>
                        <a href="course_detail.php?CourseID=<?php echo $result['CourseID'] ?>" class="course-edit-button mt-3"
                            type="submit" style="margin: auto 20px;">Chi Tiết Khóa Học</a><br>
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