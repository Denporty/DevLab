<?php

namespace App\Http\Requests\User;

use App\Models\Animation;
use App\Rules\ImageOrFile;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $animation
 */
class StoreReservationRequest extends FormRequest
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
            'animation_id' => 'nullable|int',
        ];
    }
}
