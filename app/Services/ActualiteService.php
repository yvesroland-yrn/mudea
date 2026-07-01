<?php

namespace App\Services;

use App\Models\Actualite;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActualiteService
{
    /**
     * Récupérer toutes les actualités avec pagination et filtres
     */
    public function getAll(array $filters = [], int $perPage = 10)
    {
        $query = Actualite::query();

        // Filtre par recherche
        if (isset($filters['search']) && !empty($filters['search'])) {
            $query->where('titre', 'like', '%' . $filters['search'] . '%')
                ->orWhere('resume', 'like', '%' . $filters['search'] . '%');
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
     * Récupérer une actualité par son ID
     */
    public function getById(int $id): ?Actualite
    {
        return Actualite::find($id);
    }

    /**
     * Récupérer une actualité par son slug
     */
    public function getBySlug(string $slug): ?Actualite
    {
        return Actualite::where('slug', $slug)->first();
    }

    /**
     * Créer une nouvelle actualité
     */
    public function create(array $data): Actualite
    {
        // Génération automatique du slug si non fourni
        if (empty($data['slug'])) {
            $data['slug'] = $this->generateSlug($data['titre']);
        }

        // Gestion de l'image
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        // Gestion des tags (conversion string vers array)
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = $this->parseTags($data['tags']);
        }

        // Valeurs par défaut pour les booléens
        $data['epingle'] = $data['epingle'] ?? false;
        $data['vues'] = 0;

        // Ajout de l'utilisateur connecté
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        return Actualite::create($data);
    }

    /**
     * Mettre à jour une actualité
     */
    public function update(int $id, array $data): ?Actualite
    {
        $actualite = $this->getById($id);

        if (!$actualite) {
            return null;
        }

        // Génération du slug si modifié et vide
        if (isset($data['titre']) && empty($data['slug'])) {
            $data['slug'] = $this->generateSlug($data['titre']);
        }

        // Gestion de l'image
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            // Suppression de l'ancienne image
            if ($actualite->image) {
                $this->deleteImage($actualite->image);
            }
            $data['image'] = $this->uploadImage($data['image']);
        }

        // Gestion des tags
        if (isset($data['tags']) && is_string($data['tags'])) {
            $data['tags'] = $this->parseTags($data['tags']);
        }

        // Conversion des booléens
        foreach (['notifier', 'partager_reseaux', 'epingle', 'commentaires'] as $field) {
            if (isset($data[$field])) {
                $data[$field] = filter_var($data[$field], FILTER_VALIDATE_BOOLEAN);
            }
        }

        $actualite->update($data);

        return $actualite->fresh();
    }

    /**
     * Supprimer une actualité
     */
    public function delete(int $id): bool
    {
        $actualite = $this->getById($id);

        if (!$actualite) {
            return false;
        }

        // Suppression de l'image
        if ($actualite->image) {
            $this->deleteImage($actualite->image);
        }

        return $actualite->delete();
    }

    /**
     * Supprimer définitivement (soft delete)
     */
    public function forceDelete(int $id): bool
    {
        $actualite = Actualite::withTrashed()->find($id);

        if (!$actualite) {
            return false;
        }

        // Suppression de l'image
        if ($actualite->image) {
            $this->deleteImage($actualite->image);
        }

        return $actualite->forceDelete();
    }

    /**
     * Restaurer une actualité supprimée
     */
    public function restore(int $id): bool
    {
        $actualite = Actualite::withTrashed()->find($id);

        if (!$actualite) {
            return false;
        }

        return $actualite->restore();
    }

    /**
     * Changer le statut d'une actualité
     */
    public function changeStatut(int $id, string $statut): ?Actualite
    {
        $actualite = $this->getById($id);

        if (!$actualite) {
            return null;
        }

        if (!in_array($statut, ['brouillon', 'publie', 'archive'])) {
            return null;
        }

        $actualite->statut = $statut;
        $actualite->save();

        return $actualite->fresh();
    }

    /**
     * Incrémenter le nombre de vues
     */
    public function incrementVues(int $id): bool
    {
        $actualite = $this->getById($id);

        if (!$actualite) {
            return false;
        }

        $actualite->increment('vues');

        return true;
    }

    /**
     * Upload d'une image
     */
    private function uploadImage(UploadedFile $image): string
    {
        return $image->store('actualites', 'public');
    }

    /**
     * Suppression d'une image
     */
    private function deleteImage(string $path): void
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

        while (Actualite::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Parser les tags (string vers array)
     */
    private function parseTags(string $tagsString): array
    {
        $tags = explode(',', $tagsString);
        return array_map(function ($tag) {
            return trim($tag);
        }, array_filter($tags));
    }
}
