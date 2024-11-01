<?php
Session::checkLogin();
?>

<?php
class Login
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function login($username, $password)
    {
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($username) || empty($password)) {
            $alert = "Tài khoản hoặc mật khẩu không được để trống!";
            return $alert;
        } else {
            $query = "SELECT * FROM user WHERE UserName = '$username'";
            $result = $this->db->select($query);

            if ($result !== 0) {
                $value = $result->fetch_assoc();
                $hashedPassword = $value['Password'];

                if (password_verify($password, $hashedPassword)) {
                    Session::set('Login', 1);
                    Session::set('UserID', $value['UserID']);
                    Session::set('UserName', $value['UserName']);
                    Session::set('Password', $value['Password']);
                    Session::set('Name', $value['Name']);
                    Session::set('Email', $value['Email']);
                    Session::set('RoleID', $value['RoleID']);
                    header("Location: index.php");
                } else {
                    $alert = "Mật khẩu không đúng!";
                    return $alert;
                }
            } else {
                $alert = "Tài khoản không tồn tại!";
                return $alert;
            }
        }
    }

}

?>