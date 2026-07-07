<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerVideoRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Règles de validation.
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'video' => [
                'required',
                'file',
                'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-matroska',
                'max:512000', // 500 Mo
            ],

            'is_highlight' => [
                'sometimes',
                'boolean',
            ],
        ];
    }

    /**
     * Messages personnalisés.
     */
    public function messages(): array
    {
        return [
            'video.required' => 'Une vidéo est obligatoire.',
            'video.file' => 'Le fichier envoyé est invalide.',
            'video.mimetypes' => 'Formats acceptés : MP4, MOV, AVI et MKV.',
            'video.max' => 'La vidéo ne doit pas dépasser 500 Mo.',
        ];
    }
}