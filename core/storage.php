<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

function ensure_data_files(): void {
    foreach ([DATA_DIR, TRACKS_DIR, COVERS_DIR, BACKUPS_DIR] as $dir) {
        if (!is_dir($dir)) { mkdir($dir, 0775, true); }
    }
    if (!file_exists(PLAYLIST_FILE)) { atomic_write_json(PLAYLIST_FILE, []); }
    if (!file_exists(SETTINGS_FILE)) { atomic_write_json(SETTINGS_FILE, ['listen_password_enabled' => false, 'listen_password_hash' => '']); }
    if (!file_exists(USERS_FILE)) {
        $hash = password_hash('ChangeMeNow!2026', PASSWORD_DEFAULT);
        atomic_write_json(USERS_FILE, [['username' => 'salvatore', 'password_hash' => $hash]]);
    }
}
function read_json(string $file): array {
    if (!file_exists($file)) { return []; }
    $raw = file_get_contents($file);
    $data = json_decode($raw ?: '[]', true);
    return is_array($data) ? $data : [];
}
function atomic_write_json(string $file, array $data): void {
    $tmp = $file . '.tmp';
    file_put_contents($tmp, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    rename($tmp, $file);
}
function backup_playlist(): void {
    if (file_exists(PLAYLIST_FILE)) {
        copy(PLAYLIST_FILE, BACKUPS_DIR . '/playlist-' . date('Ymd-His') . '.json');
    }
}
