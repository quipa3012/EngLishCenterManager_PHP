<?php
class Format
{
    // Phương thức định dạng ngày tháng
    public function formatDate($date)
    {
        // Sử dụng hàm date() để định dạng ngày tháng theo định dạng cụ thể và strtotime() để chuyển đổi chuỗi ngày tháng thành timestamp
        return date('F j, Y, g:i a', strtotime($date));
    }

    // Phương thức rút gọn văn bản
    public function textShorten($text, $limit = 400)
    {
        // Thêm một khoảng trắng vào cuối văn bản để tránh việc cắt văn bản giữa từ
        $text = $text . " ";
        // Sử dụng hàm substr() để rút gọn văn bản đến một số ký tự nhất định
        $text = substr($text, 0, $limit);
        // Cắt văn bản đến từ cuối cùng trước khi đạt đến giới hạn ký tự và thêm dấu '...' vào cuối chuỗi
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . ".....";
        return $text;
    }

    // Phương thức làm sạch dữ liệu
    public function validation($data)
    {
        // Loại bỏ khoảng trắng ở đầu và cuối chuỗi
        $data = trim($data);
        // Loại bỏ các dấu backslashes
        $data = stripslashes($data);
        // Chuyển đổi các ký tự đặc biệt thành các thẻ HTML
        $data = htmlspecialchars($data);
        return $data;
    }

    // Phương thức trích xuất tiêu đề từ tên file
    public function title()
    {
        // Lấy đường dẫn tới tệp hiện tại
        $path = $_SERVER['SCRIPT_FILENAME'];
        // Lấy tên file mà không có phần mở rộng (.php)
        $title = basename($path, '.php');
        // Nếu tên file là 'index', thì đổi thành 'home', nếu là 'contact', thì giữ nguyên
        if ($title == 'index') {
            $title = 'home';
        } elseif ($title == 'contact') {
            $title = 'contact';
        }
        // Chuyển đổi chữ cái đầu tiên của tên file thành chữ hoa và trả về
        return $title = ucfirst($title);
    }
}
