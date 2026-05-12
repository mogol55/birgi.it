<?php
declare(strict_types=1);
require_once __DIR__ . '/helpers.php';

function upload_file(array $file, string $targetDir, array $allowedExt, array $allowedMime): string {
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) throw new RuntimeException('Upload non valido');
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) throw new RuntimeException('Estensione non consentita');
    $mime = mime_content_type($file['tmp_name']) ?: '';
    if (!in_array($mime, $allowedMime, true)) throw new RuntimeException('MIME non valido');
    $base = normalize_filename(pathinfo($file['name'], PATHINFO_FILENAME));
    $name = $base . '-' . bin2hex(random_bytes(4)) . '.' . $ext;
    $target = rtrim($targetDir, '/') . '/' . $name;
    if (!move_uploaded_file($file['tmp_name'], $target)) throw new RuntimeException('Impossibile salvare file');
    return $name;
}
