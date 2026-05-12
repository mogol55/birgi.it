<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/helpers.php';require_once __DIR__ . '/../core/auth.php';
start_secure_session(); session_destroy(); redirect('/admin/login.php');
