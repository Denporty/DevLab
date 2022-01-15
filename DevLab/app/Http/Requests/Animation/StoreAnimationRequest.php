<?php

namespace App\Http\Requests\Animation;

use App\Models\Animation;
use Illuminate\Foundation\Http\FormRequest;

class StoreAnimationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'localisation' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'map' => 'nullable|string',
            'section_title' => 'nullable|string',
            'description_section' => 'nullable|string',
            'active_section' => 'nullable|boolean',
            'tag' => 'nullable|string|max:255|in:'. implode(',', array_keys(Animation::CATEGORIES)),
            'department' => 'nullable|string|max:255|in:'. implode(',', array_keys(Animation::DEPARTMENT)),
            'places' => 'required|integer',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => "Nom de l'animation",
            'description' => 'Description',
            'localisation' => 'Emplacement',
            'start_date' => 'Date de début',
            'end_date' => 'Date de fin',
            'tag' => 'Catégorie',
            'department' => 'Département',
        ];
    }
}
