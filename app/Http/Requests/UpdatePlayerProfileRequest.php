<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'    => 'sometimes|required|string|max:100',
            'last_name'     => 'sometimes|required|string|max:100',
            'date_of_birth' => 'sometimes|required|date|before:-15 years',
            'nationality'   => 'sometimes|required|string|size:3',
            'position'      => 'sometimes|required|in:GK,CB,LB,RB,CDM,CM,CAM,LW,RW,ST',
            'strong_foot'   => 'sometimes|required|in:left,right,both',
            'height_cm'     => 'nullable|integer|min:140|max:220',
            'weight_kg'     => 'nullable|integer|min:40|max:120',
            'bio'           => 'nullable|string|max:1000',
            'available'     => 'boolean',
        ];
    }
}