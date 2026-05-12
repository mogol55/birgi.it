<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/storage.php';

function start_secure_session(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_set_cookie_params(['httponly' => true, 'secure' => !empty($_SERVER['HTTPS']), 'samesite' => 'Lax']);
        session_start();
    }
}
function admin_logged_in(): bool { return !empty($_SESSION[ADMIN_SESSION_KEY]); }
function require_admin(): void { if (!admin_logged_in()) redirect('/admin/login.php'); }
function login_admin(string $username, string $password): bool {
    $users = read_json(USERS_FILE);
    foreach ($users as $u) {
        if (($u['username'] ?? '') === $username && password_verify($password, $u['password_hash'] ?? '')) {
            $_SESSION[ADMIN_SESSION_KEY] = true;
            $_SESSION[LOGIN_ATTEMPT_KEY] = 0;
            return true;
        }
    }
    return false;
}
