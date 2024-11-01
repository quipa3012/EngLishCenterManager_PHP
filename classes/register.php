<?php
class Register
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function delete_register($UserID, $CourseID)
    {
        $query = "DELETE FROM Register WHERE UserID = '$UserID' and CourseID = '$CourseID';";
        $result = $this->db->delete($query);
        if ($result == 0) {
            $alert = "<span class='danger'>Xóa buổi học thất bại!</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Xóa buổi học thành công!</span>";
            return $alert;
        }
    }


    public function insert_register($UserID, $CourseID, $ScheduleID)
    {
        $UserID = mysqli_real_escape_string($this->db->link, $UserID);
        $CourseID = mysqli_real_escape_string($this->db->link, $CourseID);
        $ScheduleID = mysqli_real_escape_string($this->db->link, $ScheduleID);

        $query = "INSERT INTO Register(UserID, CourseID, ScheduleID) VALUES ('$UserID', '$CourseID', '$ScheduleID')";
        $result = $this->db->insert($query);

        if ($result !== 0) {
            $alert = "<span class='success'>Cập nhật lịch học thành công!</span>";
            header("Location: course_cart.php");
            return $alert;
        } else {
            $alert = "<span class='danger'>Cập nhật lịch học thất bại!</span>";
            return $alert;
        }
    }

    public function show_register_by_UserID_CourseID($UserID, $CourseID)
    {
        $query = "SELECT distinct * FROM Register
        JOIN Schedule ON Register.ScheduleID = Schedule.ScheduleID
        WHERE UserID = '$UserID' and CourseID = '$CourseID';";
        $result = $this->db->select($query);
        return $result;
    }

}
