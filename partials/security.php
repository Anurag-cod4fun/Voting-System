<?php
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function require_csrf()
{
    $token = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';
    if (!hash_equals(isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '', $token)) {
        http_response_code(400);
        exit('Invalid request token.');
    }
}

function require_user()
{
    if (empty($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true ||
        empty($_SESSION['role']) || $_SESSION['role'] !== 'user' ||
        empty($_SESSION['userdata']['sr'])) {
        header('Location: ../login/login.php');
        exit();
    }
}

function require_admin()
{
    if (empty($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true ||
        empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: ../login/adminlogin.php');
        exit();
    }
}

function authenticate_password($password, $storedPassword)
{
    if (password_verify($password, $storedPassword)) {
        return true;
    }

    return hash_equals((string) $storedPassword, (string) $password);
}
?>
