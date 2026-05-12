# PENSAI Music Private Lite v1.0.0

## Installazione Aruba (FTP)
1. Carica la cartella in `/public_html/music-private/`.
2. Verifica permessi scrittura su `data/`, `tracks/`, `covers/`, `data/backups/`.
3. Apri `/music-private/admin/login.php`.
4. Credenziali iniziali: `salvatore` / `ChangeMeNow!2026` (cambia subito hash in `data/users.json` tramite pannello futuro o file manuale).

## Uso
- Carica MP3 e copertine da **Nuovo brano**.
- Gestisci ordine col campo `order`.
- Attiva password ascolto in **Impostazioni**.

## Limiti PHP
Controlla `upload_max_filesize` e `post_max_size` nel pannello hosting Aruba.

## Backup e ripristino
Ogni modifica playlist crea un backup in `data/backups/`.
Per ripristino copia il backup su `data/playlist.json`.

## Troubleshooting
- Upload fallisce: controlla MIME/estensione e limiti PHP.
- Login fallisce: verifica hash in `data/users.json`.
- 403 su data: è atteso, directory protetta.
