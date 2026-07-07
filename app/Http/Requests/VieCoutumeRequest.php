<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VieCoutumeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'titre' => 'required|string|max:120',
            'slug' => 'nullable|string|max:255',
            'type' => 'required|in:article,photos,video',
            'categorie' => 'nullable|in:traditions,ceremonies,gastronomie,temoignages',
            'statut' => 'required|in:brouillon,publie,archive',
            'auteur' => 'nullable|string|max:255',
            'date_publication' => 'nullable|date',
            'description' => 'required|string|max:300',
            'contenu' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:20480',
            'epingle' => 'nullable|boolean',
        ];

        // Pour l'édition, le slug doit être unique sauf pour l'enregistrement actuel
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['slug'] = 'nullable|string|max:255|unique:vie_coutumes,slug,' . $this->route('vie_coutume');
        } elseif ($this->filled('slug')) {
            // Pour la création, le slug doit être unique seulement s'il est fourni manuellement
            $rules['slug'] = 'nullable|string|max:255|unique:vie_coutumes,slug';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',
            'titre.max' => 'Le titre ne peut pas dépasser 120 caractères.',
            'slug.unique' => 'Ce slug URL est déjà utilisé. Veuillez en choisir un autre.',
            'slug.max' => 'Le slug URL ne peut pas dépasser 255 caractères.',
            'type.required' => 'Le type de contenu est obligatoire.',
            'type.in' => 'Le type sélectionné n\'est pas valide.',
            'categorie.in' => 'La catégorie sélectionnée n\'est pas valide.',
            'description.required' => 'La description est obligatoire.',
            'description.max' => 'La description ne peut pas dépasser 300 caractères.',
            'media.file' => 'Le fichier doit être un fichier valide.',
            'media.mimes' => 'Le média doit être au format JPG, PNG, WEBP, MP4, MOV ou AVI.',
            'media.max' => 'Le média ne peut pas dépasser 20 Mo.',
        ];
    }
}
