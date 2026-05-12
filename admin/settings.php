<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/helpers.php';require_once __DIR__ . '/../core/auth.php';require_once __DIR__ . '/../core/storage.php';require_once __DIR__ . '/../core/csrf.php';
start_secure_session(); ensure_data_files(); require_admin(); $settings=read_json(SETTINGS_FILE);
if($_SERVER['REQUEST_METHOD']==='POST'){csrf_validate(); $settings['listen_password_enabled']=!empty($_POST['listen_password_enabled']); if(!empty($_POST['listen_password'])){$settings['listen_password_hash']=password_hash($_POST['listen_password'],PASSWORD_DEFAULT);} atomic_write_json(SETTINGS_FILE,$settings); redirect('/admin/settings.php');}
app_header('Impostazioni'); echo '<main class="container"><h1>Impostazioni ascolto</h1><form method="post">'.csrf_input().'<label><input type="checkbox" name="listen_password_enabled" '.(!empty($settings['listen_password_enabled'])?'checked':'').'> Abilita password ascolto</label><label>Nuova password ascolto<input type="password" name="listen_password"></label><button>Salva</button></form></main>'; app_footer();
