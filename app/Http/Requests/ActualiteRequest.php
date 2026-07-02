<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActualiteRequest extends FormRequest
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
            'categorie' => 'required|in:projets,education,communaute,culture,sante,actualite',
            'statut' => 'required|in:brouillon,publie,archive',
            'auteur' => 'nullable|string|max:255',
            'date_publication' => 'nullable|date',
            'resume' => 'required|string|max:300',
            'contenu' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags' => 'nullable|string',
            'epingle' => 'nullable|boolean',
            'commentaires' => 'nullable|boolean',
        ];


        // Pour l'édition, le slug doit être unique sauf pour l'enregistrement actuel
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['slug'] = 'nullable|string|max:255|unique:actualites,slug,' . $this->route('actualite');
        } elseif ($this->filled('slug')) {
            // Pour la création, le slug doit être unique seulement s'il est fourni manuellement
            $rules['slug'] = 'nullable|string|max:255|unique:actualites,slug';
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
            'categorie.required' => 'La catégorie est obligatoire.',
            'categorie.in' => 'La catégorie sélectionnée n\'est pas valide.',
            'resume.required' => 'Le résumé est obligatoire.',
            'resume.max' => 'Le résumé ne peut pas dépasser 300 caractères.',
            'contenu.required' => 'Le contenu est obligatoire.',
            'image.required' => 'L\'image est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être au format JPG, PNG ou WEBP.',
            'image.max' => 'L\'image ne peut pas dépasser 2 Mo.',
        ];
    }
}
