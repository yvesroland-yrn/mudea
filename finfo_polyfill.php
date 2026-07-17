<?php

/**
 * Polyfill pour la classe finfo (extension fileinfo)
 * 
 * Utilisé lorsque l'extension PHP fileinfo n'est pas disponible
 * (problème fréquent sur les hébergements mutualisés).
 * 
 * Cette classe remplace finfo en utilisant la détection par extension de fichier
 * plutôt que par analyse du contenu binaire.
 */

if (!class_exists('finfo', false)) {

    define('FILEINFO_MIME_TYPE', 16);
    define('FILEINFO_MIME', 1040);
    define('FILEINFO_NONE', 0);

    class finfo
    {
        private int $flags;
        private string $magicFile;

        private static array $mimeMap = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
            'bmp' => 'image/bmp',
            'ico' => 'image/x-icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'avif' => 'image/avif',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'csv' => 'text/csv',
            'txt' => 'text/plain',
            'html' => 'text/html',
            'htm' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'zip' => 'application/zip',
            'rar' => 'application/vnd.rar',
            'tar' => 'application/x-tar',
            'gz' => 'application/gzip',
            '7z' => 'application/x-7z-compressed',
            'mp4' => 'video/mp4',
            'mp3' => 'audio/mpeg',
            'wav' => 'audio/wav',
            'ogg' => 'audio/ogg',
            'webm' => 'video/webm',
            'avi' => 'video/x-msvideo',
            'mov' => 'video/quicktime',
            'mkv' => 'video/x-matroska',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'otf' => 'font/otf',
            'eot' => 'application/vnd.ms-fontobject',
        ];

        public function __construct(int $flags = FILEINFO_MIME_TYPE, string $magicFile = '')
        {
            $this->flags = $flags;
            $this->magicFile = $magicFile;
        }

        /**
         * Analyser le contenu d'une chaîne
         */
        public function buffer(string $string, int $flags = 0, $context = null): string|false
        {
            return 'application/octet-stream';
        }

        /**
         * Analyser un fichier
         */
        public function file(string $filename, int $flags = 0, $context = null): string|false
        {
            if (!file_exists($filename)) {
                return false;
            }

            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if ($this->flags === FILEINFO_MIME) {
                return (self::$mimeMap[$extension] ?? 'application/octet-stream') . '; charset=binary';
            }

            return self::$mimeMap[$extension] ?? 'application/octet-stream';
        }

        /**
         * Alias statique pour buffer()
         */
        public static function finfo_buffer(finfo $finfo, string $string, int $flags = 0, $context = null): string|false
        {
            return $finfo->buffer($string, $flags, $context);
        }

        /**
         * Alias statique pour file()
         */
        public static function finfo_file(finfo $finfo, string $filename, int $flags = 0, $context = null): string|false
        {
            return $finfo->file($filename, $flags, $context);
        }
    }
}

/**
 * Fonctions procédurales de l'extension fileinfo
 */
if (!function_exists('finfo_open')) {
    function finfo_open(int $flags = FILEINFO_MIME_TYPE, string $magicFile = ''): finfo
    {
        return new finfo($flags, $magicFile);
    }
}

if (!function_exists('finfo_close')) {
    function finfo_close(finfo $finfo): bool
    {
        return true;
    }
}

if (!function_exists('finfo_file')) {
    function finfo_file(finfo $finfo, string $filename, int $flags = 0, $context = null): string|false
    {
        return $finfo->file($filename, $flags, $context);
    }
}

if (!function_exists('finfo_buffer')) {
    function finfo_buffer(finfo $finfo, string $string, int $flags = 0, $context = null): string|false
    {
        return $finfo->buffer($string, $flags, $context);
    }
}

if (!function_exists('mime_content_type')) {
    function mime_content_type(string $filename): string|false
    {
        if (!file_exists($filename)) {
            return false;
        }

        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $map = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
            'pdf' => 'application/pdf',
            'txt' => 'text/plain',
            'html' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'zip' => 'application/zip',
            'mp4' => 'video/mp4',
            'mp3' => 'audio/mpeg',
        ];

        return $map[$extension] ?? 'application/octet-stream';
    }
}