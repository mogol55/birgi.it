<?php
declare(strict_types=1);

function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
function now_iso8601(): string { return (new DateTimeImmutable())->format(DateTimeInterface::ATOM); }
function redirect(string $path): void { header('Location: ' . $path); exit; }
function normalize_filename(string $name): string {
    $name = strtolower(trim($name));
    $name = preg_replace('/[^a-z0-9\-_.]+/', '-', $name) ?? 'file';
    return trim($name, '-_.') ?: 'file';
}
function generate_track_id(string $title): string {
    $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower($title)) ?? 'track';
    return trim($slug, '-') . '-' . bin2hex(random_bytes(3));
}
function app_header(string $title = APP_NAME): void {
    echo '<!doctype html><html lang="it"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">';
    echo '<meta name="robots" content="noindex,nofollow">';
    echo '<title>' . e($title) . '</title><link rel="stylesheet" href="/assets/style.css"></head><body>';
}
function app_footer(): void { echo '<script src="/assets/app.js" defer></script></body></html>'; }
