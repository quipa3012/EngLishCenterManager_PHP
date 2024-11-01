<?php
include '../include/header.php';
?>

<?php
$course = new Course();
$cart = new Cart();
if (!isset($_GET['CourseID']) || $_GET['CourseID'] == null) {
    echo "<script>window.location = 'course_list.php'</script>";
} else {
    $CourseID = $_GET['CourseID'];
}
$get_course_by_id = $course->get_course_by_id($CourseID);

$UserID = Session::get('UserID');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $add_to_cart = $cart->add_to_cart($UserID, $CourseID);
}

?>

<main>
    <section id="course" class="course container">
        <div class="row content text-center d-flex justify-content-around">
            <?php
            if ($get_course_by_id !== 0) {
                $result = $get_course_by_id->fetch_assoc();
                ?>
                <div class="col-lg-10  mt-5 course-box section-title">
                    <h2><?php echo $result['CourseName'] ?></h2>
                    <img class="course-img" src="<?php echo $result['CourseImage'] ?>" alt=""><br><br>
                    <h4 style="color: #37517e;" class="text-start"><?php echo $result['AboutCourse'] ?></h4><br>
                    <h4 style="color: #37517e;" class="text-start"><?php echo $result['AboutCourseExtend'] ?></h4>
                    <h1 style="color: #37517e;" class="mt-3"><strong>Giá: <?php echo $result['CoursePrice'] ?></strong></h1>
                    <form action="" method="post">
                        <input class="course-edit-button mt-3" type="submit" name="submit" style="margin: auto 20px;"
                            value="Đăng Ký Ngay"></input>
                    </form>
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