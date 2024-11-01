<?php
class Schedule
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function show_schedule()
    {
        $query = "SELECT * FROM Schedule order by ScheduleID ASC";
        $result = $this->db->select($query);
        return $result;
    }

    public function add_current_register($ScheduleID)
    {
        $query = "UPDATE Schedule SET CurrentRegister = CurrentRegister + 1 WHERE ScheduleID = '$ScheduleID';";
        $result = $this->db->update($query);
        if ($result == 0) {
            $alert = "<span class='danger'>Cập nhật sỉ số thất bại!</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Cập nhật sỉ số thành công!</span>";
            return $alert;
        }
    }

    public function reduce_current_register($UserID, $CourseID)
    {
        $query = "UPDATE Schedule SET CurrentRegister = CurrentRegister - 1
        WHERE ScheduleID IN (
            SELECT ScheduleID
            FROM Register
            WHERE UserID = '$UserID' AND CourseID = '$CourseID'
        );
        ";
        $result = $this->db->update($query);
        if ($result == 0) {
            $alert = "<span class='danger'>Cập nhật sỉ số thất bại!</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Cập nhật sỉ số thành công!</span>";
            return $alert;
        }
    }

}
