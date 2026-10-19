<?php
class Auth {
    public static function requireLogin() {
        if (empty($_SESSION['member_id'])) {
            header('Location: auth/login.php');
            exit();
        }
    }

    public static function login($member) {
        session_regenerate_id(true);
        $_SESSION['member_id'] = $member->member_id;
        $_SESSION['username'] = $member->username;
        $_SESSION['member_name'] = trim($member->first_name . ' ' . $member->last_name);
    }

    public static function logout() {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
    }
}