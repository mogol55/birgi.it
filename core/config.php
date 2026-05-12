<?php
declare(strict_types=1);

const APP_NAME = 'PENSAI Music Private Lite v1.0.0';
const APP_BASE_PATH = __DIR__ . '/..';
const DATA_DIR = APP_BASE_PATH . '/data';
const TRACKS_DIR = APP_BASE_PATH . '/tracks';
const COVERS_DIR = APP_BASE_PATH . '/covers';
const BACKUPS_DIR = DATA_DIR . '/backups';
const PLAYLIST_FILE = DATA_DIR . '/playlist.json';
const USERS_FILE = DATA_DIR . '/users.json';
const SETTINGS_FILE = DATA_DIR . '/settings.json';
const DEFAULT_COVER = 'covers/default-cover.svg';

const ADMIN_SESSION_KEY = 'admin_authenticated';
const LISTEN_SESSION_KEY = 'listen_unlocked';
const LOGIN_ATTEMPT_KEY = 'admin_login_attempts';
const LOGIN_LOCK_UNTIL_KEY = 'admin_lock_until';

const MAX_TRACK_UPLOAD_MB = 100;
const MAX_COVER_UPLOAD_MB = 10;
