<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'      => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'date_of_birth'   => 'required|date|before:-15 years',
            'nationality'     => 'required|string|size:3',
            'position'        => 'required|in:GK,CB,LB,RB,CDM,CM,CAM,LW,RW,ST',
            'strong_foot'     => 'required|in:left,right,both',
            'height_cm'       => 'nullable|integer|min:140|max:220',
            'weight_kg'       => 'nullable|integer|min:40|max:120',
            'contract_status' => 'required|in:free,contracted,with_agent',
            'contract_end_date' => 'nullable|date|required_if:contract_status,contracted',
            'bio'             => 'nullable|string|max:1000',
            'available'       => 'boolean',
        ];
    }
}