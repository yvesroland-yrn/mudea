<?php

namespace App\Services;

use App\Models\VieCoutume;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VieCoutumeService
{
    /**
     * Récupérer tous les contenus Vie & Coutumes avec pagination et filtres
     */
    public function getAll(array $filters = [], int $perPage = 10)
    {
        $query = VieCoutume::query();

        // Filtre par recherche
        if (isset($filters['search']) && !empty($filters['search'])) {
            $query->where('titre', 'like', '%' . $filters['search'] . '%')
                ->orWhere('description', 'like', '%' . $filters['search'] . '%');
        }

        // Filtre par type
        if (isset($filters['type']) && !empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        // Filtre par catégorie
        if (isset($filters['categorie']) && !empty($filters['categorie'])) {
            $query->where('categorie', $filters['categorie']);
        }

        // Filtre par statut
        if (isset($filters['statut']) && !empty($filters['statut'])) {
            $query->where('statut', $filters['statut']);
        }

        // Tri
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate($perPage);
    }

    /**
     * Récupérer un contenu par son ID
     */
    public function getById(int $id): ?VieCoutume
    {
        return VieCoutume::find($id);
    }

    /**
     * Récupérer un contenu par son slug
     */
    public function getBySlug(string $slug): ?VieCoutume
    {
        return VieCoutume::where('slug', $slug)->first();
    }

    /**
     * Créer un nouveau contenu
     */
    public function create(array $data): VieCoutume
    {
        // Génération automatique du slug si non fourni
        if (empty($data['slug'])) {
            $data['slug'] = $this->generateSlug($data['titre']);
        }

        // Gestion du média (image/vidéo)
        if (isset($data['media']) && $data['media'] instanceof UploadedFile) {
            $data['media'] = $this->uploadMedia($data['media'], $data['type'] ?? 'article');
        }

        // Valeurs par défaut pour les booléens
        $data['epingle'] = $data['epingle'] ?? false;
        $data['vues'] = 0;

        // Ajout de l'utilisateur connecté
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        // Gestion de l'auteur par défaut
        if (empty($data['auteur'])) {
            $data['auteur'] = Auth::user()->nom . ' ' . Auth::user()->prenom;
        }

        return VieCoutume::create($data);
    }

    /**
     * Mettre à jour un contenu
     */
    public function update(int $id, array $data): ?VieCoutume
    {
        $vieCoutume = $this->getById($id);

        if (!$vieCoutume) {
            return null;
        }

        // Génération du slug si modifié et vide
        if (isset($data['titre']) && empty($data['slug'])) {
            $data['slug'] = $this->generateSlug($data['titre']);
        }

        // Gestion du média
        if (isset($data['media']) && $data['media'] instanceof \Illuminate\Http\UploadedFile) {
            // Suppression de l'ancien média
            if ($vieCoutume->media) {
                $this->deleteMedia($vieCoutume->media);
            }
            $data['media'] = $this->uploadMedia($data['media'], $data['type'] ?? $vieCoutume->type);
        }

        // Conversion des booléens
        foreach (['epingle'] as $field) {
            if (isset($data[$field])) {
                $data[$field] = filter_var($data[$field], FILTER_VALIDATE_BOOLEAN);
            }
        }

        $vieCoutume->update($data);

        return $vieCoutume->fresh();
    }

    /**
     * Supprimer un contenu
     */
    public function delete(int $id): bool
    {
        $vieCoutume = $this->getById($id);

        if (!$vieCoutume) {
            return false;
        }

        // Suppression du média
        if ($vieCoutume->media) {
            $this->deleteMedia($vieCoutume->media);
        }

        return $vieCoutume->delete();
    }

    /**
     * Supprimer définitivement (soft delete)
     */
    public function forceDelete(int $id): bool
    {
        $vieCoutume = VieCoutume::withTrashed()->find($id);

        if (!$vieCoutume) {
            return false;
        }

        // Suppression du média
        if ($vieCoutume->media) {
            $this->deleteMedia($vieCoutume->media);
        }

        return $vieCoutume->forceDelete();
    }

    /**
     * Restaurer un contenu supprimé
     */
    public function restore(int $id): bool
    {
        $vieCoutume = VieCoutume::withTrashed()->find($id);

        if (!$vieCoutume) {
            return false;
        }

        return $vieCoutume->restore();
    }

    /**
     * Changer le statut d'un contenu
     */
    public function changeStatut(int $id, string $statut): ?VieCoutume
    {
        $vieCoutume = $this->getById($id);

        if (!$vieCoutume) {
            return null;
        }

        if (!in_array($statut, ['brouillon', 'publie', 'archive'])) {
            return null;
        }

        $vieCoutume->statut = $statut;
        $vieCoutume->save();

        return $vieCoutume->fresh();
    }

    /**
     * Incrémenter le nombre de vues
     */
    public function incrementVues(int $id): bool
    {
        $vieCoutume = $this->getById($id);

        if (!$vieCoutume) {
            return false;
        }

        $vieCoutume->increment('vues');

        return true;
    }

    /**
     * Upload d'un média (image/vidéo)
     */
    private function uploadMedia(UploadedFile $media, string $type): string
    {
        $folder = 'vie-coutumes';
        
        if ($type === 'video') {
            return $media->store($folder . '/videos', 'public');
        }
        
        return $media->store($folder . '/images', 'public');
    }

    /**
     * Suppression d'un média
     */
    private function deleteMedia(string $path): void
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Générer un slug unique
     */
    private function generateSlug(string $titre): string
    {
        $slug = Str::slug($titre);
        $originalSlug = $slug;
        $counter = 1;

        while (VieCoutume::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
