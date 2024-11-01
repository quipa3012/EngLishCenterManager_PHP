<?php
class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($UserID, $CourseID)
    {
        if ($UserID == 0) {
            header("location: login.php");
        } else {
            $CourseID = mysqli_real_escape_string($this->db->link, $CourseID);
            $UserID = mysqli_real_escape_string($this->db->link, $UserID);

            $query = "INSERT INTO Cart(UserID, CourseID , Status) VALUES ('$UserID', '$CourseID', 0)";
            $result = $this->db->insert($query);

            if ($result !== 0) {
                header("location: course_cart.php");
                return $result;
            }
        }
    }

    public function show_cart_by_UserID($UserID)
    {
        $query = "SELECT * FROM Cart
        JOIN DenyReason ON Cart.DenyReasonID = DenyReason.DenyReasonID
        JOIN User ON Cart.UserID = User.UserID
        JOIN Course ON Cart.CourseID = Course.CourseID
        WHERE Cart.UserID = '$UserID'
        ORDER BY CartID DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function show_cart()
    {
        $query = "SELECT DISTINCT * FROM Cart
        JOIN User ON Cart.UserID = User.UserID
        JOIN Course ON Cart.CourseID = Course.CourseID
        WHERE status <> 0 AND ScheduleSet <> 0
        ORDER BY CartID DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_cart_by_id($CartID)
    {
        $query = "SELECT * FROM Cart WHERE CartID = '$CartID'";
        $result = $this->db->select($query);
        return $result;
    }

    public function pay($CartID)
    {
        $query = "UPDATE Cart
        SET status = 1
        WHERE CartID = '$CartID';
        ";
        $result = $this->db->update($query);
        header("location: course_cart.php");
        return $result;
    }

    public function agree($CartID)
    {
        $query = "UPDATE Cart
        SET status = 2
        WHERE CartID = '$CartID';
        ";
        $result = $this->db->update($query);

        if ($result == 0) {
            $alert = "<span class='danger'>Chấp nhận yêu cầu thất bại!</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Đã chấp nhận yêu cầu!</span>";
            return $alert;
        }
    }

    public function denie($CartID, $DenyReasonID)
    {
        $query = "UPDATE Cart
        SET Status = 3,
        DenyReasonID = $DenyReasonID
        WHERE CartID = '$CartID';
        ";
        $result = $this->db->update($query);

        if ($result !== 0) {
            $alert = "<span class='success'>Đã từ chối yêu cầu!</span>";
            return $alert;
        } else {
            $alert = "<span class='danger'>Từ chối yêu cầu thất bại!</span>";
            return $alert;
        }
    }

    public function delete_cart($CartID)
    {
        $query = "DELETE FROM Cart WHERE CartID = '$CartID'";
        $result = $this->db->delete($query);
        if ($result == 0) {
            $alert = "<span class='danger'>Xóa khóa học thất bại!</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Xóa khóa học thành công!</span>";
            return $alert;
        }
    }

    public function cart_set_schedule($CartID)
    {
        $query = "UPDATE Cart SET ScheduleSet = 1 WHERE CartID = '$CartID';";
        $result = $this->db->update($query);
        if ($result == 0) {
            $alert = "<span class='danger'>Đánh dấu đã lập thời khóa biểu thất bại!</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Đánh dấu đã lập thời khóa biểu thành công!</span>";
            return $alert;
        }
    }

    public function cart_set_schedule_denie($CartID)
    {
        $query = "UPDATE Cart SET ScheduleSet = 2 WHERE CartID = '$CartID';";
        $result = $this->db->update($query);
        if ($result == 0) {
            $alert = "<span class='danger'>Đánh dấu đã lập thời khóa biểu thất bại!</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Đánh dấu đã lập thời khóa biểu thành công!</span>";
            return $alert;
        }
    }


}
