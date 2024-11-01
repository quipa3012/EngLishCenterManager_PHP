<?php
class Session
{
    public static function init()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {

            return $_SESSION[$key];
        } else {

            return 0;
        }
    }

    public static function checkSession()
    {
        self::init();
        if (self::get("login") == 0) {
            self::destroy();
            header("Location:login.php");
        }
    }

    public static function checkLogin()
    {
        self::init();
        if (self::get("Login") == 1) {
            header("Location: index.php");
        }
    }

    public static function destroy()
    {
        session_destroy();
        header("Location: login.php");
    }

    public static function adminCheck()
    {
        if (self::get("Login") == 1) {
            if (self::get("RoleID") == 0) {
                header("Location: ../admin/index.php");
            }
        }
    }

    public static function userCheck()
    {
        if (self::get("Login") != 1) {
            header("Location: ../user/login.php");
        } else if (self::get("Login") == 1) {
            if (self::get("RoleID") != 0) {
                header("Location: ../user/index.php");
            }
        }
    }

    public static function adminDestroy()
    {
        session_destroy();
        header("Location: ../user/login.php");
    }

}

