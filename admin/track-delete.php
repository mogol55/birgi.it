<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/helpers.php';require_once __DIR__ . '/../core/auth.php';require_once __DIR__ . '/../core/storage.php';
start_secure_session(); ensure_data_files(); require_admin();
$id=$_GET['id']??''; $playlist=read_json(PLAYLIST_FILE); backup_playlist();
$playlist=array_values(array_filter($playlist,fn($t)=>($t['id']??'')!==$id)); atomic_write_json(PLAYLIST_FILE,$playlist); redirect('/admin/dashboard.php');
