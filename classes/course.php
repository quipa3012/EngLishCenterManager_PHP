<?php
class Course
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_course($data, $file)
    {
        $CourseName = mysqli_real_escape_string($this->db->link, $data['CourseName']);
        $AboutCourse = mysqli_real_escape_string($this->db->link, $data['AboutCourse']);
        $AboutCourseExtend = mysqli_real_escape_string($this->db->link, $data['AboutCourseExtend']);
        $CoursePrice = mysqli_real_escape_string($this->db->link, $data['CoursePrice']);
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["CourseImage"]["name"]);
        $CourseImage = $target_file;
        move_uploaded_file($_FILES["CourseImage"]["tmp_name"], $target_file);
        if ($CourseName == "" || $AboutCourse == "" || $CoursePrice == "") {
            $alert = "<span class='danger'>Các trường không được để trống!</span>";
            return $alert;
        } else {
            $query = "INSERT INTO Course(CourseName, AboutCourse, CourseImage, CoursePrice, AboutCourseExtend) VALUES ('$CourseName', '$AboutCourse', '$CourseImage', '$CoursePrice', '$AboutCourseExtend')";
            $result = $this->db->insert($query);

            if ($result !== 0) {
                $alert = "<span class='success'>Thêm khóa học thành công!</span>";
                return $alert;
            } else {
                $alert = "<span class='danger'>Thêm khóa học thất bại!</span>";
                return $alert;
            }
        }
    }

    public function show_course()
    {
        $query = "SELECT * FROM Course order by CourseID desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_course($data, $file, $CourseID)
    {
        $CourseName = mysqli_real_escape_string($this->db->link, $data['CourseName']);
        $AboutCourse = mysqli_real_escape_string($this->db->link, $data['AboutCourse']);
        $AboutCourseExtend = mysqli_real_escape_string($this->db->link, $data['AboutCourseExtend']);
        $CoursePrice = mysqli_real_escape_string($this->db->link, $data['CoursePrice']);
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["CourseImage"]["name"]);
        $CourseImage = $target_file;
        move_uploaded_file($_FILES["CourseImage"]["tmp_name"], $target_file);
        if ($CourseName == "" || $AboutCourse == "" || $CoursePrice == "" || $AboutCourseExtend == "") {
            $alert = "<span class='danger'>Các trường không được để trống!</span>";
            return $alert;
        } else {
            if (!empty(basename($_FILES["CourseImage"]["name"]))) {
                $query = "UPDATE Course SET
                CourseName = '$CourseName',
                AboutCourse = '$AboutCourse',
                AboutCourseExtend = '$AboutCourseExtend',
                CoursePrice = '$CoursePrice',
                CourseImage = '$CourseImage'
                WHERE CourseID = '$CourseID'";
            } else {
                $query = "UPDATE Course SET
                CourseName = '$CourseName',
                AboutCourse = '$AboutCourse',
                AboutCourseExtend = '$AboutCourseExtend',
                CoursePrice = '$CoursePrice'
                WHERE CourseID = '$CourseID'";
            }
            $result = $this->db->update($query);
            if ($result !== 0) {
                $alert = "<span class='success'>Cập nhật khóa học thành công!</span>";
                return $alert;
            } else {
                $alert = "<span class='danger'>Cập nhật khóa học thất bại!</span>";
                return $alert;
            }
        }

    }

    public function delete_course($CourseID)
    {
        $query = "DELETE FROM Course WHERE CourseID = '$CourseID'";
        $result = $this->db->delete($query);
        if ($result == 0) {
            $alert = "<span class='danger'>Xóa khóa học thất bại!</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Xóa khóa học thành công!</span>";
            return $alert;
        }
    }

    public function get_course_by_id($CourseID)
    {
        $query = "SELECT * FROM Course WHERE CourseID = '$CourseID'";
        $result = $this->db->select($query);
        return $result;
    }


}

