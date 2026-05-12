<?php
declare(strict_types=1);
require_once __DIR__ . '/core/config.php';
require_once __DIR__ . '/core/helpers.php';
require_once __DIR__ . '/core/storage.php';
require_once __DIR__ . '/core/auth.php';
require_once __DIR__ . '/core/csrf.php';
start_secure_session(); ensure_data_files();
$settings = read_json(SETTINGS_FILE);
if (!empty($settings['listen_password_enabled']) && empty($_SESSION[LISTEN_SESSION_KEY])) {
  if ($_SERVER['REQUEST_METHOD']==='POST') { csrf_validate(); if (password_verify($_POST['listen_password'] ?? '', $settings['listen_password_hash'] ?? '')) { $_SESSION[LISTEN_SESSION_KEY]=true; redirect('/index.php'); } $error='Password errata'; }
  app_header('Accesso ascolto');
  echo '<main class="container"><h1>Archivio privato</h1>' . (!empty($error)?'<p class="error">'.e($error).'</p>':'') . '<form method="post">'.csrf_input().'<label>Password ascolto<input type="password" name="listen_password" required></label><button>Entra</button></form></main>';
  app_footer(); exit;
}
$playlist = read_json(PLAYLIST_FILE); usort($playlist, fn($a,$b)=>($a['order']??0)<=>($b['order']??0));
app_header();
echo '<main class="container"><h1>'.e(APP_NAME).'</h1><p>I brani presenti in questo archivio sono caricati dall’amministratore e destinati ad ascolto privato o semi-privato tramite link. Ogni brano riporta autore, origine e licenza dichiarata.</p><input id="search" placeholder="Cerca titolo, artista, album">';
echo '<audio id="player" controls></audio><ul id="track-list">';
foreach($playlist as $t){
 echo '<li class="track" data-title="'.e(strtolower(($t['title']??'').' '.($t['artist']??'').' '.($t['album']??''))).'" data-src="'.e($t['file']).'"><button class="track-btn">'.e($t['title']??'').'</button><small>'.e($t['artist']??'').' • '.e($t['album']??'').'</small><div class="rights">Diritti e licenza: '.e($t['rights']['author']??'').' / '.e($t['rights']['license']??'').' / '.e($t['rights']['origin']??'').'</div></li>';
}
echo '</ul></main>';
app_footer();
