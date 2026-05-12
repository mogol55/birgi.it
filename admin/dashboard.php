<?php
declare(strict_types=1);
require_once __DIR__ . '/../core/helpers.php';require_once __DIR__ . '/../core/auth.php';require_once __DIR__ . '/../core/storage.php';
start_secure_session(); ensure_data_files(); require_admin();
$playlist = read_json(PLAYLIST_FILE); $size=0; foreach (glob(TRACKS_DIR.'/*')?:[] as $f){$size+=filesize($f);} foreach (glob(COVERS_DIR.'/*')?:[] as $f){$size+=filesize($f);} 
app_header('Dashboard');
echo '<main class="container"><h1>Dashboard</h1><p>Brani: '.count($playlist).'</p><p>Spazio usato: '.round($size/1024/1024,2).' MB</p><p><a href="/admin/track-new.php">Nuovo brano</a> | <a href="/admin/settings.php">Impostazioni</a> | <a href="/admin/logout.php">Logout</a></p><ul>';
foreach($playlist as $t){echo '<li>#'.(int)$t['order'].' '.e($t['title']).' - <a href="/admin/track-edit.php?id='.urlencode($t['id']).'">Modifica</a> <a href="/admin/track-delete.php?id='.urlencode($t['id']).'">Elimina</a></li>';}
echo '</ul></main>'; app_footer();
