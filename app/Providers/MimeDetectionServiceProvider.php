<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MimeDetectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Vérifier si l'extension fileinfo est manquante (problème fréquent sur hébergements mutualisés)
        if (!extension_loaded('fileinfo')) {

            // Définir une classe finfo de substitution pour les dépendances
            // (league/flysystem-local, league/mime-type-detection, Laravel Filesystem)
            if (!class_exists('finfo', false)) {
                require_once __DIR__ . '/../../finfo_polyfill.php';
            }

            // Surcharger le Filesystem de Laravel pour corriger mimeType() qui utilise finfo_file()
            $this->app->extend('files', function ($files, $app) {
                return new class($files) extends \Illuminate\Filesystem\Filesystem {
                    public function mimeType($path): string
                    {
                        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                        $map = [
                            'jpg' => 'image/jpeg',
                            'jpeg' => 'image/jpeg',
                            'png' => 'image/png',
                            'gif' => 'image/gif',
                            'webp' => 'image/webp',
                            'svg' => 'image/svg+xml',
                            'pdf' => 'application/pdf',
                            'doc' => 'application/msword',
                            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'xls' => 'application/vnd.ms-excel',
                            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'csv' => 'text/csv',
                            'txt' => 'text/plain',
                            'mp4' => 'video/mp4',
                            'mp3' => 'audio/mpeg',
                            'zip' => 'application/zip',
                            'json' => 'application/json',
                            'xml' => 'application/xml',
                        ];

                        return $map[$extension] ?? 'application/octet-stream';
                    }
                };
            });
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
