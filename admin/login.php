<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/helpers.php';require_once __DIR__ . '/../core/auth.php';require_once __DIR__ . '/../core/csrf.php';
start_secure_session(); ensure_data_files();
if (admin_logged_in()) redirect('/admin/dashboard.php');
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') { csrf_validate(); if (login_admin(trim($_POST['username']??''), $_POST['password']??'')) redirect('/admin/dashboard.php'); $error='Credenziali non valide'; }
app_header('Login Admin');
echo '<main class="container"><h1>Login Admin</h1>'.($error?'<p class="error">'.e($error).'</p>':'').'<form method="post">'.csrf_input().'<label>Username<input name="username" required></label><label>Password<input name="password" type="password" required></label><button>Entra</button></form></main>';
app_footer();
