<?php

namespace App\Http\Requests\Animation;

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
            'tag' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'places' => 'nullable|string|max:255',
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
