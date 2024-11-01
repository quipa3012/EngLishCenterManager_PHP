<?php
class User
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function username_exist_check($UserID, $UserName)
    {
        $query = "SELECT UserName FROM User WHERE UserName = '$UserName' AND UserID = '$UserID'";
        $result = $this->db->select($query);
        return $result;
    }

    public function email_exist_check($UserID, $Email)
    {
        $query = "SELECT Email FROM User WHERE Email = '$Email' AND UserID = '$UserID'";
        $result = $this->db->select($query);
        return $result;
    }

    public function username_unique_check($UserName)
    {
        $query = "SELECT UserName FROM User WHERE UserName = '$UserName'";
        $result = $this->db->select($query);
        return $result;
    }

    public function email_unique_check($Email)
    {
        $query = "SELECT Email FROM User WHERE Email = '$Email'";
        $result = $this->db->select($query);
        return $result;
    }

    public function create_user($data)
    {
        $UserName = mysqli_real_escape_string($this->db->link, $data['UserName']);
        $Password = mysqli_real_escape_string($this->db->link, $data['Password']);
        $Password2 = mysqli_real_escape_string($this->db->link, $data['Password2']);
        $Name = mysqli_real_escape_string($this->db->link, $data['Name']);
        $Email = mysqli_real_escape_string($this->db->link, $data['Email']);

        if ($UserName == "" || $Password == "" || $Password2 == "" || $Name == "") {
            $alert = "<span class='danger'>Các trường không được để trống!</span>";
            return $alert;
        } else if ($this->username_unique_check($UserName) !== 0) {
            $alert = "<span class='danger'>Tên đăng nhập đã tồn tại, vui lòng chọn tên đăng nhập khác!</span>";
            return $alert;
        } else if (strlen($Password) < 8) {
            $alert = "<span class='danger'>Mật khẩu phải có ít nhất 8 ký tự!</span>";
            return $alert;
        } elseif (!preg_match("/[A-Z]/", $Password) || !preg_match("/[a-z]/", $Password) || !preg_match("/[0-9]/", $Password)) {
            $alert = "<span class='danger'>Mật khẩu phải bao gồm ít nhất một ký tự in hoa, một ký tự thường và một số!</span>";
            return $alert;
        } elseif (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $Password)) {
            $alert = "<span class='danger'>Mật khẩu phải bao gồm ít nhất một ký tự đặc biệt!</span>";
            return $alert;
        } else if ($Password != $Password2) {
            $alert = "<span class='danger'>Nhập lại mật khẩu không đúng!</span>";
            return $alert;
        } else if (!preg_match("/^[a-zA-Z ]*$/", $Name)) {
            $alert = "<span class='danger'>Họ và tên không được chứa ký tự đặc biệt!</span>";
            return $alert;
        } else if ($this->email_unique_check($Email) !== 0) {
            $alert = "<span class='danger'>Địa chỉ Email đã tồn tại, vui lòng chọn địa chỉ email khác!</span>";
            return $alert;
        } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $alert = "<span class='danger'>Địa chỉ email không hợp lệ!</span>";
            return $alert;
        } else {
            $HashedPassword = password_hash($Password, PASSWORD_DEFAULT);
            $query = "INSERT INTO User(UserName, Password, Name, Email, RoleID) VALUES ('$UserName', '$HashedPassword', '$Name', '$Email', 1)";
            $result = $this->db->insert($query);

            if ($result !== 0) {
                $alert = "<span class='success'>Đăng ký thành công!</span>";
                return $alert;
            } else {
                $alert = "<span class='danger'>Đăng ký thất bại!</span>";
                return $alert;
            }
        }

    }

    public function check_same_password($UserID, $Password)
    {
        $query = "SELECT Password FROM User WHERE UserID = '$UserID'";
        $result = $this->db->select($query);

        if ($result !== 0) {
            $hashedPasswordFromDatabase = $result->fetch_assoc()['Password'];

            if (password_verify($Password, $hashedPasswordFromDatabase)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function get_user_by_id($UserID)
    {
        $query = "SELECT * FROM User WHERE UserID = '$UserID'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_user($data, $UserID)
    {
        $Password_old = mysqli_real_escape_string($this->db->link, $data['Password_old']);
        $Password_new1 = mysqli_real_escape_string($this->db->link, $data['Password_new1']);
        $Password_new2 = mysqli_real_escape_string($this->db->link, $data['Password_new2']);
        $Name = mysqli_real_escape_string($this->db->link, $data['Name']);
        $Email = mysqli_real_escape_string($this->db->link, $data['Email']);
        if ($Name == "" || $Email == "") {
            $alert = "<span class='danger'>Tên Và Email không được để trống!</span>";
            return $alert;
        } else {
            if ($Password_old != "") {
                if ($this->check_same_password($UserID, $Password_old) == 0) {
                    $alert = "<span class='danger'>Mật khẩu cũ sai!</span>";
                    return $alert;
                } else if ($Password_new1 == "") {
                    $alert = "<span class='danger'>Mật khẩu mới không được để trống!</span>";
                    return $alert;
                } else if (strlen($Password_new1) < 8) {
                    $alert = "<span class='danger'>Mật khẩu mới phải có ít nhất 8 ký tự!</span>";
                    return $alert;
                } elseif (!preg_match("/[A-Z]/", $Password_new1) || !preg_match("/[a-z]/", $Password_new1) || !preg_match("/[0-9]/", $Password_new1)) {
                    $alert = "<span class='danger'>Mật khẩu mới phải bao gồm ít nhất một ký tự in hoa, một ký tự thường và một số!</span>";
                    return $alert;
                } elseif (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $Password_new1)) {
                    $alert = "<span class='danger'>Mật khẩu mới phải bao gồm ít nhất một ký tự đặc biệt!</span>";
                    return $alert;
                } else if ($Password_new1 != $Password_new2) {
                    $alert = "<span class='danger'>Nhập lại mật khẩu không đúng!</span>";
                    return $alert;
                } else if (!preg_match("/^[a-zA-Z ]*$/", $Name)) {
                    $alert = "<span class='danger'>Họ và tên không được chứa ký tự đặc biệt!</span>";
                    return $alert;
                } else if ($this->email_unique_check($Email) !== 0 && Session::get('Email') != $Email) {
                    $alert = "<span class='danger'>Địa chỉ Email đã tồn tại, vui lòng chọn địa chỉ email khác!</span>";
                    return $alert;
                } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                    $alert = "<span class='danger'>Địa chỉ email không hợp lệ!</span>";
                    return $alert;
                } else {
                    $HashedPassword = password_hash($Password_new1, PASSWORD_DEFAULT);
                    $query = "UPDATE User SET
                    Password = '$HashedPassword',
                    Name = '$Name',
                    Email = '$Email'
                    WHERE UserID = '$UserID'";
                }
            } else {
                if (!preg_match("/^[a-zA-Z ]*$/", $Name)) {
                    $alert = "<span class='danger'>Họ và tên không được chứa ký tự đặc biệt!</span>";
                    return $alert;
                } else if ($this->email_unique_check($Email) !== 0 && Session::get('Email') != $Email) {
                    $alert = "<span class='danger'>Địa chỉ Email đã tồn tại, vui lòng chọn địa chỉ email khác!</span>";
                    return $alert;
                } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                    $alert = "<span class='danger'>Địa chỉ email không hợp lệ!</span>";
                    return $alert;
                } else {
                    $query = "UPDATE User SET
                    Name = '$Name',
                    Email = '$Email'
                    WHERE UserID = '$UserID'";
                }
            }
            $result = $this->db->update($query);
            if ($result !== 0) {
                $alert = "<span class='success'>Cập nhật thông tin thành công!</span>";
                return $alert;
            } else {
                $alert = "<span class='danger'>Cập nhật thông tin thất bại!</span>";
                return $alert;
            }

        }

    }

    public function admin_update_user($data, $UserID)
    {
        $UserName = mysqli_real_escape_string($this->db->link, $data['UserName']);
        $Password = mysqli_real_escape_string($this->db->link, $data['Password']);
        $Name = mysqli_real_escape_string($this->db->link, $data['Name']);
        $Email = mysqli_real_escape_string($this->db->link, $data['Email']);
        if ($Name == "" || $Email == "") {
            $alert = "<span class='danger'>Tên Và Email không được để trống!</span>";
            return $alert;
        } else {
            if ($Password != "") {
                if ($this->username_unique_check($UserName) !== 0 && $this->username_exist_check($UserID, $UserName) === 0) {
                    $alert = "<span class='danger'>Tên đăng nhập đã tồn tại, vui lòng chọn tên đăng nhập khác!</span>";
                    return $alert;
                } else if (strlen($Password) < 8) {
                    $alert = "<span class='danger'>Mật khẩu mới phải có ít nhất 8 ký tự!</span>";
                    return $alert;
                } elseif (!preg_match("/[A-Z]/", $Password) || !preg_match("/[a-z]/", $Password) || !preg_match("/[0-9]/", $Password)) {
                    $alert = "<span class='danger'>Mật khẩu mới phải bao gồm ít nhất một ký tự in hoa, một ký tự thường và một số!</span>";
                    return $alert;
                } elseif (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $Password)) {
                    $alert = "<span class='danger'>Mật khẩu mới phải bao gồm ít nhất một ký tự đặc biệt!</span>";
                    return $alert;
                } else if (!preg_match("/^[a-zA-Z ]*$/", $Name)) {
                    $alert = "<span class='danger'>Họ và tên không được chứa ký tự đặc biệt!</span>";
                    return $alert;
                } else if ($this->email_unique_check($Email) !== 0 && $this->email_exist_check($UserID, $Email) === 0) {
                    $alert = "<span class='danger'>Địa chỉ Email đã tồn tại, vui lòng chọn địa chỉ email khác!</span>";
                    return $alert;
                } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                    $alert = "<span class='danger'>Địa chỉ email không hợp lệ!</span>";
                    return $alert;
                } else {
                    $HashedPassword = password_hash($Password, PASSWORD_DEFAULT);
                    $query = "UPDATE User SET
                    Password = '$HashedPassword',
                    Name = '$Name',
                    Email = '$Email'
                    WHERE UserID = '$UserID'";
                }
            } else {
                if ($this->username_unique_check($UserName) !== 0 && $this->username_exist_check($UserID, $UserName) === 0) {
                    $alert = "<span class='danger'>Tên đăng nhập đã tồn tại, vui lòng chọn tên đăng nhập khác!</span>";
                    return $alert;
                } else if (!preg_match("/^[a-zA-Z ]*$/", $Name)) {
                    $alert = "<span class='danger'>Họ và tên không được chứa ký tự đặc biệt!</span>";
                    return $alert;
                } else if ($this->email_unique_check($Email) !== 0 && $this->email_exist_check($UserID, $Email) === 0) {
                    $alert = "<span class='danger'>Địa chỉ Email đã tồn tại, vui lòng chọn địa chỉ email khác!</span>";
                    return $alert;
                } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                    $alert = "<span class='danger'>Địa chỉ email không hợp lệ!</span>";
                    return $alert;
                } else {
                    $query = "UPDATE User SET
                    Name = '$Name',
                    Email = '$Email'
                    WHERE UserID = '$UserID'";
                }
            }
            $result = $this->db->update($query);
            if ($result !== 0) {
                $alert = "<span class='success'>Cập nhật thông tin thành công!</span>";
                return $alert;
            } else {
                $alert = "<span class='danger'>Cập nhật thông tin thất bại!</span>";
                return $alert;
            }

        }

    }

    public function delete_user($UserID)
    {
        $query = "DELETE FROM User WHERE UserID = '$UserID'";
        $result = $this->db->delete($query);
        if ($result == 0) {
            $alert = "<span class='danger'>Xóa Người dùng thất bại!</span>";
            return $alert;
        } else {
            $alert = "<span class='success'>Xóa Người dùng thành công!</span>";
            return $alert;
        }
    }

    public function show_user()
    {
        $query = "SELECT * FROM User Where RoleID = 1 order by UserID desc";
        $result = $this->db->select($query);
        return $result;
    }

}