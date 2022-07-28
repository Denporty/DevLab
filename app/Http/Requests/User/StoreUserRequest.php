<?php

namespace App\Http\Requests\User;

use App\Models\Animation;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'admin' => 'nullable|boolean|',
            'super_admin' => 'nullable|boolean|',
            'department' => 'nullable|int',
            'email' => ['required', 'string', 'email'],
            'animation_id' => 'nullable|int',
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
            'name' => "Nom de l'utilisateur",
            'email' => 'Adresse mail',
            'department' => 'Département',
        ];
    }
}
